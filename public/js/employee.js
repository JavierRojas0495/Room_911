document.addEventListener('DOMContentLoaded', function() {
    // Evento para cuando se abre la modal de historial
    document.querySelectorAll('[id^="historyModal-"]').forEach(function(modal) {
        modal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Botón que abre el modal
            const employeeId = button.getAttribute('data-employee-id');

            // Limpiar formulario de filtros
            const form = document.getElementById('historyFilterForm-' + employeeId);
            if (form) {
                form.reset();
            }

            // Cargar historial inicial
            loadEmployeeHistory(employeeId);
        });
    });

    // Evento para el formulario de filtros
    document.querySelectorAll('[id^="historyFilterForm-"]').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const employeeId = this.getAttribute('id').split('-')[1];
            loadEmployeeHistory(employeeId);
        });
    });

    // Función para cargar el historial del empleado
    function loadEmployeeHistory(employeeId) {
        const form = document.getElementById('historyFilterForm-' + employeeId);
        const historyContainer = document.getElementById('historyContent-' + employeeId);
        const loadingSpinner = document.getElementById('loadingSpinner-' + employeeId);

        if (!form || !historyContainer) return;

        // Mostrar spinner de carga
        if (loadingSpinner) {
            loadingSpinner.style.display = 'block';
        }
        historyContainer.style.display = 'none';

        // Obtener datos del formulario
        const formData = new FormData(form);
        const params = new URLSearchParams();

        for (let [key, value] of formData.entries()) {
            if (value) {
                params.append(key, value);
            }
        }

        // Realizar petición AJAX
        fetch(`/empleado/${employeeId}/historial?${params.toString()}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la petición: ' + response.status);
            }
            return response.text();
        })
        .then(data => {
            // Ocultar spinner y mostrar contenido
            if (loadingSpinner) {
                loadingSpinner.style.display = 'none';
            }
            historyContainer.innerHTML = data;
            historyContainer.style.display = 'block';

            // Actualizar estadísticas si existen
            updateStatistics(employeeId);
        })
        .catch(error => {
            console.error('Error al cargar historial:', error);
            if (loadingSpinner) {
                loadingSpinner.style.display = 'none';
            }
            historyContainer.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Error al cargar el historial. Por favor, inténtalo de nuevo.
                </div>
            `;
            historyContainer.style.display = 'block';
        });
    }

    // Función para actualizar estadísticas
    function updateStatistics(employeeId) {
        const statsContainer = document.getElementById('statsContainer-' + employeeId);
        if (!statsContainer) return;

        const total = statsContainer.querySelectorAll('tbody tr').length;
        const exitosos = statsContainer.querySelectorAll('tbody tr .badge.bg-success').length;
        const fallidos = statsContainer.querySelectorAll('tbody tr .badge.bg-danger').length;

        // Actualizar contadores si existen
        const totalElement = document.getElementById('totalCount-' + employeeId);
        const exitososElement = document.getElementById('exitososCount-' + employeeId);
        const fallidosElement = document.getElementById('fallidosCount-' + employeeId);

        if (totalElement) totalElement.textContent = total;
        if (exitososElement) exitososElement.textContent = exitosos;
        if (fallidosElement) fallidosElement.textContent = fallidos;
    }

    // Función para limpiar filtros desde la tabla
    window.clearFiltersFromTable = function() {
        // Encontrar el formulario activo
        const activeForm = document.querySelector('[id^="historyFilterForm-"]');
        if (activeForm) {
            activeForm.reset();

            // Obtener el ID del empleado del formulario
            const employeeId = activeForm.getAttribute('id').split('-')[1];

            // Recargar historial sin filtros
            loadEmployeeHistory(employeeId);
        }
    };

    // Validación de fechas en tiempo real
    document.querySelectorAll('input[type="date"]').forEach(function(input) {
        input.addEventListener('change', function() {
            const form = this.closest('form');
            if (!form) return;

            const fechaInicio = form.querySelector('input[name="fecha_inicio"]');
            const fechaFin = form.querySelector('input[name="fecha_fin"]');

            if (fechaInicio && fechaFin && fechaInicio.value && fechaFin.value) {
                if (fechaInicio.value > fechaFin.value) {
                    alert('La fecha de inicio no puede ser mayor que la fecha de fin');
                    this.value = '';
                }
            }
        });
    });
});

// Función global para limpiar filtros (usada desde la vista)
function clearFiltersFromTable() {
    // Encontrar el formulario activo
    const activeForm = document.querySelector('[id^="historyFilterForm-"]');
    if (activeForm) {
        activeForm.reset();

        // Obtener el ID del empleado del formulario
        const employeeId = activeForm.getAttribute('id').split('-')[1];

        // Recargar historial sin filtros
        const formData = new FormData();
        const params = new URLSearchParams();

        fetch(`/empleado/${employeeId}/historial?${params.toString()}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(response => response.text())
        .then(data => {
            const historyContainer = document.getElementById('historyContent-' + employeeId);
            if (historyContainer) {
                historyContainer.innerHTML = data;
                historyContainer.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error al limpiar filtros:', error);
        });
    }
}

// Función para generar el PDF
function generatePdf(employeeId) {
    const startDate = document.getElementById(`start_date-${employeeId}`).value;
    const endDate = document.getElementById(`end_date-${employeeId}`).value;

    let url = `/empleado/${employeeId}/generar-pdf`;
    const params = new URLSearchParams();
    if (startDate) params.append('fecha_inicio', startDate);
    if (endDate) params.append('fecha_fin', endDate);
    if (params.toString()) {
        url += '?' + params.toString();
    }
    window.open(url, '_blank');
}

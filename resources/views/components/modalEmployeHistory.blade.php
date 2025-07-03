<!-- Modal History -->
@foreach($empleados as $empleado)
<div class="modal fade" id="historyModal-{{ $empleado->id }}" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel-{{ $empleado->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="historyModalLabel-{{ $empleado->id }}">
                    <i class="fas fa-history me-2"></i>
                    Historial de Inicios de Sesión - {{ $empleado->first_name }} {{ $empleado->last_name }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <!-- Filtros -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Filtros</h6>
                    </div>
                    <div class="card-body">
                        <form id="historyFilterForm-{{ $empleado->id }}" class="row g-3">
                            <div class="col-md-4">
                                <label for="start_date-{{ $empleado->id }}" class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" id="start_date-{{ $empleado->id }}" name="fecha_inicio">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date-{{ $empleado->id }}" class="form-label">Fecha Fin</label>
                                <input type="date" class="form-control" id="end_date-{{ $empleado->id }}" name="fecha_fin">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <div class="d-grid gap-2 d-md-flex">
                                    <button type="button" class="btn btn-primary" onclick="loadHistory({{ $empleado->id }})">
                                        <i class="fas fa-search me-1"></i>Filtrar
                                    </button>
                                    <button type="button" class="btn btn-success" onclick="generatePdf({{ $empleado->id }})">
                                        <i class="fas fa-file-pdf me-1"></i>PDF
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="clearFilters({{ $empleado->id }})">
                                        <i class="fas fa-times me-1"></i>Limpiar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="row mb-4" id="statsContainer-{{ $empleado->id }}" style="display: none;">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-list fa-2x mb-2"></i>
                                <h5 class="card-title">Total de Registros</h5>
                                <h3 id="totalRecords-{{ $empleado->id }}">0</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <h5 class="card-title">Exitosos</h5>
                                <h3 id="successRecords-{{ $empleado->id }}">0</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-times-circle fa-2x mb-2"></i>
                                <h5 class="card-title">Fallidos</h5>
                                <h3 id="failedRecords-{{ $empleado->id }}">0</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenido del historial -->
                <div id="historyContent-{{ $empleado->id }}">
                    @include('employee.history_table', ['registros' => collect([]), 'fecha_inicio' => null, 'fecha_fin' => null])
                </div>

                <!-- Loading spinner -->
                <div id="loadingHistory-{{ $empleado->id }}" class="text-center py-5" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="mt-2 text-muted">Cargando historial...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
function loadHistory(empleadoId) {
    const startDate = document.getElementById(`start_date-${empleadoId}`).value;
    const endDate = document.getElementById(`end_date-${empleadoId}`).value;

    // Validar fechas
    if (startDate && endDate && startDate > endDate) {
        alert('La fecha de inicio no puede ser mayor que la fecha de fin');
        return;
    }

    // Mostrar loading
    document.getElementById(`historyContent-${empleadoId}`).style.display = 'none';
    document.getElementById(`loadingHistory-${empleadoId}`).style.display = 'block';
    document.getElementById(`statsContainer-${empleadoId}`).style.display = 'none';

    // Construir URL con parámetros
    let url = `/empleado/${empleadoId}/historial`;
    const params = new URLSearchParams();

    if (startDate) params.append('fecha_inicio', startDate);
    if (endDate) params.append('fecha_fin', endDate);

    if (params.toString()) {
        url += '?' + params.toString();
    }

        // Cargar historial usando fetch con headers correctos
    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'text/html, application/xhtml+xml, application/xml;q=0.9, */*;q=0.8',
            'Cache-Control': 'no-cache'
        }
    })
    .then(response => {
        console.log('Status:', response.status);
        console.log('Headers:', response.headers);
        return response.text();
    })
    .then(data => {
        console.log('Datos recibidos:', data.substring(0, 100));
        document.getElementById(`historyContent-${empleadoId}`).innerHTML = data;
        document.getElementById(`historyContent-${empleadoId}`).style.display = 'block';
        document.getElementById(`loadingHistory-${empleadoId}`).style.display = 'none';

        // Actualizar estadísticas
        updateStats(empleadoId);
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById(`historyContent-${empleadoId}`).innerHTML =
            '<div class="alert alert-danger d-flex align-items-center gap-2">' +
            '<i class="fas fa-exclamation-triangle"></i>' +
            '<span>Error al cargar el historial. Por favor, inténtalo de nuevo.</span>' +
            '</div>';
        document.getElementById(`historyContent-${empleadoId}`).style.display = 'block';
        document.getElementById(`loadingHistory-${empleadoId}`).style.display = 'none';
    });
}

function clearFilters(empleadoId) {
    document.getElementById(`start_date-${empleadoId}`).value = '';
    document.getElementById(`end_date-${empleadoId}`).value = '';
    loadHistory(empleadoId);
}

function updateStats(empleadoId) {
    const table = document.querySelector(`#historyContent-${empleadoId} table tbody`);
    if (table) {
        const rows = table.querySelectorAll('tr');
        const total = rows.length;
        const successful = Array.from(rows).filter(row =>
            row.querySelector('.badge.bg-success')).length;
        const failed = total - successful;

        document.getElementById(`totalRecords-${empleadoId}`).textContent = total;
        document.getElementById(`successRecords-${empleadoId}`).textContent = successful;
        document.getElementById(`failedRecords-${empleadoId}`).textContent = failed;
        document.getElementById(`statsContainer-${empleadoId}`).style.display = 'flex';
    }
}

function generatePdf(empleadoId) {
    const startDate = document.getElementById(`start_date-${empleadoId}`).value;
    const endDate = document.getElementById(`end_date-${empleadoId}`).value;

    // Validar fechas antes de generar PDF
    if (startDate && endDate && startDate > endDate) {
        alert('La fecha de inicio no puede ser mayor que la fecha de fin');
        return;
    }

    let pdfUrl = `/empleado/${empleadoId}/generar-pdf`;
    const params = new URLSearchParams();

    if (startDate) params.append('fecha_inicio', startDate);
    if (endDate) params.append('fecha_fin', endDate);

    if (params.toString()) {
        pdfUrl += '?' + params.toString();
    }

    // Abrir en nueva ventana
    window.open(pdfUrl, '_blank');
}

// Cargar historial automáticamente cuando se abre la modal
document.addEventListener('DOMContentLoaded', function() {
    // Agregar evento para cargar historial cuando se abre la modal
    const modals = document.querySelectorAll('[id^="historyModal-"]');
    modals.forEach(modal => {
        modal.addEventListener('shown.bs.modal', function() {
            const empleadoId = this.id.split('-')[1];
            loadHistory(empleadoId);
        });
    });

    // Para cada modal de historial
    document.querySelectorAll('.modal').forEach(function(modal) {
        modal.addEventListener('hidden.bs.modal', function () {
            // Eliminar cualquier backdrop que haya quedado
            document.querySelectorAll('.modal-backdrop').forEach(e => e.remove());
            document.body.classList.remove('modal-open');
            document.body.style = '';
            // Limpiar el contenido del historial
            const empleadoId = this.id.split('-')[1];
            const historyContent = document.getElementById(`historyContent-${empleadoId}`);
            if (historyContent) {
                historyContent.innerHTML = '<div class="text-center py-5 text-muted"><i class="fas fa-history fa-3x mb-3"></i><br>Historial limpio. Vuelve a abrir para recargar.</div>';
            }
        });
    });
});

// Función global para limpiar filtros (llamada desde la tabla)
function clearFiltersFromTable() {
    // Obtener el empleadoId del modal activo
    const activeModal = document.querySelector('.modal.show');
    if (activeModal) {
        const empleadoId = activeModal.id.split('-')[1];
        clearFilters(empleadoId);
    }
}
</script>

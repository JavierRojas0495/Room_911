$(document).ready(function() {
    // Captura el evento cuando se abre el modal
    $('[id^="historyModal-"]').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que abre el modal
        var employeeId = button.data('employee-id'); // Obtener el ID del empleado

        // Cargar el historial por defecto
        loadHistory(employeeId);
    });

    // Agregar manejador para el botón de filtro
    $('[id^="historyFilterForm-"]').on('submit', function(e) {
        e.preventDefault();
        var employeeId = $(this).attr('id').split('-')[1];
        loadHistory(employeeId);
    });
});

// Función para cargar el historial
function loadHistory(employeeId) {
    var startDate = $('#start_date-' + employeeId).val();
    var endDate = $('#end_date-' + employeeId).val();

    $.ajax({
        url: '/employee/' + employeeId + '/history',
        type: 'GET',
        data: {
            start_date: startDate,
            end_date: endDate
        },
        success: function(data) {
            $('#historyContent-' + employeeId).html(data);
        },
        error: function(xhr, status, error) {
            $('#historyContent-' + employeeId).html('<p>There was an error loading the history. Please try again later.</p>');
        }
    });
}

// Funcion para general el pdf
function generatePdf(employeeId) {  
    const startDate = document.getElementById(`start_date-${employeeId}`).value;  
    const endDate = document.getElementById(`end_date-${employeeId}`).value;  

    const url = `/employee/${employeeId}/generate-pdf`; // Asegúrate de que esta URL coincida con la ruta definida en `web.php`  

    const params = new URLSearchParams();  
    if (startDate) params.append('start_date', startDate);  
    if (endDate) params.append('end_date', endDate);  

    // Redirigir a la URL con los parámetros  
    window.location.href = url + '?' + params.toString();  
}
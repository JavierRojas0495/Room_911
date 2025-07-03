<!-- resources/views/employee/history.blade.php -->
<div class="card shadow border-0 rounded-4">
    <div class="card-header bg-info text-white d-flex align-items-center justify-content-between rounded-top-4" style="min-height: 56px;">
        <h5 class="mb-0 d-flex align-items-center">
            <i class="fas fa-history me-2"></i>
            Historial de Inicios de Sesión
        </h5>
        <button class="btn btn-light btn-sm d-flex align-items-center gap-1" onclick="generarPDF()">
            <i class="fas fa-file-pdf"></i> PDF
        </button>
    </div>
    <div class="card-body bg-white rounded-bottom-4">
        <!-- Filtros -->
        <div class="card mb-4 border-0 shadow-sm rounded-3 bg-light">
            <div class="card-header bg-white border-0 rounded-top-3 pb-2 pt-3">
                <h6 class="mb-0 text-info"><i class="fas fa-filter me-2"></i>Filtros</h6>
            </div>
            <div class="card-body pt-2 pb-3">
                <form class="row g-2 align-items-end justify-content-center">
                    <div class="col-md-4 col-12">
                        <label for="fecha_inicio" class="form-label small">Fecha Inicio</label>
                        <input type="date" class="form-control rounded-3" id="fecha_inicio" name="fecha_inicio">
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="fecha_fin" class="form-label small">Fecha Fin</label>
                        <input type="date" class="form-control rounded-3" id="fecha_fin" name="fecha_fin">
                    </div>
                    <div class="col-md-4 col-12 d-flex gap-2 justify-content-md-start justify-content-center mt-md-0 mt-2">
                        <button type="button" class="btn btn-primary rounded-3 px-3 d-flex align-items-center gap-1" onclick="loadHistoryFromMain()">
                            <i class="fas fa-search"></i> Filtrar
                        </button>
                        <button type="button" class="btn btn-success rounded-3 px-3 d-flex align-items-center gap-1" onclick="generarPDF()">
                            <i class="fas fa-file-pdf"></i> PDF
                        </button>
                        <button type="button" class="btn btn-secondary rounded-3 px-3 d-flex align-items-center gap-1" onclick="clearFiltersFromMain()">
                            <i class="fas fa-times"></i> Limpiar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div id="historyContent">
            @include('employee.history_table', ['registros' => $registros, 'fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin])
        </div>
    </div>
</div>

<script>
function generarPDF() {
    const urlParts = window.location.pathname.split('/');
    const empleadoId = urlParts[urlParts.length - 2];
    const urlParams = new URLSearchParams(window.location.search);
    const fechaInicio = urlParams.get('fecha_inicio');
    const fechaFin = urlParams.get('fecha_fin');
    let pdfUrl = `/empleado/${empleadoId}/generar-pdf`;
    const params = new URLSearchParams();
    if (fechaInicio) params.append('fecha_inicio', fechaInicio);
    if (fechaFin) params.append('fecha_fin', fechaFin);
    if (params.toString()) {
        pdfUrl += '?' + params.toString();
    }
    window.open(pdfUrl, '_blank');
}
// Para filtros desde la vista principal (no desde la modal)
function loadHistoryFromMain() {
    // Implementa si usas esta vista fuera de la modal
}
function clearFiltersFromMain() {
    document.getElementById('fecha_inicio').value = '';
    document.getElementById('fecha_fin').value = '';
    // Implementa si usas esta vista fuera de la modal
}
</script>

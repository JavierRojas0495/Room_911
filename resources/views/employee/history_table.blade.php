@php
    $filtroActivo = !empty($fecha_inicio) || !empty($fecha_fin);
@endphp
@if($filtroActivo)
    <div class="alert alert-info d-flex align-items-center gap-2 p-3 mb-3" style="font-size:1.1rem;">
        <i class="fas fa-calendar-alt me-2"></i>
        <span>
            Mostrando accesos
            @if($fecha_inicio)
                desde <b>{{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }}</b>
            @endif
            @if($fecha_fin)
                hasta <b>{{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}</b>
            @endif
        </span>
    </div>
@endif
@if($registros->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle rounded-3 overflow-hidden">
            <thead class="table-info">
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registros as $registro)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($registro->attempt_on_date)->format('d/m/Y') }}</td>
                        <td>{{ $registro->attempt_in_time }}</td>
                        <td>
                            @if($registro->status === 'exitoso')
                                <span class="badge bg-success">Exitoso</span>
                            @else
                                <span class="badge bg-danger">Fallido</span>
                            @endif
                        </td>
                        <td>{{ $registro->failure_reason ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="d-flex flex-column align-items-center justify-content-center py-5">
        <div class="text-center mb-4">
            <span class="d-block mb-3" style="font-size: 4rem; color: #b0bec5;">
                <i class="fas fa-search"></i>
            </span>
            <h4 class="text-muted mb-2">No se encontraron registros</h4>
            @if($filtroActivo)
                <p class="text-muted mb-1">No hay datos de acceso para los filtros seleccionados</p>
                <p class="text-muted mb-0">
                    <i class="fas fa-lightbulb me-1"></i>
                    Prueba con otros criterios o haz clic en <b>Limpiar</b> para ver todos los registros
                </p>
            @else
                <p class="text-muted mb-0">Este empleado aún no tiene registros de inicio de sesión</p>
            @endif
        </div>
        @if($filtroActivo)
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-secondary" onclick="clearFiltersFromTable()">
                    <i class="fas fa-times me-1"></i>Limpiar Filtros
                </button>
            </div>
        @endif
    </div>
@endif

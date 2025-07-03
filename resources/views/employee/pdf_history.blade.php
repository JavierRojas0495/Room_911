<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Historial de Inicios de Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 24px;
        }
        .employee-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .employee-info h3 {
            color: #007bff;
            margin-top: 0;
            font-size: 16px;
        }
        .info-row {
            margin-bottom: 5px;
        }
        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }
        .filters {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .filters h4 {
            margin: 0 0 10px 0;
            color: #495057;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #007bff;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        td {
            padding: 6px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 10px;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .status-success {
            color: #28a745;
            font-weight: bold;
        }
        .status-failed {
            color: #dc3545;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #666;
        }
        .no-records {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Historial de Inicios de Sesión</h1>
        <p>Reporte generado el {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="employee-info">
        <h3>Información del Empleado</h3>
        <div class="info-row">
            <span class="info-label">Nombre:</span>
            <span>{{ $empleado->first_name }} {{ $empleado->last_name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">ID Empleado:</span>
            <span>{{ $empleado->id }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Documento:</span>
            <span>{{ $empleado->document_number }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Email:</span>
            <span>{{ $empleado->email }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Departamento:</span>
            <span>{{ $empleado->departamento ? $empleado->departamento->nombre : 'N/A' }}</span>
        </div>
    </div>

    @if($fecha_inicio || $fecha_fin)
    <div class="filters">
        <h4>Filtros Aplicados</h4>
        @if($fecha_inicio)
        <div class="info-row">
            <span class="info-label">Fecha Inicio:</span>
            <span>{{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }}</span>
        </div>
        @endif
        @if($fecha_fin)
        <div class="info-row">
            <span class="info-label">Fecha Fin:</span>
            <span>{{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}</span>
        </div>
        @endif
    </div>
    @endif

    @if($registros->count() > 0)
    <table>
        <thead>
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
                    @if($registro->is_successful)
                        <span class="status-success">Exitoso</span>
                    @else
                        <span class="status-failed">Fallido</span>
                    @endif
                </td>
                <td>{{ $registro->failure_reason ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total de registros: {{ $registros->count() }}</p>
        <p>Registros exitosos: {{ $registros->where('is_successful', true)->count() }}</p>
        <p>Registros fallidos: {{ $registros->where('is_successful', false)->count() }}</p>
    </div>
    @else
    <div class="no-records">
        <h3>No se encontraron registros de inicio de sesión</h3>
        <p>No hay datos de acceso para el período seleccionado.</p>
    </div>
    @endif
</body>
</html>

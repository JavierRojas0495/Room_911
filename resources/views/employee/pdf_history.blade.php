<!DOCTYPE html>  
<html>  
<head>  
    <title>Access History</title>  
    <style>  
        body { font-family: Arial, sans-serif; }  
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }  
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }  
    </style>  
</head>  
<body>  
    <h1>Access History for {{ $employee->first_name }} {{ $employee->last_name }}</h1>  
    <table>  
        <thead>  
            <tr>  
                <th>Date</th>  
                <th>Time</th>  
                <th>Status</th>  
            </tr>  
        </thead>  
        <tbody>  
            @foreach($logs as $log)  
            <tr>  
                <td>{{ \Carbon\Carbon::parse($log->attempt_on_date)->format('Y-m-d') }}</td>  
                <td>{{ \Carbon\Carbon::parse($log->attempt_in_time)->format('H:i:s') }}</td>  
                <td>{{ $log->status }}</td> <!-- Asegúrate de que el modelo LoginLog tenga el campo 'status' -->  
            </tr>  
            @endforeach  
        </tbody>  
    </table>  
</body>  
</html>
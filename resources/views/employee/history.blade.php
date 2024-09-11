<!-- resources/views/employee/history.blade.php -->
<table class="table table-bordered">
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

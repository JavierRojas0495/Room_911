@extends('layouts.partials.dashboard')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Administrative Menu</h2>

        <!-- Mensajes de éxito o error -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Fila para el formulario de importación y los filtros -->
        <div class="row mb-4">
            
            <!-- Formulario de filtros -->
            <div class="col-md-12">
                <form method="GET" action="{{ route('employee.index') }}">
                    <div class="row mb-4">
                        <!-- Botones de acción -->
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-filter"></i> Filter
                            </button>
                            <a href="{{ route('employee.index') }}" class="btn btn-secondary">
                                <i class="fa fa-times"></i> Clear filter
                            </a>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">
                                <i class="fa fa-upload"></i> Import Employees
                            </button>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <!-- Filtro por ID de empleado -->
                        <div class="col-md-3 mb-2">
                            <input type="text" class="form-control" placeholder="Search by employee ID" name="employee_id" value="{{ request()->employee_id }}">
                        </div>

                        <!-- Filtro por nombre -->
                        <div class="col-md-3 mb-2">
                            <input type="text" class="form-control" placeholder="Search by first name" name="first_name" value="{{ request()->first_name }}">
                        </div>

                        <!-- Filtro por apellido -->
                        <div class="col-md-3 mb-2">
                            <input type="text" class="form-control" placeholder="Search by last name" name="last_name" value="{{ request()->last_name }}">
                        </div>

                        <!-- Filtro por departamento -->
                        <div class="col-md-3 mb-2">
                            <select class="form-control" name="department">
                                <option value="">Filter by department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ request()->department == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de empleados -->
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Employee ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Department</th>
                    <th>Total Access</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->departament ? $employee->departament->name : 'N/A' }}</td>
                        <td>{{ $employee->login_logs_count }}</td> <!-- Total de accesos -->
                        <td>
                            <!-- Mostrar Enable o Disable según el estado -->
                            {{ $employee->is_active ? 'Enable' : 'Disable' }}
                        </td>
                        <td>
                            <a href="{{ route('employee.edit', ['employee' => $employee]) }}" class="btn btn-primary btn-sm">Update</a>
                             <!-- Botón dinámico según el estado del empleado -->
                            <form action="{{ route('employee.toggleStatus', ['employee' => $employee]) }}" method="post" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                @if($employee->is_active)
                                    <button type="submit" class="btn btn-sm btn-secondary">Disable</button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-success">Enable</button>
                                @endif
                            </form>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#historyModal-{{ $employee->id }}" data-employee-id="{{ $employee->id }}">History</button>
                            <form action="{{ route('employee.destroy', ['employee' => $employee]) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Modal Imports -->
        @include('components.modalEmployeImport')
        <!-- Modal History -->
        @include('components.modalEmployeHistory')
        
        <script src="{{ asset('js/employee.js') }}"></script>

@endsection

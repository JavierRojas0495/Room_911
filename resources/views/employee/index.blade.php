@extends('layouts.partials.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-md-12">
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-info text-white d-flex align-items-center justify-content-between">
                    <h3 class="mb-0"><i class="fas fa-users me-2"></i>Listado de Empleados</h3>
                    <a href="{{ route('empleado.crear') }}" class="btn btn-success"><i class="fas fa-user-plus me-1"></i>Nuevo Empleado</a>
                </div>
                <div class="card-body">
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
                    <form method="GET" action="{{ route('empleado.indice') }}" class="mb-3">
                        <div class="row g-2 align-items-end justify-content-center filtros-empleados">
                            <div class="col">
                                <label for="empleado_id" class="form-label small">ID Empleado</label>
                                <input type="text" class="form-control" placeholder="ID de empleado" name="empleado_id" id="empleado_id" value="{{ request()->empleado_id }}">
                            </div>
                            <div class="col">
                                <label for="nombre" class="form-label small">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" value="{{ request()->nombre }}">
                            </div>
                            <div class="col">
                                <label for="apellido" class="form-label small">Apellido</label>
                                <input type="text" class="form-control" placeholder="Apellido" name="apellido" id="apellido" value="{{ request()->apellido }}">
                            </div>
                            <div class="col">
                                <label for="departamento" class="form-label small">Departamento</label>
                                <select class="form-select" name="departamento" id="departamento">
                                    <option value="">Todos los departamentos</option>
                                    @foreach($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}" {{ request()->departamento == $departamento->id ? 'selected' : '' }}>{{ $departamento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto" style="min-width: 140px;">
                                <div class="d-flex flex-column">
                                    <label for="estado" class="form-label small mb-1">Estado</label>
                                    <select class="form-select" name="estado" id="estado">
                                        <option value="" {{ request()->estado === null || request()->estado === '' ? 'selected' : '' }}>Todos</option>
                                        <option value="true" {{ request()->estado === 'true' ? 'selected' : '' }}>Activo</option>
                                        <option value="false" {{ request()->estado === 'false' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto d-grid align-items-center">
                                <label class="form-label small" style="visibility:hidden;">Buscar</label>
                                <button type="submit" class="btn btn-primary" style="height: 38px;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-bordered mb-0 listado-empleados-table">
                            <thead class="table-info">
                                <tr>
                                    <th class="text-center">ID Empleado</th>
                                    <th class="text-start">Nombre</th>
                                    <th class="text-start">Apellido</th>
                                    <th class="text-start">Departamento</th>
                                    <th class="text-center">Total Accesos</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($empleados as $empleado)
                                    <tr>
                                        <td class="text-center">{{ $empleado->id }}</td>
                                        <td class="text-start">{{ $empleado->first_name }}</td>
                                        <td class="text-start">{{ $empleado->last_name }}</td>
                                        <td class="text-start">{{ $empleado->departamento ? $empleado->departamento->nombre : 'N/A' }}</td>
                                        <td class="text-center">{{ $empleado->registros_inicio_sesion_count ?? 0 }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $empleado->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $empleado->is_active ? 'Habilitado' : 'Deshabilitado' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('empleado.editar', ['empleado' => $empleado]) }}" class="btn btn-primary btn-sm me-1" title="Editar"><i class="fas fa-edit"></i></a>
                                            @if($empleado->is_active)
                                                <form action="{{ route('empleado.alternarEstado', ['empleado' => $empleado]) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-warning btn-sm me-1"
                                                            title="Deshabilitar"
                                                            onclick="return confirm('¿Estás seguro de deshabilitar este empleado?')">
                                                        <i class="fas fa-user-slash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('empleado.alternarEstado', ['empleado' => $empleado]) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm me-1"
                                                            title="Reactivar"
                                                            onclick="return confirm('¿Estás seguro de reactivar este empleado?')">
                                                        <i class="fas fa-user-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <button type="button" class="btn btn-info btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#historyModal-{{ $empleado->id }}"
                                                    data-employee-id="{{ $empleado->id }}"
                                                    title="Historial">
                                                <i class="fas fa-history"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $empleados->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir el modal de historial -->
@include('components.modalEmployeHistory')

@endsection

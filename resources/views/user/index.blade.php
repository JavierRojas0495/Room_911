@extends('layouts.partials.dashboard')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                <h4 class="mb-0"><i class="fas fa-users me-2"></i>Lista de Administradores</h4>
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-user-plus me-1"></i>Agregar Usuario
                </a>
            </div>
            <div class="card-body py-4">
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
                <!-- Filtros -->
                <form method="GET" action="{{ route('user.index') }}" class="row g-3 mb-4 align-items-end">
                    <div class="col-md-2">
                        <label for="filtro_id" class="form-label mb-0">ID</label>
                        <input type="text" name="filtro_id" id="filtro_id" class="form-control" value="{{ request('filtro_id') }}" placeholder="ID">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_nombre" class="form-label mb-0">Nombre</label>
                        <input type="text" name="filtro_nombre" id="filtro_nombre" class="form-control" value="{{ request('filtro_nombre') }}" placeholder="Nombre">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_apellido" class="form-label mb-0">Apellido</label>
                        <input type="text" name="filtro_apellido" id="filtro_apellido" class="form-control" value="{{ request('filtro_apellido') }}" placeholder="Apellido">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_documento" class="form-label mb-0">Número de Documento</label>
                        <input type="text" name="filtro_documento" id="filtro_documento" class="form-control" value="{{ request('filtro_documento') }}" placeholder="Número de Documento">
                    </div>
                    <div class="col-md-1 d-grid">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search me-1"></i>Filtrar</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle rounded-3 overflow-hidden">
                        <thead class="table-info">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Número de Documento</th>
                                <th>Correo Electrónico</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->document_number }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm me-1" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-center bg-light py-2">
                {{ $users->appends(request()->query())->links() }} <!-- Paginación si es necesario -->
            </div>
        </div>
    </div>
@endsection

@extends('layouts.partials.dashboard')

@section('content')
<div class="form-card-center">
    <div class="card formulario-empleado formulario-admin shadow-sm border-0">
        <div class="card-header">
            <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Crear Administrador</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('user.store') }}" class="mx-auto" style="max-width: 400px;">
                @csrf
                <div class="mb-3">
                    <label for="first_name" class="form-label">Nombre</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Ingrese el nombre" value="{{ old('first_name') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Apellido</label>
                    <div class="input-icon">
                        <i class="fas fa-user-circle"></i>
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Ingrese el apellido" value="{{ old('last_name') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="document_number" class="form-label">Número de Documento</label>
                    <div class="input-icon">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="document_number" class="form-control" id="document_number" placeholder="Ingrese el número de documento" value="{{ old('document_number') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Ingrese el correo electrónico" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Ingrese la contraseña" required>
                    </div>
                </div>
                <div class="row mt-4 align-items-center justify-content-between gap-2 gap-md-0">
                    <div class="col-6 d-flex justify-content-start">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary w-100 px-4">
                            <i class="fas fa-home me-1"></i>Inicio
                        </a>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success w-100 px-4">
                            <i class="fas fa-save me-1"></i>Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
.input-icon {
    position: relative;
}
.input-icon i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 1rem;
    pointer-events: none;
}
.input-icon .form-control {
    padding-left: 2.2em;
}
</style>
@endsection

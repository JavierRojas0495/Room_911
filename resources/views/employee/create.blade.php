@extends('layouts.partials.dashboard')

@section('content')
<div class="form-card-center">
    <div class="card formulario-empleado shadow-sm border-0">
        <div class="card-header">
            <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Crear Empleado</h4>
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
            <form action="{{ route('empleado.guardar') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" class="form-control" id="apellido" value="{{ old('apellido') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="numero_documento" class="form-label">Número de Documento</label>
                        <input type="text" name="numero_documento" class="form-control" id="numero_documento" value="{{ old('numero_documento') }}" required>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" name="correo" class="form-control" id="correo" value="{{ old('correo') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="telefono" class="form-label">Teléfono o Celular</label>
                        <input type="text" name="telefono" class="form-control" id="telefono" value="{{ old('telefono') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control" id="direccion" value="{{ old('direccion') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="pais_id" class="form-label mb-0">País</label>
                        <select name="pais_id" id="pais_id" class="form-control" required>
                            <option value="" selected disabled>Selecciona un país</option>
                            @foreach($paises as $pais)
                                <option value="{{ $pais->id }}" {{ old('pais_id') == $pais->id ? 'selected' : '' }}>{{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="ciudad_id" class="form-label mb-0">Ciudad</label>
                        <select name="ciudad_id" id="ciudad_id" class="form-control" required>
                            <option value="" selected disabled>Selecciona primero un país</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 departamento-block">
                    <div class="col-md-8 mx-auto">
                        <label for="departamento_id" class="form-label mb-0">Departamento</label>
                        <select name="departamento_id" id="departamento_id" class="form-control" required>
                            <option value="" selected disabled>Selecciona un departamento</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{ $departamento->id }}" {{ old('departamento_id') == $departamento->id ? 'selected' : '' }}>{{ $departamento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4 me-2"><i class="fas fa-save me-1"></i>Guardar</button>
                    <a href="{{ route('empleado.indice') }}" class="btn btn-secondary px-4"><i class="fas fa-home me-1"></i>Inicio</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var paisSelect = document.getElementById('pais_id');
    var ciudadSelect = document.getElementById('ciudad_id');
    if (paisSelect && ciudadSelect) {
        paisSelect.addEventListener('change', function() {
            var paisId = this.value;
            if (paisId) {
                fetch(`{{ url('/obtenerCiudades') }}/${paisId}`)
                    .then(response => response.text())
                    .then(html => {
                        ciudadSelect.innerHTML = html;
                    })
                    .catch(() => {
                        ciudadSelect.innerHTML = '<option value="" selected disabled>Error al cargar ciudades</option>';
                    });
            } else {
                ciudadSelect.innerHTML = '<option value="" selected disabled>Selecciona primero un país</option>';
            }
        });
    }
});
</script>

@endsection

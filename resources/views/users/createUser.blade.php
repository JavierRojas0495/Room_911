<!-- resources/views/empleado/create.blade.php -->
@extends('layouts.partials.dashboard')

@section('styles')
    <link href="{{ asset('css/user/createUser.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid col-md-8 mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Registro de Usuario</h4>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('empleado.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Campo para la foto de perfil -->
                            <div class="form-group">
                                <label for="fotoPerfil">Foto de Perfil</label>
                                <input type="file" class="form-control-file" name="fotoPerfil" id="fotoPerfil" accept="image/*" onchange="previewImage(event)">
                            </div>

                            <!-- Vista previa de la foto -->
                            <div class="form-group">
                                <label>Vista previa de la foto:</label>
                                <img id="preview" class="img-fluid" src="{{ asset('usuario_sin_foto.jpg') }}" alt="Vista previa de la foto" style="max-width: 100%; display: block;">
                            </div>

                            <!-- Campos del formulario -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Nombres</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingrese sus nombres" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="apellido">Apellidos</label>
                                    <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Ingrese sus apellidos" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="razon_social">Tipo de Usuario</label>
                                    <select name="razon_social" id="razon_social" class="form-control" required>
                                        <option value="" selected disabled>Seleccione el tipo de usuario</option>
                                        <option value="admin">Administrador</option>
                                        <option value="cliente">Cliente</option>
                                        <option value="empleado">Empleado</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="num_documento">Sexo</label>
                                    <select name="num_documento" id="num_documento" class="form-control" required>
                                        <option value="" selected disabled>Seleccione su género</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
                                        <option value="otros">Prefiero no decir</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="num_telefono">Correo Electrónico</label>
                                    <input type="email" name="num_telefono" class="form-control" id="num_telefono" placeholder="Ingrese su correo electrónico" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Teléfono</label>
                                    <input type="tel" name="email" class="form-control" id="email" placeholder="Ingrese su número de teléfono" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="pais_id">Fecha de Nacimiento</label>
                                    <input type="date" name="pais_id" class="form-control" id="pais_id" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ciudad">Dirección</label>
                                    <input type="text" name="ciudad" class="form-control" id="ciudad" placeholder="Ingrese su dirección" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="contrasena">Contraseña</label>
                                    <input type="password" name="contrasena" class="form-control" id="contrasena" placeholder="Ingrese su contraseña" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirmarContrasena">Confirmar Contraseña</label>
                                    <input type="password" name="confirmarContrasena" class="form-control" id="confirmarContrasena" placeholder="Confirme su contraseña" required>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <a href="" class="btn btn-danger">Inicio</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            $('#pais_id').change(function() {
                var paisId = $(this).val();

                if (paisId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/obtener-ciudades') }}/" + paisId,
                        success: function(response) {
                            $('#ciudad').html(response);
                        }
                    });
                } else {
                    $('#ciudad').html('<option value="" selected disabled>Selecciona un país primero</option>');
                }
            });
        });

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection

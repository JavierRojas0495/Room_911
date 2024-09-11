@extends('layouts.partials.dashboard')

@section('content')
    <div class="container-fluid col-md-8 mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Edit Employee</h4>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Mostrar errores de validación -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('employee.update', $employee->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Form Fields -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name', $employee->first_name) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name', $employee->last_name) }}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="departament_id">Departament</label>
                                    <select name="departament_id" id="departament_id" class="form-control" required>
                                        <option value="" selected disabled>Select Departament</option>
                                        @foreach($departaments as $departament)
                                            <option value="{{ $departament->id }}" {{ old('departament_id', $employee->departament_id) == $departament->id ? 'selected' : '' }}>{{ $departament->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="document_number">Document Number</label>
                                    <input type="text" name="document_number" class="form-control" id="document_number" value="{{ old('document_number', $employee->document_number) }}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ old('phone_number', $employee->phone_number) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $employee->email) }}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="country_id">Country</label>
                                    <select name="country_id" id="country_id" class="form-control" required>
                                        <option value="" selected disabled>Select country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id', $employee->country_id) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="city_id">City</label>
                                    <select name="city_id" id="city_id" class="form-control" required>
                                        <option value="" selected disabled>Select country first</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="birthdate">Date of Birth</label>
                                    <input type="date" name="birthdate" class="form-control" id="birthdate" value="{{ old('birthdate', $employee->birthdate) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" value="{{ old('address', $employee->address) }}" required>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ route('employee.index') }}" class="btn btn-danger">Home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#country_id').change(function() {
                var countryId = $(this).val();

                if (countryId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/getCities') }}/" + countryId,
                        success: function(response) {
                            $('#city_id').html(response);

                            // Preseleccionar la ciudad actual
                            var currentCityId = "{{ old('city_id', $employee->city_id) }}";
                            $('#city_id').val(currentCityId);
                        }
                    });
                } else {
                    $('#city_id').html('<option value="" selected disabled>Select a country first</option>');
                }
            });

            // Inicializar el select de ciudades si ya se ha seleccionado un país
            var initialCountryId = "{{ old('country_id', $employee->country_id) }}";
            if (initialCountryId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/getCities') }}/" + initialCountryId,
                    success: function(response) {
                        $('#city_id').html(response);

                        // Preseleccionar la ciudad actual
                        var currentCityId = "{{ old('city_id', $employee->city_id) }}";
                        $('#city_id').val(currentCityId);
                    }
                });
            }

            // Eliminar el manejo de campo de contraseña ya que no se utiliza
        });
    </script>

@endsection

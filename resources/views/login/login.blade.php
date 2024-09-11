@extends('layouts.app')
@section('content')
    <div class="container col-md-6 mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-dark text-white text-center">
                        <h4 class="mb-0">Admin Room 911 Authentication</h4>
                        <!-- Botón de ingreso a la autorización de empleados -->
                        <div class="position-relative">
                            <a href="{{ route('login.authorized') }}" class="btn btn-info btn-sm position-absolute" style="top: 20px; right: 2px;">
                                Employee Entry
                            </a>
                        </div>
                    </div>

                    <div class="card-body py-4">
                        @if(session('success'))
                            <div class="alert alert-success col-10">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger col-10">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf
                            <div class="form-group position-relative">
                                <label for="employee_id" class="font-weight-bold">Employee ID</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-user"></i> <!-- User icon -->
                                        </span>
                                    </div>
                                    <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="Enter your Employee ID" required>
                                </div>
                            </div>

                            <div class="form-group position-relative">
                                <label for="password" class="font-weight-bold">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-lock"></i> <!-- Lock icon -->
                                        </span>
                                    </div>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your Password" required>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-block font-weight-bold">Authorize</button>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer text-center bg-light py-2">
                        <small class="text-muted">Only authorized personnel can access Room 911</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

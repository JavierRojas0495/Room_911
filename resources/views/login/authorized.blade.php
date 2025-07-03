@extends('layouts.login')
@section('content')
<style>
.login-bg {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.login-card {
    max-width: 400px;
    margin: auto;
    border-radius: 18px;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
    background: #fff;
    overflow: hidden;
}
.login-card .card-header {
    background: #0097a7;
    color: #fff;
    text-align: center;
    border-bottom: none;
    padding: 2rem 1rem 1rem 1rem;
}
.login-card .card-body {
    padding: 2rem 2rem 1rem 2rem;
}
.login-card .input-icon {
    position: relative;
}
.login-card .input-icon i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #0097a7;
    font-size: 1.1rem;
    pointer-events: none;
}
.login-card .form-control {
    padding-left: 2.5em;
    border-radius: 8px;
}
.login-card .btn-success {
    width: 100%;
    font-weight: bold;
    border-radius: 8px;
    font-size: 1.1rem;
    margin-top: 1.2rem;
}
.login-card .btn-outline-info {
    width: 100%;
    border-radius: 8px;
    font-size: 1.05rem;
    margin-top: 0.7rem;
}
.login-card .card-footer {
    background: #f1f8fa;
    border-top: none;
    padding: 1rem;
}
</style>
<div class="login-bg">
    <div class="card login-card">
        <div class="card-header">
            <h4 class="mb-0"><i class="fas fa-users me-2"></i>Ingreso de Empleado</h4>
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
            <form method="POST" action="{{ route('login.authorizeEntry') }}">
                @csrf
                <div class="mb-3">
                    <label for="employee_id" class="form-label">ID de Empleado</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="Ingrese su ID de empleado" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success"><i class="fas fa-sign-in-alt me-1"></i>Ingresar</button>
            </form>
            <div class="text-center mt-3">
                <a href="{{ route('login.login') }}" class="btn btn-outline-info">
                    <i class="fas fa-user-shield me-1"></i> Ingresar como Administrador
                </a>
            </div>
        </div>
        <div class="card-footer text-center">
            <small class="text-muted">Solo personal autorizado puede acceder a Room 911</small>
        </div>
    </div>
</div>
@endsection

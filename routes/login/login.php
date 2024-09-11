<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Ruta para el formulario de autorización de empleados (acceso sin contraseña)
Route::get('/login', [LoginController::class, 'showAuthorizationForm'])->name('login.authorized');

// Ruta para el formulario de inicio de sesión del dashboard (acceso con contraseña)
Route::get('/login/authorized', [LoginController::class, 'showEmployedLoginForm'])->name('login.authorized');
Route::post('/login/accessEmployee', [LoginController::class, 'authorizeEmployee'])->name('login.authorizeEntry');

Route::get('/login/login', [LoginController::class, 'showAdminLoginForm'])->name('login.login');
Route::post('/login/accessAdmin', [LoginController::class, 'login'])->name('login.submit');

// Ruta para cerrar sesión  
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
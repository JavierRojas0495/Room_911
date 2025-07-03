<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'Room 911 - Sistema funcionando correctamente!';
});

Route::get('/login', function () {
    return view('login/login');
});
require_once __DIR__ . '/login/login.php';

// Ruta de prueba temporal para el historial (sin autenticación)
Route::get('/test-historial/{empleadoId}', function($empleadoId) {
    return view('employee.history_table', [
        'registros' => \App\Models\RegistroInicioSesion::where('employee_id', $empleadoId)->get(),
        'fecha_inicio' => null,
        'fecha_fin' => null
    ]);
});

Route::middleware('auth')->group(function () {
    require_once __DIR__ . '/user/user.php';
    require_once __DIR__ . '/employee/employee.php';
    require_once __DIR__ . '/users/user.php';
});

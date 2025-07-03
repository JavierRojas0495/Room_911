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
    return 'Hello World - Laravel Basic Test';
});

Route::get('/test', function () {
    return 'Test simple - Laravel funciona!';
});

Route::get('/env-check', function () {
    return response()->json([
        'APP_NAME' => env('APP_NAME'),
        'APP_ENV' => env('APP_ENV'),
        'APP_KEY' => env('APP_KEY') ? 'Set' : 'Not Set',
        'APP_DEBUG' => env('APP_DEBUG'),
        'APP_URL' => env('APP_URL'),
        'DB_CONNECTION' => env('DB_CONNECTION'),
        'DB_HOST' => env('DB_HOST'),
        'DB_DATABASE' => env('DB_DATABASE'),
        'DB_USERNAME' => env('DB_USERNAME'),
        'DB_PASSWORD' => env('DB_PASSWORD') ? 'Set' : 'Not Set'
    ]);
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

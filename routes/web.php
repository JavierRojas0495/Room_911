<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rutas para servir assets estáticos
Route::get('/assets/css/{filename}', [AssetController::class, 'serveCss'])->where('filename', '.*\.css$');
Route::get('/assets/js/{filename}', [AssetController::class, 'serveJs'])->where('filename', '.*\.js$');

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

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

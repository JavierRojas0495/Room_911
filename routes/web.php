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

// Ruta de prueba para verificar assets
Route::get('/test-assets', function () {
    return response()->json([
        'message' => 'AssetController test',
        'css_files' => [
            'app.css' => file_exists(public_path('css/app.css')),
            'styles.css' => file_exists(public_path('css/styles.css')),
            'mobile.css' => file_exists(public_path('css/mobile.css')),
            'login.css' => file_exists(public_path('css/login.css')),
        ],
        'js_files' => [
            'app.js' => file_exists(public_path('js/app.js')),
            'allFunctions.js' => file_exists(public_path('js/allFunctions.js')),
            'asset-checker.js' => file_exists(public_path('js/asset-checker.js')),
        ],
        'public_path' => public_path(),
    ]);
});

Route::get('/', function () {
    return view('login/login');
});

Route::get('/login', function () {
    return view('login/login');
});

Route::get('/authorized', function () {
    return view('login/authorized');
});

// Rutas de empleados
require __DIR__.'/employee/employee.php';

// Rutas de usuarios
require __DIR__.'/user/user.php';

// Rutas de login
require __DIR__.'/login/login.php';

// Ruta de prueba temporal para el historial (sin autenticación)
Route::get('/historial', function () {
    return view('employee.history');
});

Route::middleware('auth')->group(function () {
    require_once __DIR__ . '/users/user.php';
});

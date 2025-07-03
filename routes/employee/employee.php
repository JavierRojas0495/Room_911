<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoControlador;
use App\Http\Controllers\PdfController;

// Listar todos los empleados
Route::get('/empleado', [EmpleadoControlador::class, 'indice'])->name('empleado.indice');

// Mostrar el formulario de creación
Route::get('/empleado/crear', [EmpleadoControlador::class, 'crear'])->name('empleado.crear');

// Almacenar un nuevo empleado
Route::post('/empleado', [EmpleadoControlador::class, 'guardar'])->name('empleado.guardar');

// Obtener las ciudades dependiendo del país seleccionado (AJAX)
Route::get('/obtenerCiudades/{paisId}', [EmpleadoControlador::class, 'obtenerCiudades'])->name('empleado.obtenerCiudades');

// Mostrar el formulario de edición para un empleado específico
Route::get('/empleado/{empleado}/editar', [EmpleadoControlador::class, 'editar'])->name('empleado.editar');

// Actualizar un empleado existente
Route::put('/empleado/{empleado}', [EmpleadoControlador::class, 'actualizar'])->name('empleado.actualizar');

// Eliminar un empleado
Route::delete('/empleado/{empleado}', [EmpleadoControlador::class, 'eliminar'])->name('empleado.eliminar');

// Cambiar Estado Empleado
Route::patch('/empleado/{empleado}/alternar-estado', [EmpleadoControlador::class, 'alternarEstado'])->name('empleado.alternarEstado');

// Importar Empleados CSV
Route::post('/empleado/importar', [EmpleadoControlador::class, 'importar'])->name('empleado.importar');

// Historial de accesos
Route::get('/empleado/{empleadoId}/historial', [EmpleadoControlador::class, 'historial'])->name('empleado.historial');

// PDF Historial
Route::get('/empleado/{empleadoId}/generar-pdf', [PdfController::class, 'generatePdf'])->name('empleado.generarPdf');

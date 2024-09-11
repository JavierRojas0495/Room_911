<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PdfController;

// Listar todos los empleados
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');

// Mostrar el formulario de creación
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');

// Almacenar un nuevo empleado
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');

// Obtener las ciudades dependiendo del país seleccionado (AJAX)
Route::get('/getCities/{countryId}', [EmployeeController::class, 'getCities'])->name('employee.getCities');

// Mostrar el formulario de edición para un empleado específico
Route::get('/employee/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');

// Actualizar un empleado existente
Route::put('/employee/{employee}', [EmployeeController::class, 'update'])->name('employee.update');

// Eliminar un empleado
Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

// Cambiar Estado Empleado
Route::patch('/employee/{employee}/toggle-status', [EmployeeController::class, 'toggleStatus'])->name('employee.toggleStatus');

// Importar Empleados CSV
Route::post('/employee/import', [EmployeeController::class, 'import'])->name('employee.import');

// List History
Route::get('/employee/{employeeId}/history', [EmployeeController::class, 'history'])->name('employee.history');

// PDF History
Route::get('/employee/{employeeId}/generate-pdf', [PdfController::class, 'generatePdf'])->name('employee.generatePdf');

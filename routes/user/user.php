<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Ruta para mostrar la lista de usuarios
Route::get('/user', [UserController::class, 'index'])->name('user.index');

// Ruta para mostrar el formulario para crear un nuevo usuario
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');

// Ruta para almacenar un nuevo usuario
Route::post('/user', [UserController::class, 'store'])->name('user.store');

// Ruta para mostrar el formulario de edición de un usuario específico
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');

// Ruta para actualizar un usuario específico
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');

// Ruta para eliminar un usuario específico
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

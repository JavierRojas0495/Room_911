<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/user/create', [UserController::class, 'create'])->name('user.create');

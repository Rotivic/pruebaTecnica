<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormularioController;
use App\Http\Controllers\AuthController;

Route::get('/', [FormularioController::class, 'mostrarLogin']);
Route::get('/formulario', [FormularioController::class, 'mostrarFormulario'])->name('formulario')->middleware('auth');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/procesar-formulario', [FormularioController::class, 'procesarFormulario'])->name('procesar.formulario');
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormularioController;
use App\Http\Controllers\AuthController;

// Rutas de login
Route::get('/', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/inicio-sesion', [AuthController::class, 'login'])->name('inicio-sesion');

// Rutas de muestreo y procesado de formulario
Route::middleware('auth')->group(function () {
    Route::get('/formulario', [FormularioController::class, 'mostrarFormulario'])->name('formulario');
    Route::post('/procesar-formulario', [FormularioController::class, 'procesarFormulario'])->name('procesar.formulario');
});

// Route::get('/formulario', [FormularioController::class, 'mostrarFormulario'])->middleware('auth')->name('formulario');
// Route::post('/procesar-formulario', [FormularioController::class, 'procesarFormulario'])->middleware('auth')->name('procesar.formulario');
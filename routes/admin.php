<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AvisoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsuarioController;

//corregir si es admin o isAdmin
Route::prefix('admin')->name('admin.')->middleware(['auth','is_admin'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('avisos', AvisoController::class)->except(['show']);
    Route::get('avisos/{aviso}/show', [AvisoController::class,'show'])->name('avisos.show'); // si prefieres show
    Route::post('avisos/{aviso}/toggle-estado', [AvisoController::class,'toggleEstado'])->name('avisos.toggleEstado');
    Route::post('avisos/{aviso}/toggle-destacado', [AvisoController::class,'toggleDestacado'])->name('avisos.toggleDestacado');
    //rutas de aprobacion y rechazo
    Route::patch('avisos/{aviso}/aprobar', [AvisoController::class, 'aprobar'])->name('avisos.aprobar');
    Route::patch('avisos/{aviso}/rechazar', [AvisoController::class, 'rechazar'])->name('avisos.rechazar');
    // Rutas para la gestión de usuarios
    Route::resource('usuarios', UsuarioController::class);

});

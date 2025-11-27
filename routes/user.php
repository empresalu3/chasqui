<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AvisoController as UserAvisoController;
use App\Http\Controllers\User\AvisoController;
use App\Http\Controllers\User\PerfilController;



//Route::get('/', function () {
  //  return view('user.home');
//})->name('home'); //  muy importante

Route::prefix('user')->name('user.')->middleware(['auth', 'is_user'])->group(function () {
    Route::get('/home', [UserAvisoController::class, 'index'])->name('home');
    Route::get('/avisos', [UserAvisoController::class, 'index'])->name('avisos.index');
    Route::get('/avisos/create', [UserAvisoController::class, 'create'])->name('avisos.create');
    Route::post('/avisos', [UserAvisoController::class, 'store'])->name('avisos.store');
    Route::get('/mis-avisos', [AvisoController::class, 'indexUser'])->name('avisos.mis-avisos');
    //ruta para ver detalles del aviso
    Route::get('/avisos/{id}', [UserAvisoController::class, 'show'])->name('avisos.show');
    //mostrar por categoria
    Route::get('/categoria/{id}', [UserAvisoController::class, 'porCategoria'])->name('avisos.categoria');
    //perfil de usuario
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::post('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');
    Route::post('/perfil/password', [PerfilController::class, 'updatePassword'])->name('perfil.password');
    //editar aviso
    Route::get('/avisos/{id}/edit', [UserAvisoController::class, 'edit'])->name('avisos.edit');
    Route::put('/avisos/{id}', [UserAvisoController::class, 'update'])->name('avisos.update');
    //eliminar aviso
    Route::delete('/avisos/{id}', [UserAvisoController::class, 'destroy'])->name('avisos.destroy');
});
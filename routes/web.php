<?php
use App\Http\Controllers\ProfileController;
use 
Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PaginaController;
//use App\Http\Controllers\AvisoController;

// Página principal pública
//Route::get('/', function () {
  //  return view('welcome');
//})->name('home');
//Route::get('/avisos/search', [AvisoController::class, 'search'])->name('avisos.search');


//actualRoute::get('/',[PublicController::class,'home'])->name('public.home');

Route::get('/', function () {

    // Si el usuario está logueado
    if (Auth::check()) {

        // ADMIN (role_id = 1)
        if (Auth::user()->role_id == 1) {
            return redirect()->route('admin.dashboard');
        }

        // USUARIO (role_id = 2)
        if (Auth::user()->role_id == 2) {
            return redirect()->route('user.home');
        }
    }

    // Si NO está logueado → página pública
    return app(PublicController::class)->home();

})->name('public.home');


//Route::get('/avisos/search', [PublicController::class, 'search'])->name('avisos.search');
//Route::get('/avisos/{id}', [PublicController::class, 'detalleAviso'])->name('avisos.detalle');
//Route::get('/home', [PublicController::class, 'home'])->name('public.home');
Route::get('/categoria/{id}', [PublicController::class, 'PorCategoria'])->name('public.categoria');
Route::get('/buscar', [PublicController::class, 'buscar'])->name('public.buscar');

//rutas de paginas estáticas
Route::get('/sobre-nosotros', [PaginaController::class, 'sobre'])->name('public.sobre');
Route::get('/contacto', [PaginaController::class, 'contacto'])->name('public.contacto');
Route::post('/contacto/enviar', [PaginaController::class, 'enviarContacto'])->name('public.contacto.enviar');

Route::get('/blog', [PaginaController::class, 'blog'])->name('public.blog');
Route::get('/blog/{slug}', [PaginaController::class, 'blogDetalle'])->name('public.blog.detalle');

Route::get('/prensa', [PaginaController::class, 'prensa'])->name('public.prensa');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

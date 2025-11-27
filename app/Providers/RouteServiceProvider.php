<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->routes(function () {
            // Rutas web normales
        //    Route::middleware('web')
              //  ->group(base_path('routes/web.php'));

            // Rutas para administrador
           // Route::middleware(['web', 'auth', 'is_admin'])
             //   ->prefix('admin')
                //->name('admin.')
               // ->group(base_path('routes/admin.php'));

            // Rutas para usuario
         //   Route::middleware(['web', 'auth', 'is_user'])
            //    ->prefix('user')
              //  ->name('user.')
                //->group(base_path('routes/user.php'));
        });
    }
}

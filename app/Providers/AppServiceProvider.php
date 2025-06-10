<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Carrito;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
public function boot(): void
{
    // View Composer para todas las vistas (*) → se ejecuta cada vez que se renderiza una vista
    View::composer('*', function ($view) {
        $totalCarrito = 0;
  // Si el usuario está autenticado
        if (Auth::check()) {
            // Obtiene el carrito del usuario con sus detalles (productos)
            $carrito = Carrito::where('ID_Usuario', Auth::id())->with('detalles')->first();
// Si tiene carrito, suma las cantidades de todos los productos
            if ($carrito) {
                $totalCarrito = $carrito->detalles->sum('Cantidad');
            }
        }
// Comparte la variable $totalCarrito con todas las vistas de la aplicación
        $view->with('totalCarrito', $totalCarrito);
    });
}

}

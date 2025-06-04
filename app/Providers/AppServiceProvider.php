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
    View::composer('*', function ($view) {
        $totalCarrito = 0;

        if (Auth::check()) {
            $carrito = Carrito::where('ID_Usuario', Auth::id())->with('detalles')->first();

            if ($carrito) {
                $totalCarrito = $carrito->detalles->sum('Cantidad');
            }
        }

        $view->with('totalCarrito', $totalCarrito);
    });
}

}

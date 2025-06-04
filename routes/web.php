<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PrivacidadController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;

// AUTENTICACIÓN
Route::get('/registro', [RegistroController::class, 'show'])->name('register');
Route::post('/registro', [RegistroController::class, 'register'])->name('register.post');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/verificar-email/{token}', [RegistroController::class, 'verificarEmail'])->name('verificar.email');

// Prueba de correo
Route::get('/test-mail', function () {
    Mail::raw('Esto es un test de Mailjet desde Laravel', function ($message) {
        $message->to('dariomartinezvila11@gmail.com')->subject('📧 Prueba directa de Mailjet');
    });
    return 'Correo enviado.';
});

// Recuperación de contraseña
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


// INICIO
Route::get('/', [HomeController::class, 'index'])->name('inicio');


// TRABAJOS
Route::get('/trabajos', [TrabajoController::class, 'index'])->name('trabajos');
Route::get('/trabajos/categoria/{categoria}', [TrabajoController::class, 'filtrarPorCategoria'])->name('trabajos.categoria');

// ADMIN: Crear, editar, borrar trabajos (requiere login)
Route::middleware('auth')->group(function () {
    Route::get('/trabajos/create', [TrabajoController::class, 'create'])->name('trabajos.create');
    Route::post('/trabajos', [TrabajoController::class, 'store'])->name('trabajos.store');
    Route::get('/trabajos/{id}/edit', [TrabajoController::class, 'edit'])->name('trabajos.edit');
    Route::put('/trabajos/{id}', [TrabajoController::class, 'update'])->name('trabajos.update');
    Route::delete('/trabajos/{id}', [TrabajoController::class, 'destroy'])->name('trabajos.destroy');
});

// ESTA DEBE IR AL FINAL DE TRABAJOS
Route::get('/trabajos/{id}', [TrabajoController::class, 'show'])->name('trabajos.show');

// TIENDA
Route::get('/tienda', [TiendaController::class, 'index'])->name('tienda.index');

// FAVORITOS (autenticado)
Route::middleware('auth')->group(function () {
    Route::post('/favoritos/toggle/{id}', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');

    Route::get('/tienda/categoria/favoritos', [TiendaController::class, 'favoritos'])->name('tienda.favoritos');
    Route::get('/tienda/categoria/{categoria}', [TiendaController::class, 'filtrarPorCategoria'])->name('tienda.categoria');

    // ADMIN: Crear, editar, borrar productos
    Route::get('/tienda/create', [TiendaController::class, 'create'])->name('tienda.create');
    Route::post('/tienda', [TiendaController::class, 'store'])->name('tienda.store');
    Route::get('/tienda/{id}/edit', [TiendaController::class, 'edit'])->name('tienda.edit');
    Route::put('/tienda/{id}', [TiendaController::class, 'update'])->name('tienda.update');
    Route::delete('/tienda/{id}', [TiendaController::class, 'destroy'])->name('tienda.destroy');

    // CARRITO
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::put('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');

    // CHECKOUT Y PEDIDOS
    Route::post('/carrito/finalizar', [PedidoController::class, 'finalizar'])->name('carrito.finalizar');
    Route::get('/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');
    Route::post('/procesar-pedido', [PedidoController::class, 'procesarPedido'])->name('pedido.procesar');
    Route::get('/pedido/confirmacion', [PedidoController::class, 'confirmacion'])->name('pedido.confirmacion');
});

// ESTA DEBE IR DESPUÉS de las otras rutas tienda
Route::get('/tienda/{id}', [TiendaController::class, 'show'])->name('tienda.show');

// BLOG (Público)
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

// BLOG ADMIN (Requiere login)
Route::middleware('auth')->group(function () {
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
});

// ESTA DEBE IR AL FINAL (muy importante)
Route::get('/blog/{id}', [BlogController::class, 'show']);



// CONTACTO
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');
Route::post('/enviar-contacto', [ContactoController::class, 'enviar'])->name('enviar.contacto');

// COMENTARIOS
Route::post('/trabajos/{id}/comentario', [ComentarioController::class, 'store'])->name('comentarios.guardar');
Route::post('/trabajos/{proyectoId}/comentario/borrar', [ComentarioController::class, 'borrar'])->name('comentarios.borrar');


// PRIVACIDAD
Route::get('/privacidad', [PrivacidadController::class, 'index'])->name('privacidad');
Route::post('/privacidad/cambiar-contrasena', [PrivacidadController::class, 'cambiarContrasena'])->name('privacidad.cambiar');
Route::post('/privacidad/actualizar-correo', [PrivacidadController::class, 'actualizarCorreo'])->name('privacidad.actualizarCorreo');

// SOBRE NOSOTROS
Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

// POLITICA DE PRIVACIDAD
Route::get('/politica-privacidad', function () {
    return view('politicaprivacidad');
})->name('politicaprivacidad');

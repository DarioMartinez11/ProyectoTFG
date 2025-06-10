<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\Producto;

class CarritoController extends Controller
{
    // Muestra los productos en el carrito del usuario autenticado
    public function index()
    {
        $carrito = Carrito::where('ID_Usuario', Auth::id())->first();
        $productos = $carrito ? $carrito->detalles()->with('producto')->get() : collect();

        return view('carrito.index', compact('productos'));
    }

public function agregar($id)
{
    $usuarioId = Auth::id();
    $producto = Producto::findOrFail($id);

    // Validar que haya stock disponible
    if ($producto->Stock < 1) {
        return redirect()->back()->with('error', 'Producto sin stock disponible');
    }

    $carrito = Carrito::firstOrCreate(['ID_Usuario' => $usuarioId]);

    $detalle = DetalleCarrito::firstOrNew([
        'ID_Carrito' => $carrito->ID_Carrito,
        'ID_Producto' => $producto->ID_Producto,
    ]);

    $cantidadActual = $detalle->exists ? $detalle->Cantidad : 0;

    if ($cantidadActual >= $producto->Stock) {
        return redirect()->back()->with('error', 'No puedes agregar más unidades de las disponibles');
    }

    $detalle->Cantidad = $cantidadActual + 1;
    $detalle->save();

    return redirect()->route('carrito.index')->with('success', 'Producto añadido al carrito');
}


    public function eliminar($id)
    {
        $usuarioId = Auth::id();
        $carrito = Carrito::where('ID_Usuario', $usuarioId)->first();

        if ($carrito) {
            DetalleCarrito::where('ID_Carrito', $carrito->ID_Carrito)
                ->where('ID_Producto', $id)
                ->delete();
        }

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito');
    }

    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $carrito = Carrito::where('ID_Usuario', Auth::id())->first();

        if (!$carrito) return redirect()->back()->with('error', 'Carrito no encontrado');

       DetalleCarrito::where('ID_Carrito', $carrito->ID_Carrito)
              ->where('ID_Producto', $id)
              ->update(['Cantidad' => $request->cantidad]);


        return redirect()->back()->with('success', 'Cantidad actualizada');
    }

     // Muestra la vista de resumen del carrito para proceder al pago (checkout)
    public function checkout()
    {
        $carrito = Carrito::where('ID_Usuario', Auth::id())->first();
        $productos = $carrito ? $carrito->detalles()->with('producto')->get() : collect();

        return view('checkout', compact('productos'));
    }
}

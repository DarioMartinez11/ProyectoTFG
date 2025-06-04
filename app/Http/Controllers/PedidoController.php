<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Mail\CompraRealizada;

class PedidoController extends Controller
{
    public function procesarPedido(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'direccion' => 'required|string',
            'email' => 'required|email',
            'ciudad' => 'required|string',
            'telefono' => 'required|digits_between:8,15',
            'tarjeta' => 'required|digits_between:13,19',
            'expiracion' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => 'required|digits:3',
        ]);

        $usuarioId = Auth::id();
        $carrito = Carrito::where('ID_Usuario', $usuarioId)->first();

        if (!$carrito || $carrito->detalles->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        DB::beginTransaction();

        try {
            $pedido = Pedido::create([
                'Fecha' => now(),
                'Total' => 0,
                'Estado' => 'pendiente',
                'ID_Usuario' => $usuarioId,
                'Direccion_Envio' => $request->direccion . ', ' . $request->ciudad,
                'Metodo_Pago' => 'Tarjeta',
            ]);

            $total = 0;

            foreach ($carrito->detalles as $item) {
                $producto = $item->producto;
                $precio = $producto->Precio;
                $subtotal = $precio * $item->Cantidad;
                $total += $subtotal;

                DetallePedido::create([
                    'ID_Pedido' => $pedido->ID_Pedido,
                    'ID_Producto' => $item->ID_Producto,
                    'Cantidad' => $item->Cantidad,
                    'Precio_Unitario' => $precio,
                ]);

                // ✅ Descontar stock sin usar timestamps
                $producto->timestamps = false;
                $producto->Stock -= $item->Cantidad;
                $producto->save();
            }

            $pedido->update(['Total' => $total]);

            // Vaciar carrito
            DetalleCarrito::where('ID_Carrito', $carrito->ID_Carrito)->delete();

            // Enviar correo
            $ultimos4 = substr($request->tarjeta, -4);
            $datos = array_merge($request->all(), [
                'total' => $total,
                'ultimos4' => $ultimos4,
            ]);

            Mail::to($request->email)->send(new CompraRealizada($datos, $carrito->detalles));

            DB::commit();
            return redirect()->route('pedido.confirmacion')->with('success', '✅ Gracias por tu compra. Revisa tu correo.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('carrito.index')->with('error', '❌ Ocurrió un error al procesar tu pedido.');
        }
    }

    public function confirmacion()
    {
        return view('pedido.confirmacion');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorito;
use App\Models\Producto;

class FavoritoController extends Controller
{
  
// Alterna (agrega o elimina) un producto de la lista de favoritos del usuario
public function toggle($id)
{
    $userId = Auth::id(); // Obtiene el ID del usuario autenticado

     // Busca si el producto ya está marcado como favorito por este usuario
    $favorito = Favorito::where('ID_Usuario', $userId)
                        ->where('ID_Producto', $id)
                        ->first();

    if ($favorito) {
        // Si ya es favorito, lo elimina (quita de la lista de favoritos)
        Favorito::where('ID_Usuario', $userId)
                ->where('ID_Producto', $id)
                ->delete();
        return response()->json(['status' => 'removed']);
    } else {
        // Si no es favorito, lo agrega
        Favorito::create([
            'ID_Usuario' => $userId,
            'ID_Producto' => $id
        ]);
        // Respuesta JSON indicando que se ha agregado
        return response()->json(['status' => 'added']);
    }
}


}

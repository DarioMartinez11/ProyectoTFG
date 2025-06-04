<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorito;
use App\Models\Producto;

class FavoritoController extends Controller
{
  
public function toggle($id)
{
    $userId = Auth::id();

    $favorito = Favorito::where('ID_Usuario', $userId)
                        ->where('ID_Producto', $id)
                        ->first();

    if ($favorito) {
        Favorito::where('ID_Usuario', $userId)
                ->where('ID_Producto', $id)
                ->delete();
        return response()->json(['status' => 'removed']);
    } else {
        Favorito::create([
            'ID_Usuario' => $userId,
            'ID_Producto' => $id
        ]);
        return response()->json(['status' => 'added']);
    }
}


}

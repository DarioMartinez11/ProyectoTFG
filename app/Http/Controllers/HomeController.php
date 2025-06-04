<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
public function index()
{
    $mejoresTrabajos = DB::table('proyecto')
        ->select('proyecto.ID_Proyecto', 'proyecto.Titulo', 'proyecto.ImagenAntes as Imagen', DB::raw('AVG(comentario.Valoracion) as promedio'))
        ->leftJoin('comentario', 'comentario.ID_Proyecto', '=', 'proyecto.ID_Proyecto')
        ->groupBy('proyecto.ID_Proyecto', 'proyecto.Titulo', 'proyecto.ImagenAntes')
        ->orderByDesc('promedio')
        ->limit(3)
        ->get();

    return view('inicio', compact('mejoresTrabajos'));
}
}

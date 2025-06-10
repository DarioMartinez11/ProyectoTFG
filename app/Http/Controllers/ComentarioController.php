<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;

class ComentarioController extends Controller
{
   // Almacena un nuevo comentario para un proyecto específico
    public function store(Request $request, $id)
    {
        $request->validate([
            'Texto' => 'required|string',
            'Valoracion' => 'required|integer|between:1,5',
        ]);

        Comentario::create([
            'ID_Usuario'   => Auth::id(),
            'ID_Proyecto'  => $id,
            'Texto'        => $request->Texto,
            'Fecha'        => now(),
            'Valoracion'   => $request->Valoracion,
        ]);

        return back()->with('success', 'Comentario enviado correctamente.');
    }

    /**
     * Guardar un nuevo comentario solo si no existe uno del usuario en ese proyecto
     */
    public function guardar(Request $request, $idProyecto)
    {
        $request->validate([
            'Texto'      => 'required|string',
            'Valoracion' => 'required|integer|between:1,5',
        ]);

        $usuarioId = auth()->user()->ID_Usuario;

        // Verificar si ya comentó
        $comentarioExistente = Comentario::where('ID_Usuario', $usuarioId)
                                         ->where('ID_Proyecto', $idProyecto)
                                         ->first();

        if ($comentarioExistente) {
            return redirect()->back()->with('error', 'Ya has comentado este proyecto.');
        }

        // Crear nuevo comentario
        Comentario::create([
            'ID_Usuario'   => $usuarioId,
            'ID_Proyecto'  => $idProyecto,
            'Texto'        => $request->Texto,
            'Fecha'        => now(),
            'Valoracion'   => $request->Valoracion,
        ]);

        return redirect()->back()->with('success', 'Comentario enviado correctamente.');
    }

    /**
     * Borrar el comentario del usuario sobre un proyecto específico
     */
public function borrar(Request $request, $proyectoId)
{
    $usuarioId = auth()->user()->ID_Usuario;

    Comentario::where('ID_Usuario', $usuarioId)
              ->where('ID_Proyecto', $proyectoId)
              ->delete();

    return back()->with('success', 'Comentario eliminado correctamente.');
}

}

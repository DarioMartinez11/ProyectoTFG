<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Comentario;

class TrabajoController extends Controller
{
    // Muestra una lista aleatoria de hasta 70 proyectos, incluyendo la media de valoraciones
    public function index()
    {
        $proyectos = Proyecto::with('comentarios')->inRandomOrder()->take(70)->get();

        foreach ($proyectos as $proyecto) {
            $proyecto->media_valoracion = $proyecto->comentarios->avg('Valoracion');
        }

        return view('trabajos', compact('proyectos'));
    }

    // Muestra un proyecto en detalle, incluyendo sus comentarios y valoración promedio
    public function show($id)
    {
        $proyecto = Proyecto::with(['comentarios.usuario'])->findOrFail($id);

        // Comentarios del proyecto ordenados por fecha descendente
        $comentarios = $proyecto->comentarios->sortByDesc('Fecha');

        // Media redondeada
        $mediaRedondeada = $comentarios->avg('Valoracion');
        $mediaRedondeada = $mediaRedondeada ? number_format($mediaRedondeada, 1) : null;

        // Comentario del usuario actual (si está autenticado)
        $comentarioUsuario = null;
        if (auth()->check()) {
            $comentarioUsuario = Comentario::where('ID_Usuario', auth()->user()->ID_Usuario)
                                           ->where('ID_Proyecto', $id)
                                           ->first();
        }

        return view('trabajos.show', compact('proyecto', 'comentarios', 'mediaRedondeada', 'comentarioUsuario'));
    }

    // Filtra proyectos por categoría y calcula su media de valoraciones
    public function filtrarPorCategoria($categoria)
    {
        $proyectos = Proyecto::with('comentarios')
            ->where('Categoria', $categoria)
            ->get();

        foreach ($proyectos as $proyecto) {
            $proyecto->media_valoracion = $proyecto->comentarios->avg('Valoracion');
        }

        return view('trabajos', compact('proyectos', 'categoria'));
    }

    public function create()
    {
        return view('trabajos.create');
    }

    // Guarda un nuevo proyecto con imágenes opcionales (antes/después)
    public function store(Request $request)
    {
        $request->validate([
            'Titulo' => 'required|string|max:255',
            'Descripcion' => 'nullable|string',
            'Categoria' => 'required|string',
            'Fecha' => 'required|date',
            'ImagenAntes' => 'nullable|image|max:2048',
            'ImagenDespues' => 'nullable|image|max:2048',
        ]);

        $proyecto = new Proyecto();
        $proyecto->Titulo = $request->Titulo;
        $proyecto->Descripcion = $request->Descripcion;
        $proyecto->Categoria = $request->Categoria;
        $proyecto->Fecha = $request->Fecha;

        if ($request->hasFile('ImagenAntes')) {
            $archivo1 = $request->file('ImagenAntes');
            $nombre1 = time() . '_antes_' . $archivo1->getClientOriginalName();
            $archivo1->move(public_path('img/proyectos'), $nombre1);
            $proyecto->ImagenAntes = 'img/proyectos/' . $nombre1;
        }

        if ($request->hasFile('ImagenDespues')) {
            $archivo2 = $request->file('ImagenDespues');
            $nombre2 = time() . '_despues_' . $archivo2->getClientOriginalName();
            $archivo2->move(public_path('img/proyectos'), $nombre2);
            $proyecto->ImagenDespues = 'img/proyectos/' . $nombre2;
        }

        $proyecto->save();

        return redirect()->route('trabajos')->with('success', 'Proyecto creado correctamente.');
    }

    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('trabajos.edit', compact('proyecto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Titulo' => 'required|string|max:255',
            'Descripcion' => 'nullable|string',
            'Categoria' => 'required|string',
            'Fecha' => 'required|date',
            'ImagenAntes' => 'nullable|image|max:2048',
            'ImagenDespues' => 'nullable|image|max:2048',
        ]);

        $proyecto = Proyecto::findOrFail($id);
        $proyecto->Titulo = $request->Titulo;
        $proyecto->Descripcion = $request->Descripcion;
        $proyecto->Categoria = $request->Categoria;
        $proyecto->Fecha = $request->Fecha;

        if ($request->hasFile('ImagenAntes')) {
            $archivo1 = $request->file('ImagenAntes');
            $nombre1 = time() . '_antes_' . $archivo1->getClientOriginalName();
            $archivo1->move(public_path('img/proyectos'), $nombre1);
            $proyecto->ImagenAntes = 'img/proyectos/' . $nombre1;
        }

        if ($request->hasFile('ImagenDespues')) {
            $archivo2 = $request->file('ImagenDespues');
            $nombre2 = time() . '_despues_' . $archivo2->getClientOriginalName();
            $archivo2->move(public_path('img/proyectos'), $nombre2);
            $proyecto->ImagenDespues = 'img/proyectos/' . $nombre2;
        }

        $proyecto->save();

        return redirect()->route('trabajos')->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return redirect()->route('trabajos')->with('success', 'Proyecto eliminado.');
    }
}

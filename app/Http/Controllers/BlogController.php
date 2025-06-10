<?php

namespace App\Http\Controllers;

use App\Models\ArticuloBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    // Muestra la lista de artículos ordenados por fecha descendente
    public function index()
    {
        $posts = ArticuloBlog::orderByDesc('Fecha')->get();

        return view('blog.blog', [
            'posts' => $posts,
            'usuario' => Auth::user(),
        ]);
    }

    // Muestra un artículo específico por su ID
    public function show($id)
    {
        $post = ArticuloBlog::findOrFail($id);
        return response()->json($post);
    }

    public function create()
    {
        return view('blog.create');
    }

    // Almacena un nuevo artículo en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'Titulo' => 'required|string|max:255',
            'Contenido' => 'required|string',
            'Imagen' => 'nullable|image|max:2048',
        ]);

        $imagenPath = null;
        if ($request->hasFile('Imagen')) {
            $archivo = $request->file('Imagen');
            $nombre = time() . '_' . $archivo->getClientOriginalName();
            $rutaDestino = public_path('img/blog/');
            $archivo->move($rutaDestino, $nombre);
            $imagenPath = 'img/blog/' . $nombre;
        }

        ArticuloBlog::create([
            'Titulo' => $request->Titulo,
            'Contenido' => $request->Contenido,
            'Fecha' => now(),
            'Imagen' => $imagenPath,
            'ID_Usuario' => auth()->id(),
        ]);

        return redirect()->route('blog')->with('success', 'Artículo creado correctamente.');
    }

    public function edit($id)
    {
        $post = ArticuloBlog::findOrFail($id);
        return view('blog.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = ArticuloBlog::findOrFail($id);

        $request->validate([
            'Titulo' => 'required|string|max:255',
            'Contenido' => 'required|string',
            'Imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('Imagen')) {
            $archivo = $request->file('Imagen');
            $nombre = time() . '_' . $archivo->getClientOriginalName();
            $rutaDestino = public_path('img/blog/');
            $archivo->move($rutaDestino, $nombre);
            $post->Imagen = 'img/blog/' . $nombre;
        }

        $post->Titulo = $request->Titulo;
        $post->Contenido = $request->Contenido;
        $post->save();

        return redirect()->route('blog')->with('success', 'Artículo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $post = ArticuloBlog::findOrFail($id);

        // (Opcional) Eliminar imagen si existe
        if ($post->Imagen && file_exists(public_path($post->Imagen))) {
            unlink(public_path($post->Imagen));
        }

        $post->delete();

        return redirect()->route('blog')->with('success', 'Artículo eliminado.');
    }
}

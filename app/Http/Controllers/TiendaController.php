<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Favorito;
use App\Models\Imagen; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TiendaController extends Controller
{
    // Mostrar todos los productos con stock
    public function index(Request $request)
    {
        $query = Producto::where('Stock', '>', 0);

        // Orden por precio
        if ($request->orden === 'mayor') {
            $query->orderBy('Precio', 'desc');
        } elseif ($request->orden === 'menor') {
            $query->orderBy('Precio', 'asc');
        } else {
            $query->inRandomOrder()->take(30); // valor por defecto
        }

        $productos = $query->get();

        $favoritos = [];
        if (Auth::check()) {
            $favoritos = Auth::user()->favoritos()->pluck('ID_Producto')->toArray();
        }

        return view('tienda', compact('productos', 'favoritos'));
    }

    // Mostrar producto individual
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('tienda.show', compact('producto'));
    }

    // Filtrar productos por categoría
    public function filtrarPorCategoria(Request $request, $categoria)
    {
        $query = Producto::where('Categoria', $categoria)
                         ->where('Stock', '>', 0);

        // Orden por precio dentro de la categoría
        if ($request->orden === 'mayor') {
            $query->orderBy('Precio', 'desc');
        } elseif ($request->orden === 'menor') {
            $query->orderBy('Precio', 'asc');
        }

        $productos = $query->get();

        $favoritos = [];
        if (Auth::check()) {
            $favoritos = Auth::user()->favoritos()->pluck('ID_Producto')->toArray();
        }

        return view('tienda', compact('productos', 'categoria', 'favoritos'));
    }

    // Mostrar solo productos favoritos
    public function favoritos()
    {
        $userId = Auth::id();
        $favoritosIds = Favorito::where('ID_Usuario', $userId)->pluck('ID_Producto');
        $productos = Producto::whereIn('ID_Producto', $favoritosIds)->get();

        return view('tienda', [
            'productos' => $productos,
            'categoria' => 'favoritos',
            'favoritos' => $favoritosIds->toArray(),
        ]);
    }

    // Formulario de creación
    public function create()
    {
        return view('tienda.create');
    }

    // Guardar producto nuevo
public function store(Request $request)
{
    $request->validate([
        'Nombre' => 'required|string|max:255',
        'Descripcion' => 'nullable|string',
        'Precio' => 'required|numeric|min:0',
        'Stock' => 'required|integer|min:0',
        'Categoria' => 'nullable|string|max:100',
        'Imagenes.*' => 'nullable|image|max:2048', 
    ]);

    $producto = new Producto();
    $producto->Nombre = $request->Nombre;
    $producto->Descripcion = $request->Descripcion;
    $producto->Precio = $request->Precio;
    $producto->Stock = $request->Stock;
    $producto->Categoria = $request->Categoria;
    $producto->save();

    // Guardar múltiples imágenes
    if ($request->hasFile('Imagenes')) {
        foreach ($request->file('Imagenes') as $archivo) {
            $nombre = time() . '_' . $archivo->getClientOriginalName();
$archivo->move(public_path('img/tienda'), $nombre);

Imagen::create([
    'producto_id' => $producto->ID_Producto,
    'ruta' => 'img/tienda/' . $nombre,
]);

        }
    }

    return redirect()->route('tienda.index')->with('success', 'Producto creado correctamente.');
}


    // Formulario de edición
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('tienda.edit', compact('producto'));
    }

    // Actualizar producto
public function update(Request $request, $id)
{
    $request->validate([
        'Nombre' => 'required|string|max:255',
        'Descripcion' => 'nullable|string',
        'Precio' => 'required|numeric|min:0',
        'Stock' => 'required|integer|min:0',
        'Categoria' => 'nullable|string|max:100',
        'Imagenes.*' => 'nullable|image|max:2048',
    ]);

    $producto = Producto::findOrFail($id);
    $producto->Nombre = $request->Nombre;
    $producto->Descripcion = $request->Descripcion;
    $producto->Precio = $request->Precio;
    $producto->Stock = $request->Stock;
    $producto->Categoria = $request->Categoria;
    $producto->save();

    // Si hay nuevas imágenes, eliminamos las anteriores
    if ($request->hasFile('Imagenes')) {
        foreach ($producto->imagenes as $imagen) {
            $ruta = public_path($imagen->ruta);
            if (file_exists($ruta)) {
                unlink($ruta); // elimina del sistema de archivos
            }
            $imagen->delete(); // elimina de la BD
        }

        // Guardamos las nuevas
        foreach ($request->file('Imagenes') as $archivo) {
            $nombre = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('img/tienda'), $nombre);

            Imagen::create([
                'producto_id' => $producto->ID_Producto,
                'ruta' => 'img/tienda/' . $nombre,
            ]);
        }
    }

    return redirect()->route('tienda.index')->with('success', 'Producto actualizado correctamente.');
}

    // Eliminar producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('tienda.index')->with('success', 'Producto eliminado.');
    }
}

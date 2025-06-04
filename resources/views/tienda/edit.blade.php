<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar producto | Tienda</title>
    <link rel="stylesheet" href="{{ asset('css/tienda/edit.css') }}">
</head>
<body>

<form action="{{ route('tienda.update', $producto->ID_Producto) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <a href="{{ route('tienda.index') }}" class="close-btn">✖</a>
    <h2>Editar producto</h2>

    <label for="Nombre">Nombre</label>
    <input type="text" id="Nombre" name="Nombre" value="{{ old('Nombre', $producto->Nombre) }}" required>

    <label for="Descripcion">Descripción</label>
    <textarea id="Descripcion" name="Descripcion" rows="4">{{ old('Descripcion', $producto->Descripcion) }}</textarea>

    <label for="Precio">Precio (€)</label>
    <input type="number" step="0.01" id="Precio" name="Precio" value="{{ old('Precio', $producto->Precio) }}" required>

    <label for="Stock">Stock</label>
    <input type="number" id="Stock" name="Stock" value="{{ old('Stock', $producto->Stock) }}" required>

    <label for="Categoria">Categoría</label>
    <select id="Categoria" name="Categoria" required>
        <option value="">-- Selecciona una categoría --</option>
        <option value="ropa" {{ old('Categoria', $producto->Categoria) == 'ropa' ? 'selected' : '' }}>Ropa</option>
        <option value="herramientas" {{ old('Categoria', $producto->Categoria) == 'herramientas' ? 'selected' : '' }}>Herramientas</option>
    </select>

    <label for="Imagen">Cambiar imagen</label>
    <input type="file" id="Imagen" name="Imagenes[]" multiple>


    @if ($producto->Imagen)
        <div class="current-img">
            <p>Imagen actual:</p>
            <img src="{{ asset($producto->Imagen) }}" alt="Imagen actual">
        </div>
    @endif

    <button type="submit" class="submit-btn">💾 Guardar cambios</button>
</form>

</body>
</html>

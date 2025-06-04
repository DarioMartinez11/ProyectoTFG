<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear producto | Tienda</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/tienda/create.css') }}">
</head>
<body>

<form action="{{ route('tienda.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <a href="{{ route('tienda.index') }}" class="close-btn">✖</a>
    <h2>Crear nuevo producto</h2>

    <label for="Nombre">Nombre</label>
    <input type="text" id="Nombre" name="Nombre" value="{{ old('Nombre') }}" required>

    <label for="Descripcion">Descripción</label>
    <textarea id="Descripcion" name="Descripcion" rows="4">{{ old('Descripcion') }}</textarea>

    <label for="Precio">Precio (€)</label>
    <input type="number" step="0.01" id="Precio" name="Precio" value="{{ old('Precio') }}" required>

    <label for="Stock">Stock</label>
    <input type="number" id="Stock" name="Stock" value="{{ old('Stock') }}" required>

    <label for="Categoria">Categoría</label>
    <select id="Categoria" name="Categoria" required>
        <option value="">-- Selecciona una categoría --</option>
        <option value="ropa">Ropa</option>
        <option value="herramientas">Herramientas</option>
    </select>

    <label for="Imagen">Imagen</label>
    <input type="file" id="Imagen" name="Imagenes[]" multiple>

    <button type="submit" class="submit-btn">✅ Crear producto</button>
</form>

</body>
</html>

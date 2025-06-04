<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear artículo | Blog</title>
    <link rel="stylesheet" href="{{ asset('css/blog/create.css') }}">
</head>
<body>

<form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <a href="{{ route('blog') }}" class="close-btn">✖</a>
    <h2>Crear nuevo artículo</h2>

    <label for="Titulo">Título</label>
    <input type="text" id="Titulo" name="Titulo" value="{{ old('Titulo') }}" required>

    <label for="Contenido">Contenido</label>
    <textarea id="Contenido" name="Contenido" rows="6" required>{{ old('Contenido') }}</textarea>

    <label for="Imagen">Imagen (opcional)</label>
    <input type="file" id="Imagen" name="Imagen">

    <button type="submit" class="submit-btn">✅ Publicar artículo</button>
</form>

</body>
</html>
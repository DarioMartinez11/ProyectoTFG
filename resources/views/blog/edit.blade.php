<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar artículo | Blog</title>
    <link rel="stylesheet" href="{{ asset('css/blog/edit.css') }}">
</head>
<body>

<form action="{{ route('blog.update', $post->ID_Articulo) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <a href="{{ route('blog') }}" class="close-btn">✖</a>
    <h2>Editar artículo del blog</h2>

    <label for="Titulo">Título</label>
    <input type="text" id="Titulo" name="Titulo" value="{{ old('Titulo', $post->Titulo) }}" required>

    <label for="Contenido">Contenido</label>
    <textarea id="Contenido" name="Contenido" rows="6">{{ old('Contenido', $post->Contenido) }}</textarea>

    <label for="Imagen">Cambiar imagen</label>
    <input type="file" id="Imagen" name="Imagen">

    @if ($post->Imagen)
        <div class="current-img">
            <p>Imagen actual:</p>
            <img src="{{ asset($post->Imagen) }}" alt="Imagen actual">
        </div>
    @endif

    <button type="submit" class="submit-btn">💾 Guardar cambios</button>
</form>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Trabajo | Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/trabajos/edit.css') }}">
</head>
<body>

    <form action="{{ route('trabajos.update', $proyecto->ID_Proyecto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <a href="{{ route('trabajos') }}" class="btn-x" title="Volver">✖</a>

        <h1>Editar trabajo</h1>

        <div class="form-group">
            <label for="Titulo">Título</label>
            <input type="text" name="Titulo" id="Titulo" value="{{ old('Titulo', $proyecto->Titulo) }}" required>
        </div>

        <div class="form-group">
            <label for="Descripcion">Descripción</label>
            <textarea name="Descripcion" id="Descripcion" rows="3" required>{{ old('Descripcion', $proyecto->Descripcion) }}</textarea>
        </div>

        <div class="form-group">
            <label for="Categoria">Categoría</label>
            <select name="Categoria" id="Categoria" required>
                <option value="">-- Selecciona una categoría --</option>
                <option value="interior" {{ $proyecto->Categoria == 'interior' ? 'selected' : '' }}>Interior</option>
                <option value="fachadas" {{ $proyecto->Categoria == 'fachadas' ? 'selected' : '' }}>Fachadas</option>
                <option value="restauraciones" {{ $proyecto->Categoria == 'restauraciones' ? 'selected' : '' }}>Restauraciones</option>
                <option value="muebles" {{ $proyecto->Categoria == 'muebles' ? 'selected' : '' }}>Muebles</option>
            </select>
        </div>

        <div class="form-group">
            <label for="Fecha">Fecha del proyecto</label>
            <input type="date" name="Fecha" id="Fecha" value="{{ old('Fecha', $proyecto->Fecha) }}" required>
        </div>

        <div class="form-group">
            <label for="ImagenAntes">Imagen "Antes"</label>
            <input type="file" name="ImagenAntes" id="ImagenAntes" accept="image/*">
            @if($proyecto->ImagenAntes)
                <div class="imagen-actual">📷 Imagen actual: <a href="{{ asset($proyecto->ImagenAntes) }}" target="_blank" style="color:#e50914;">Ver imagen</a></div>
            @endif
        </div>

        <div class="form-group">
            <label for="ImagenDespues">Imagen "Después"</label>
            <input type="file" name="ImagenDespues" id="ImagenDespues" accept="image/*">
            @if($proyecto->ImagenDespues)
                <div class="imagen-actual">📷 Imagen actual: <a href="{{ asset($proyecto->ImagenDespues) }}" target="_blank" style="color:#e50914;">Ver imagen</a></div>
            @endif
        </div>

        <button type="submit" class="submit-btn">💾 Guardar cambios</button>
    </form>

</body>
</html>

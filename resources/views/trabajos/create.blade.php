<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Trabajo | Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/trabajos/create.css') }}">
</head>
<body>

<div class="form-wrapper">
    <a href="{{ route('trabajos') }}" class="cerrar" title="Cerrar">✖</a>

    <h2>Crear nuevo trabajo</h2>

    @if ($errors->any())
        <div class="error-box">
            <strong>Se encontraron errores:</strong>
            <ul style="margin-top: 10px;">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('trabajos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="Titulo">Título</label>
            <input type="text" name="Titulo" id="Titulo" required>
        </div>

        <div class="form-group">
            <label for="Descripcion">Descripción</label>
            <textarea name="Descripcion" id="Descripcion" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="Categoria">Categoría</label>
            <select name="Categoria" id="Categoria" required>
                <option value="">-- Selecciona una categoría --</option>
                <option value="interior">Interior</option>
                <option value="fachadas">Fachadas</option>
                <option value="restauraciones">Restauraciones</option>
                <option value="muebles">Muebles</option>
            </select>
        </div>

        <div class="form-group">
            <label for="Fecha">Fecha del proyecto</label>
            <input type="date" name="Fecha" id="Fecha" required>
        </div>

        <div class="form-group">
            <label for="ImagenAntes">Imagen "Final"</label>
            <input type="file" name="ImagenAntes" id="ImagenAntes" accept="image/*">
        </div>

        <div class="form-group">
            <label for="ImagenDespues">Imagen "Antigua"</label>
            <input type="file" name="ImagenDespues" id="ImagenDespues" accept="image/*">
        </div>


        </div>

      <div style="text-align: center; margin-top: 30px;">
    <button type="submit" class="submit-btn" style="width: auto; padding: 10px 30px;">
        ✅ Guardar trabajo
    </button>
</div>

    </form>
</div>

</body>
</html>

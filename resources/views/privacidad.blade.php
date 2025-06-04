<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Privacidad | Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/privacidad/privacidad.css') }}">
</head>
<body>

<div class="container">
    <!-- Botón cerrar -->
    <form action="{{ route('inicio') }}">
        <button type="submit" class="close-btn">&times;</button>
    </form>

    <h2>Configuración de Privacidad</h2>

    <!-- Datos del usuario si está autenticado -->
    @if(Auth::check())
        <div class="user-info">
            <div><strong>Nombre:</strong> {{ Auth::user()->Nombre }}</div>
            <div><strong>Correo:</strong> {{ Auth::user()->Email }}</div>
            <div><strong>Fecha de registro:</strong> {{ Auth::user()->Fecha_Registro }}</div>
        </div>
    @endif

    <!-- Mensajes -->
    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert">
            @foreach($errors->all() as $error)
                <div>
                    {{ str_replace([
                        'The password actual field is required.',
                        'The nueva password field must be at least 6 characters.',
                        'The nueva password field confirmation does not match.'
                    ], [
                        'Debes ingresar tu contraseña actual.',
                        'La nueva contraseña debe tener al menos 6 caracteres.',
                        'La confirmación de la nueva contraseña no coincide.'
                    ], $error) }}
                </div>
            @endforeach
        </div>
    @endif

    <!-- Formulario cambio de contraseña -->
    <form method="POST" action="{{ route('privacidad.cambiar') }}">
        @csrf

        <label for="password_actual">Contraseña actual</label>
        <input type="password" name="password_actual" required>

        <label for="nueva_password">Nueva contraseña</label>
        <input type="password" name="nueva_password" required>

        <label for="nueva_password_confirmation">Confirmar nueva contraseña</label>
        <input type="password" name="nueva_password_confirmation" required>

        <div class="forgot">
            <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
        </div>

        <button type="submit" class="btn">Cambiar contraseña</button>
    </form>

    <!-- Botón volver al inicio estilizado -->
    <div class="back-home">
        <a href="{{ route('inicio') }}" id="volverInicio">← Volver a la página de inicio</a>
    </div>
</div>

<!-- JS opcional si quieres animaciones adicionales -->
<script>
    document.getElementById('volverInicio').addEventListener('click', function () {
        console.log('Volviendo al inicio...');
    });
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¿Olvidaste tu contraseña?</title>
    <link rel="stylesheet" href="{{ asset('css/auth/forgot.css') }}">

</head>
<body>

<div class="container">
    <h2>¿Olvidaste tu contraseña?</h2>

    @if (session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Tu correo electrónico" required>
        <button type="submit" class="btn">Enviar enlace de recuperación</button>
    </form>

    @if (request()->get('from') !== 'login')
        <div class="back">
            <a href="{{ route('privacidad') }}">← Volver</a>
        </div>
    @endif
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña</title>
    <link rel="stylesheet" href="{{ asset('css/auth/reset.css') }}">
</head>
<body>

<div class="container">
    <h2>Restablecer contraseña</h2>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" value="{{ old('email', $email) }}" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Nueva contraseña" required>
        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
        <button type="submit" class="btn">Guardar nueva contraseña</button>
    </form>
</div>

</body>
</html>

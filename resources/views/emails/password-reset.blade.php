<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="{{ asset('css/emails/password.css') }}">
    
</head>
<body>
    <div class="container">
        <h1>Hola {{ $user->Nombre }}</h1>
        <p>Recibimos una solicitud para restablecer tu contraseña.</p>
        <p>
            <a href="{{ $url }}">Haz clic aquí para cambiar tu contraseña</a>
        </p>
        <p>Si no solicitaste este cambio, puedes ignorar este mensaje.</p>

        <div class="footer">
            Este mensaje fue enviado automáticamente por <strong>Pinturas General</strong>.
        </div>
    </div>
</body>
</html>

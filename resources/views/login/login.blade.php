<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión | Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="logo-text">
            <h1>Inicio de sesión</h1>
            <img src="{{ asset('img/logo/logo.jpg') }}" alt="Logo" style="width: 180px;">
        </div>

        <div class="login-box">
            @if (session('status'))
                <div class="status">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="errors">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <input type="email" name="email" placeholder="Correo electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>

                <div class="forgot-link">
                  <a href="{{ route('password.request', ['from' => 'login']) }}">¿Olvidaste tu contraseña?</a>

                </div>

                <div class="button-row">
                    <button type="submit" class="btn-accept">Aceptar</button>
                    <a href="{{ route('register') }}" class="btn-register">Registro</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const aceptarBtn = document.querySelector('.btn-accept');
        const registroBtn = document.querySelector('.btn-register');

        if (aceptarBtn) {
            aceptarBtn.addEventListener('click', () => {
                aceptarBtn.classList.remove('btn-clicked');
                void aceptarBtn.offsetWidth;
                aceptarBtn.classList.add('btn-clicked');
            });
        }

        if (registroBtn) {
            registroBtn.addEventListener('click', () => {
                registroBtn.classList.remove('btn-clicked');
                void registroBtn.offsetWidth;
                registroBtn.classList.add('btn-clicked');
            });
        }
    </script>
</body>
</html>

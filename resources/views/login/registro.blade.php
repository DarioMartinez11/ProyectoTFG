<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro | Pinturas General</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/login/registro.css') }}">
</head>
<body>
    <div class="register-container">
        <div class="logo-section">
            <h1>Crear cuenta</h1>
            <img src="{{ asset('img/logo/logo.jpg') }}" alt="Logo" style="width: 180px;">
        </div>

        <div class="form-section">
            @if ($errors->any())
                <div class="alert">
                    <strong>⚠️ Por favor, corrige los siguientes errores:</strong>
                    <ul style="margin: 10px 0 0 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
    @csrf
    <input type="text" name="nombre" placeholder="Nombre completo" value="{{ old('nombre') }}" required>
    <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
    <button type="submit" class="btn-register">Registrarse</button>
</form>


<hr style="border: none; border-top: 1px solid #ddd; margin: 16px 0;">

<a href="{{ route('login') }}" class="login-link">Iniciar sesión</a>
        </div>
    </div>

    <script>
        const registerBtn = document.querySelector('.btn-register');
        const loginLink = document.querySelector('.login-link');

        if (registerBtn) {
            registerBtn.addEventListener('click', () => {
                registerBtn.classList.remove('btn-clicked');
                void registerBtn.offsetWidth;
                registerBtn.classList.add('btn-clicked');
            });
        }

        if (loginLink) {
            loginLink.addEventListener('click', () => {
                loginLink.classList.remove('btn-clicked');
                void loginLink.offsetWidth;
                loginLink.classList.add('btn-clicked');
            });
        }
    </script>
</body>
</html>

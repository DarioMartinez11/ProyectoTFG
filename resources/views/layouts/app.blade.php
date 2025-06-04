<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Pinturas General')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="font-family: 'Segoe UI', sans-serif; margin:0; background:#f4f4f4;">

    <header style="background: #e50914; padding: 20px; color:white; text-align:center;">
        <h1>PINTURAS GENERAL</h1>
    </header>

    <main style="padding: 40px;">
        @yield('content')
    </main>

    <footer style="background: #1a1a1a; color: white; text-align: center; padding: 16px; font-size: 14px;">
        &copy; {{ date('Y') }} Pinturas General — Francisco Martinez de Asís
    </footer>

</body>
</html>

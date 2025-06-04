<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Carrito | Pinturas General</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/carrito/carrito.css') }}">
</head>
<body>

<header>
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <h1 style="font-size: 22px; font-weight: bold; margin: 0;">PINTURAS GENERAL</h1>

        <nav style="display: flex; gap: 24px; align-items: center; font-size: 16px; flex-wrap: wrap;">
            <a href="{{ route('inicio') }}">Inicio</a>
            <a href="{{ route('trabajos') }}">Trabajos</a>
            <a href="{{ route('tienda.index') }}">Tienda</a>
            <a href="{{ route('blog') }}">Blog</a>
            <a href="{{ route('contacto') }}">Contacto</a>
            <a href="{{ route('nosotros') }}" style="font-weight: bold;">Sobre Nosotros</a>
        </nav>

        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="https://www.facebook.com/share/1CAt5m8ubn/" target="_blank">
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" style="width: 24px; height: 24px;">
                 </a>
            <a href="https://www.instagram.com/paquitopinturas" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" style="width: 24px;">
            </a>
            <a href="{{ route('carrito.index') }}" style="margin-left: 10px; font-size: 18px; color: white;">
                🛒Carrito @if(isset($totalCarrito) && $totalCarrito > 0) ({{ $totalCarrito }}) @endif
            </a>
            <div style="position: relative; margin-left: 10px;">
                <button onclick="toggleMenu()" style="background: none; border: none; cursor: pointer;">
                    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png"
                         style="width: 30px; height: 30px; border-radius: 50%; background: white; padding: 2px;">
                </button>
                <div id="profile-menu" style="display: none; position: absolute; right: 0; top: 42px; background: white; box-shadow: 0 8px 16px rgba(0,0,0,0.15); border-radius: 10px; overflow: hidden; z-index: 100; min-width: 180px; font-size: 14px; font-weight: 500; color: #444;">
                    <a href="{{ route('privacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">⚙️ Privacidad</a>
                    <a href="{{ route('politicaprivacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">📄 Política de Privacidad</a>
                    <a href="{{ route('logout') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">🔒 Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
</header>

<h2 class="titulo">🛒 Mi Carrito</h2>

<main class="carrito-container">

    @if(session('success'))
        <div style="color: green; margin-bottom: 20px; text-align: center; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    @if ($productos->count() > 0)
        @foreach ($productos as $item)
            <div class="producto">
                <form method="POST" action="{{ route('carrito.eliminar', $item->producto->ID_Producto) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-eliminar">❌</button>
                </form>

                @if ($item->producto->imagenes->count() > 0)
                    <img src="{{ asset($item->producto->imagenes->first()->ruta) }}" alt="{{ $item->producto->Nombre }}">
                @else
                    <img src="{{ asset('img/sin-imagen.png') }}" alt="Sin imagen">
                @endif

                <div class="producto-info">
                    <h3>{{ $item->producto->Nombre }}</h3>
                    <p>💶 Precio: {{ number_format($item->producto->Precio, 2) }} €</p>

                    <form method="POST" action="{{ route('carrito.actualizar', $item->producto->ID_Producto) }}" style="margin: 10px 0;">
                        @csrf
                        @method('PUT')
                        <label for="cantidad_{{ $item->producto->ID_Producto }}">🔢 Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad_{{ $item->producto->ID_Producto }}"
                               value="{{ $item->Cantidad }}" min="1" max="{{ $item->producto->Stock }}"
                               style="width: 60px; padding: 4px; margin-left: 8px; border-radius: 4px; border: 1px solid #ccc;">
                        <button type="submit" style="margin-left: 10px; padding: 5px 10px; background: #007bff; color: white; border: none; border-radius: 4px; font-weight: bold;">
                            Actualizar
                        </button>
                    </form>

                    <p>📦 Subtotal: {{ number_format($item->Cantidad * $item->producto->Precio, 2) }} €</p>
                </div>
            </div>
        @endforeach

        <form method="GET" action="{{ route('carrito.checkout') }}" style="text-align: center; margin-top: 30px;">
            <button type="submit" class="btn-finalizar">✅ Finalizar compra</button>
        </form>
    @else
        <p class="vacio">Tu carrito está vacío.</p>
    @endif

</main>

<footer>
    &copy; {{ date('Y') }} Pinturas General — Francisco Martinez de Asís
</footer>

<script>
    function toggleMenu() {
        const menu = document.getElementById('profile-menu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    window.addEventListener('click', function (e) {
        const menu = document.getElementById('profile-menu');
        if (!e.target.closest('#profile-menu') && !e.target.closest('button')) {
            menu.style.display = 'none';
        }
    });
</script>

</body>
</html>

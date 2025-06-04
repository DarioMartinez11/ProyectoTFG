<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda - Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/tienda/tienda.css') }}">
</head>
<body class="text-black">

<!-- Header Fijo -->
<header style="background-color: #e50914; color: white; padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <h1 style="font-size: 22px; font-weight: bold; margin: 0;">PINTURAS GENERAL</h1>

        <nav style="display: flex; gap: 60px; align-items: center; font-size: 16px; flex-wrap: wrap;">
            <a href="{{ route('inicio') }}" style="color: white;">Inicio</a>
            <a href="{{ route('trabajos') }}" style="color: white;">Trabajos</a>
            <a href="{{ route('tienda.index') }}" style="color: white;">Tienda</a>
            <a href="{{ route('blog') }}" style="color: white;">Blog</a>
            <a href="{{ route('contacto') }}" style="color: white;">Contacto</a>
            <a href="{{ route('nosotros') }}" style="color: white;">Sobre Nosotros</a>
        </nav>

        <div style="display: flex; gap: 10px; align-items: center; position: relative;">
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
                    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" style="width: 30px; height: 30px; border-radius: 50%; background: white; padding: 2px;">
                </button>
                <div id="profile-menu"
                     style="display: none; position: absolute; right: 0; top: 42px; background: white; box-shadow: 0 8px 16px rgba(0,0,0,0.15); border-radius: 10px; overflow: hidden; z-index: 100; min-width: 180px; font-size: 14px; font-weight: 500; color: #444;">
                    <a href="{{ route('privacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">⚙️ Privacidad</a>
                    <a href="{{ route('politicaprivacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">📄 Política de Privacidad</a>
                    <a href="{{ route('logout') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">🔒 Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- Separador para evitar que el header tape el contenido -->
<div style="height: 115px;"></div>

@if(auth()->check() && auth()->user()->Rol === 'admin')
    <a href="{{ route('tienda.create') }}"
       style="position: fixed; top: 85px; left: 20px; background-color: white; color: #e50914; font-size: 26px;
              border: 2px solid #e50914; border-radius: 50%; width: 44px; height: 44px; text-align: center; line-height: 40px;
              box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 1000; text-decoration: none; font-weight: bold;">
        +
    </a>
@endif

<nav id="categorias">
    <a href="{{ route('tienda.index') }}" class="{{ request()->routeIs('tienda.index') ? 'active' : '' }}">🛒 Ver todos</a>
    <a href="{{ route('tienda.categoria', 'ropa') }}" class="{{ (isset($categoria) && $categoria === 'ropa') ? 'active' : '' }}">👕 Ropa</a>
    <a href="{{ route('tienda.categoria', 'herramientas') }}" class="{{ (isset($categoria) && $categoria === 'herramientas') ? 'active' : '' }}">🛠 Herramientas</a>
    <a href="{{ route('tienda.favoritos') }}" class="{{ (isset($categoria) && $categoria === 'favoritos') ? 'active' : '' }}">❤️ Favoritos</a>
</nav>

<div class="orden-box">
    <form method="GET" action="{{ url()->current() }}">
        <select name="orden" onchange="this.form.submit()">
            <option value="">Ordenar por precio</option>
            <option value="menor" {{ request('orden') === 'menor' ? 'selected' : '' }}>🔼 Menor precio</option>
            <option value="mayor" {{ request('orden') === 'mayor' ? 'selected' : '' }}>🔽 Mayor precio</option>
        </select>
    </form>
</div>

<main style="padding: 1px 20px;">
    <div class="grid-productos">
        @foreach ($productos as $producto)
            <div class="producto-card fade-in">
                <a href="{{ route('tienda.show', $producto->ID_Producto) }}" style="text-decoration: none; color: inherit;">
                    @if ($producto->imagenes->first())
                        <div class="imagen">
                            <img src="{{ asset($producto->imagenes->first()->ruta) }}" alt="Imagen de {{ $producto->Nombre }}">
                        </div>
                    @else
                        <div class="imagen" style="background: #eee; display: flex; align-items: center; justify-content: center;">Sin imagen</div>
                    @endif

                    <h3>{{ $producto->Nombre }}</h3>
                    <p style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                        💶 {{ number_format($producto->Precio, 2) }} €
                        @auth
                            @php $esFavorito = in_array($producto->ID_Producto, $favoritos ?? []); @endphp
                            <button onclick="toggleFavorito(event, {{ $producto->ID_Producto }})" style="background: none; border: none; cursor: pointer; padding: 0;">
                                <span class="heart" data-id="{{ $producto->ID_Producto }}" style="font-size: 18px; color: {{ $esFavorito ? 'red' : '#ccc' }};">♥</span>
                            </button>
                        @endauth
                    </p>
                </a>

                @if(auth()->check() && auth()->user()->Rol === 'admin')
                    <div style="margin-top: 8px; display: flex; justify-content: center; gap: 10px;">
                        <a href="{{ route('tienda.edit', $producto->ID_Producto) }}" title="Editar">📝</a>
                        <form action="{{ route('tienda.destroy', $producto->ID_Producto) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este producto?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; cursor: pointer;" title="Eliminar">🗑️</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</main>

<footer style="
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: rgb(2, 2, 2);
    color: white;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    font-size: 14px;
    z-index: 100;
    box-sizing: border-box;
">
    <div style="flex: 1 1 120px;">629 65 24 29</div>
    <div style="flex: 1 1 auto; text-align: center; font-weight: bold;">PINTURAS GENERAL</div>
    <div style="flex: 1 1 180px; text-align: right; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Francisco Martinez de Asís</div>
</footer>


<script>
    function toggleFavorito(event, idProducto) {
        event.preventDefault();
        fetch(`/favoritos/toggle/${idProducto}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const heart = document.querySelector(`.heart[data-id='${idProducto}']`);
            if (heart) {
                heart.style.color = data.status === 'added' ? 'red' : '#ccc';
            }
        })
        .catch(() => alert("Error al actualizar favoritos."));
    }

    document.addEventListener("DOMContentLoaded", function () {
        const elements = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        elements.forEach(el => observer.observe(el));
    });

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

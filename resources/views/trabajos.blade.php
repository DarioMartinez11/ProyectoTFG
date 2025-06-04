<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Trabajos | Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/trabajos/trabajos.css') }}">
</head>
<body>

{{-- Header --}}
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

            {{-- Perfil --}}
            <div style="position: relative;">
                <button onclick="toggleMenu()" style="background: none; border: none; cursor: pointer;">
                    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" style="width: 30px; height: 30px; border-radius: 50%; background: white; padding: 2px;">
                </button>
<div id="profile-menu"
     style="display: none;
            position: absolute;
            right: 0;
            top: 42px;
            background: white;
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
            border-radius: 10px;
            overflow: hidden;
            z-index: 100;
            min-width: 180px;
            font-size: 14px;
            font-weight: 500;
            color: #444;"> <!-- Negro más claro -->

    <a href="{{ route('privacidad') }}"
       style="display: block;
              padding: 10px 15px;
              text-decoration: none;
              color: #444;
              border-bottom: 1px solid #eee;
              transition: background 0.3s ease;">
        ⚙️ Privacidad
    </a>

    <a href="{{ route('politicaprivacidad') }}"
       style="display: block;
              padding: 10px 15px;
              text-decoration: none;
              color: #444;
              border-bottom: 1px solid #eee;
              transition: background 0.3s ease;">
        📄 Política de Privacidad
    </a>

<a href="{{ route('logout') }}" 
style="display: block;
              padding: 10px 15px;
              text-decoration: none;
              color: #444;
              border-bottom: 1px solid #eee;
              transition: background 0.3s ease;">
         🔒 Cerrar sesión
     </a>


</div>

            </div>
        </div>
    </div>
</header>

{{-- Filtros de categoría --}}
<nav id="categorias">
    <a href="{{ route('trabajos') }}" class="{{ request()->routeIs('trabajos') ? 'active' : '' }}">🔁 Ver todos</a>
    <a href="{{ route('trabajos.categoria', 'interior') }}" class="{{ (isset($categoria) && $categoria === 'interior') ? 'active' : '' }}">🖌 Interior</a>
    <a href="{{ route('trabajos.categoria', 'fachadas') }}" class="{{ (isset($categoria) && $categoria === 'fachadas') ? 'active' : '' }}">🏠 Fachadas</a>
    <a href="{{ route('trabajos.categoria', 'restauraciones') }}" class="{{ (isset($categoria) && $categoria === 'restauraciones') ? 'active' : '' }}">🔨 Restauraciones</a>
    <a href="{{ route('trabajos.categoria', 'muebles') }}" class="{{ (isset($categoria) && $categoria === 'muebles') ? 'active' : '' }}">🚪 Muebles</a>
</nav>

{{-- Crear trabajo --}}
@if(auth()->check() && auth()->user()->Rol === 'admin')
    <a href="{{ route('trabajos.create') }}" class="crear-btn" title="Nuevo trabajo">＋</a>
@endif

{{-- Contenido --}}
<main style="padding: 40px 20px 120px;">
    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
        @foreach ($proyectos as $proyecto)
            <div style="width: 200px; text-align: center; border: 1px solid #ccc; padding: 12px; background-color: white;" class="fade-in">
                <a href="{{ route('trabajos.show', $proyecto->ID_Proyecto) }}" style="text-decoration: none; color: inherit;">
                    <div style="background-color: #eee; height: 120px; overflow: hidden;">
                        @if ($proyecto->ImagenAntes)
                            <img src="{{ asset($proyecto->ImagenAntes) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="height: 100%; display: flex; align-items: center; justify-content: center;">Sin imagen</div>
                        @endif
                    </div>
                    <h3 style="margin-top: 8px;">{{ $proyecto->Titulo }}</h3>
                    <p>⭐ {{ $proyecto->media_valoracion ? number_format($proyecto->media_valoracion, 1) : 'Sin valorar' }}</p>
                </a>

                @if(auth()->check() && auth()->user()->Rol === 'admin')
                    <div style="margin-top: 8px; display: flex; justify-content: center; gap: 10px;">
                        <a href="{{ route('trabajos.edit', $proyecto->ID_Proyecto) }}" title="Editar">📝</a>
                        <form action="{{ route('trabajos.destroy', $proyecto->ID_Proyecto) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este trabajo?');" style="display: inline;">
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

{{-- Footer --}}
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




{{-- Scripts --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const elementos = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1 });
        elementos.forEach(el => observer.observe(el));
    });

    function toggleMenu() {
        const menu = document.getElementById('profile-menu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
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

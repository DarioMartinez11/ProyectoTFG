<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $proyecto->Titulo }} | Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/trabajos/show.css') }}">
</head>
<body>


<header style="background-color: #e50914; color: white; padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <h1 style="font-size: 22px; font-weight: bold; margin: 0;">PINTURAS GENERAL</h1>
        <nav style="display: flex; gap: 30px; align-items: center; font-size: 16px; flex-wrap: wrap;">
            <a href="{{ route('inicio') }}" style="color: white; text-decoration: none;">Inicio</a>
            <a href="{{ route('trabajos') }}" style="color: white; text-decoration: none;">Trabajos</a>
            <a href="{{ route('tienda.index') }}" style="color: white; text-decoration: none;">Tienda</a>
            <a href="{{ route('blog') }}" style="color: white; text-decoration: none;">Blog</a>
            <a href="{{ route('contacto') }}" style="color: white; text-decoration: none;">Contacto</a>
            <a href="{{ route('nosotros') }}" style="color: white; text-decoration: none;">Sobre Nosotros</a>
        </nav>
        <div style="display: flex; gap: 10px; align-items: center; position: relative;">
            <a href="https://www.facebook.com/share/1CAt5m8ubn/" target="_blank">
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" style="width: 24px; height: 24px;">
                 </a>
            <a href="https://www.instagram.com/paquitopinturas" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" style="width: 24px;">
            </a>
            <a href="{{ route('carrito.index') }}" style="margin-left: 10px; font-size: 18px; color: white;">
                🛒Carrito @if(isset($totalCarrito) && $totalCarrito > 0) ({{ $totalCarrito }}) @endif
            </a>
            <div style="position: relative; margin-left: 10px;">
                <button onclick="toggleMenu()" style="background: none; border: none; cursor: pointer;">
                    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Perfil" style="width: 30px; height: 30px; border-radius: 50%; background: white; padding: 2px;">
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

<h2 class="titulo fade-in">{{ $proyecto->Titulo }}</h2>


<a href="{{ route('trabajos') }}" class="btn-cerrar-global" title="Cerrar">✖</a>

<main class="main-container">
    <div class="left-column">
        @php
            $cantidadImagenes = 0;
            if ($proyecto->ImagenAntes) $cantidadImagenes++;
            if ($proyecto->ImagenDespues) $cantidadImagenes++;
        @endphp

        @if ($cantidadImagenes > 0)
            <div class="image-grid {{ $cantidadImagenes === 1 ? 'una-sola' : '' }}">
               @if ($proyecto->ImagenAntes)
    <div class="image-card fade-in">
        <h4><strong>TRABAJO FINALIZADO</strong></h4>
        <img src="{{ asset($proyecto->ImagenAntes) }}" alt="Finalizado">
    </div>
@endif

@if ($proyecto->ImagenDespues)
    <div class="image-card fade-in">
        <h4><strong>TRABAJO INICIAL</strong></h4>
        <img src="{{ asset($proyecto->ImagenDespues) }}" alt="Inicial">
    </div>
@endif


            </div>
        @endif

        <div class="info fade-in">
            <p><strong>Categoría:</strong> {{ $proyecto->Categoria }}</p>
            <p><strong>Fecha:</strong> {{ $proyecto->Fecha }}</p>
            <p><strong>Ranking:</strong> ⭐ {{ $mediaRedondeada ?? 'Sin valorar' }}</p>
            <p><strong>Descripción:</strong></p>
            <div class="descripcion-scroll">{{ $proyecto->Descripcion }}</div>
        </div>
    </div>

    <div class="right-column">
        <div class="comentarios fade-in">
            <h3>Comentarios</h3>

            @if (session('success'))
                <div style="color: green; font-weight:bold; margin-bottom: 10px;">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div style="color: red; font-weight:bold; margin-bottom: 10px;">{{ session('error') }}</div>
            @endif

            @auth
                @if (isset($comentarioUsuario))
                    <div style="margin-bottom: 20px;">
                        <p><strong>Tu comentario:</strong></p>
                        <p>{{ $comentarioUsuario->Texto }}</p>
                        <p>Valoración: ⭐ {{ $comentarioUsuario->Valoracion }}</p>
                        <form method="POST" action="{{ route('comentarios.borrar', $proyecto->ID_Proyecto) }}">
                            @csrf
                            <button type="submit" style="background:#dc3545; color:white; border:none; padding:10px 20px; border-radius:6px; font-weight:bold;">Borrar comentario</button>
                        </form>
                    </div>
                @else
                    <form method="POST" action="{{ route('comentarios.guardar', $proyecto->ID_Proyecto) }}">
                        @csrf
                        <textarea name="Texto" rows="4" placeholder="Escribe tu comentario..." required></textarea>
                        <label for="Valoracion">Valoración:</label>
                        <select name="Valoracion" required>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">⭐ {{ $i }}</option>
                            @endfor
                        </select>
                        <br>
                        <button type="submit" style="background:#e50914; color:white; border:none; padding:10px 20px; border-radius:6px; font-weight:bold;">Enviar</button>
                    </form>
                @endif
            @else
                <p style="margin-top: 10px;">Inicia sesión para dejar un comentario.</p>
            @endauth

            @forelse($proyecto->comentarios as $comentario)
                <div class="comentario">
                    <strong>{{ $comentario->usuario->Nombre ?? 'Usuario' }}</strong> — {{ $comentario->Valoracion }}⭐<br>
                    <small>{{ \Carbon\Carbon::parse($comentario->Fecha)->format('d/m/Y') }}</small>
                    <p>{{ $comentario->Texto }}</p>
                </div>
            @empty
                <p style="margin-top: 20px;">No hay comentarios todavía.</p>
            @endforelse
        </div>
    </div>
</main>

<footer>
    &copy; {{ date('Y') }} Pinturas General — Francisco Martinez de Asís
</footer>

{{-- Botón cambiar fondo --}}
<button id="cambiarFondoBtn" onclick="cambiarFondo()" title="Cambiar fondo">
    <span>&#x21bb;</span>
</button>

<script>
    function cambiarFondo() {
        const colores = ['#f4f4f4', '#fceae8', '#eaf7fc', '#e8fce9', '#fff9e6'];
        const colorActual = document.body.style.backgroundColor;
        let nuevoColor;
        do {
            nuevoColor = colores[Math.floor(Math.random() * colores.length)];
        } while (nuevoColor === colorActual);
        document.body.style.backgroundColor = nuevoColor;
    }

    document.addEventListener("DOMContentLoaded", function () {
        const elements = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });
        elements.forEach(el => observer.observe(el));
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

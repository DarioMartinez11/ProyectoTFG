<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $proyecto->Titulo }} | Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/trabajos/show.css') }}">
</head>
<body>
<header style="background-color: #e50914; color: white; padding: 20px;">
  <div style="max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; padding: 0 80px; gap: 16px;">

    <!-- LOGO IZQUIERDA -->
    <div style="flex-shrink: 0; font-size: 22px; font-weight: bold;">PINTURAS GENERAL</div>

    <!-- MENÚ CENTRAL CON ESPACIO -->
  <nav style="flex-grow: 1; display: flex; justify-content: center; gap: 32px; flex-wrap: wrap; font-size: 16px; margin: 0 110px; max-width: 700px;">

      <a href="{{ route('inicio') }}" style="color: white; text-decoration: none;">Inicio</a>
      <a href="{{ route('trabajos') }}" style="color: white; text-decoration: none;">Trabajos</a>
      <a href="{{ route('tienda.index') }}" style="color: white; text-decoration: none;">Tienda</a>
      <a href="{{ route('blog') }}" style="color: white; text-decoration: none;">Blog</a>
      <a href="{{ route('contacto') }}" style="color: white; text-decoration: none;">Contacto</a>
      <a href="{{ route('nosotros') }}" style="color: white; text-decoration: none;">Sobre Nosotros</a>
    </nav>

    <!-- ICONOS DERECHA -->
    <div style="display: flex; align-items: center; gap: 10px; flex-shrink: 0;">
      <a href="https://www.facebook.com/share/1CAt5m8ubn/" target="_blank">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" style="width: 24px; height: 24px;">
      </a>
      <a href="https://www.instagram.com/paquitopinturas" target="_blank">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" style="width: 24px;">
      </a>
      <a href="{{ route('carrito.index') }}" style="font-size: 18px; color: white;">
        🛒Carrito @if(isset($totalCarrito) && $totalCarrito > 0) ({{ $totalCarrito }}) @endif
      </a>

      <div style="position: relative;">
        <button onclick="toggleMenu()" style="background: none; border: none; cursor: pointer;">
          <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" style="width: 30px; height: 30px; border-radius: 50%; background: white; padding: 2px;">
        </button>
        <div id="profile-menu" style="display: none; position: absolute; right: 0; top: 42px; background: white; box-shadow: 0 8px 16px rgba(0,0,0,0.15); border-radius: 10px; overflow: hidden; z-index: 100; min-width: 180px; font-size: 14px; font-weight: 500; color: #444;">
          <a href="{{ route('privacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">⚙️ Privacidad</a>
          <a href="{{ route('politicaprivacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">📄 Política de Privacidad</a>
          <a href="{{ route('logout') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444;">🔒 Cerrar sesión / Iniciar sesión</a>
        </div>
      </div>
    </div>
  </div>
</header>




<h2 class="titulo fade-in">{{ $proyecto->Titulo }}</h2>
<a href="{{ route('trabajos') }}" class="btn-cerrar-global" title="Cerrar">✖</a>

<main class="pantalla-unica">

    {{-- Imágenes lado a lado --}}
    <div class="galeria-fija">
        @if($proyecto->ImagenAntes)
            <div class="imagen-wrap">
                <img src="{{ asset($proyecto->ImagenAntes) }}" alt="Finalizado">
                <span class="etiqueta">Final</span>
            </div>
        @endif
        @if($proyecto->ImagenDespues)
            <div class="imagen-wrap">
                <img src="{{ asset($proyecto->ImagenDespues) }}" alt="Inicial">
                <span class="etiqueta">Inicio</span>
            </div>
        @endif
    </div>

    {{-- Bloque de detalles y comentarios --}}
    <div class="panel-informativo">
        <div class="info-proyecto">
            <h2>{{ $proyecto->Titulo }}</h2>
            <ul>
                <li><strong>Categoría:</strong> {{ $proyecto->Categoria }}</li>
                <li><strong>Fecha:</strong> {{ $proyecto->Fecha }}</li>
                <li><strong>Ranking:</strong> ⭐ {{ $mediaRedondeada ?? 'Sin valorar' }}</li>
            </ul>
            <div class="descripcion">
                <strong>Descripción:</strong>
                <p>{{ $proyecto->Descripcion }}</p>
            </div>
        </div>

        <div class="comentarios-panel">
            <h3>Comentarios</h3>

            @auth
                @if (isset($comentarioUsuario))
                    <div class="comentario-usuario">
                        <p><strong>Tu comentario:</strong> {{ $comentarioUsuario->Texto }}</p>
                        <p>⭐ {{ $comentarioUsuario->Valoracion }}</p>
                        <form method="POST" action="{{ route('comentarios.borrar', $proyecto->ID_Proyecto) }}">
                            @csrf
                            <button class="btn-delete">Borrar</button>
                        </form>
                    </div>
                @else
                    <form method="POST" action="{{ route('comentarios.guardar', $proyecto->ID_Proyecto) }}">
                        @csrf
                        <textarea name="Texto" placeholder="Tu comentario..." required></textarea>
                       <div class="rating-container">
    @for ($i = 5; $i >= 1; $i--)
        <input type="radio" id="star{{ $i }}" name="Valoracion" value="{{ $i }}" required>
        <label for="star{{ $i }}" title="{{ $i }} estrellas">&#9733;</label>
    @endfor
</div>
                        <button class="btn-submit">Enviar</button>
                    </form>
                @endif
            @else
                <p class="login-message">Inicia sesión para comentar.</p>
            @endauth

            @forelse($proyecto->comentarios as $comentario)
                <div class="comentario">
                    <strong>{{ $comentario->usuario->Nombre ?? 'Usuario' }}</strong> — {{ $comentario->Valoracion }}⭐
                    <p>{{ $comentario->Texto }}</p>
                </div>
            @empty
                <p>No hay comentarios todavía.</p>
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

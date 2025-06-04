<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Blog - Pinturas General</title>
   <link rel="stylesheet" href="{{ asset('css/blog/blog.css') }}">


</head>
<body>
  <!-- HEADER FIJO -->
  <header style="background-color: #e50914; color: white; padding: 20px; position: fixed; top: 0; left: 0; width: 100%; z-index: 999; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
      <h1 style="font-size: 22px; font-weight: bold; margin: 0;">PINTURAS GENERAL</h1>
      <nav style="display: flex; gap: 60px; align-items: center; font-size: 16px; flex-wrap: wrap;">
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
          <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" style="width: 24px;" />
        </a>
        <a href="{{ route('carrito.index') }}" style="margin-left: 10px; font-size: 18px; color: white;">🛒Carrito @if(isset($totalCarrito) && $totalCarrito > 0) ({{ $totalCarrito }}) @endif</a>
        <div style="position: relative; margin-left: 10px;">
          <button onclick="toggleMenu()" style="background: none; border: none; cursor: pointer;">
            <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Perfil" style="width: 30px; height: 30px; border-radius: 50%; background: white; padding: 2px;" />
          </button>
          <div id="profile-menu" class="hidden" style="position: absolute; right: 0; top: 42px; background: white; box-shadow: 0 8px 16px rgba(0,0,0,0.15); border-radius: 10px; overflow: hidden; z-index: 100; min-width: 180px; font-size: 14px; font-weight: 500; color: #444;">
            <a href="{{ route('privacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">⚙️ Privacidad</a>
            <a href="{{ route('politicaprivacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">📄 Política de Privacidad</a>
            <a href="{{ route('logout') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">🔒 Cerrar sesión</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- MAIN -->
<main class="fade-in" style="padding: 40px 20px; max-width: 1200px; margin: 10px auto 0;">
    <div style="text-align: center;">
      <h1 class="main-title">BLOG DE CONSEJOS</h1>
      <p class="subtitle">Aprende con nosotros sobre pintura, decoración y mantenimiento</p>
      <div class="divider"></div>
    </div>

    @if(Auth::check() && Auth::user()->Rol === 'admin')
      <div style="text-align: right; margin-bottom: 30px;">
        <a href="{{ route('blog.create') }}" class="btn-read" style="background-color: green;">➕ Crear nuevo artículo</a>
      </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 60px;">
      @foreach ($posts as $c)
        <div class="post-card">
          <div>
            @if($c->Imagen)
              <img src="{{ asset($c->Imagen) }}" alt="Imagen consejo" style="width: 100%; height: 250px; object-fit: cover;" />
            @else
              <div style="width: 100%; height: 250px; background-color: #f0f0f0;"></div>
            @endif
          </div>
          <div style="margin-top: 10px;">
            <div class="post-title">{{ $c->Titulo }}</div>
            <a href="#" class="btn-read" onclick="verConsejo({{ $c->ID_Articulo }})">Ver consejo</a>
            @if(Auth::check() && Auth::user()->Rol === 'admin')
              <div class="admin-actions">
                <a href="{{ route('blog.edit', $c->ID_Articulo) }}" class="edit-btn">✏️ Editar</a>
                <form action="{{ route('blog.destroy', $c->ID_Articulo) }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="delete-btn">🗑 Eliminar</button>
                </form>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>

    <!-- MODAL -->
<div id="consejoModalOverlay"
     style="display: none; position: fixed; inset: 0; background: rgba(255,255,255,0.4); backdrop-filter: blur(8px); z-index: 1000;">

      <div style="background: white; width: 90%; max-width: 800px; margin: 60px auto; border-radius: 12px; padding: 30px; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.2); animation: fadeIn 0.3s ease-in-out; max-height: 90vh; overflow-y: auto;">
        <button onclick="cerrarConsejo()" style="position: absolute; top: 10px; right: 15px; background: none; border: none; font-size: 22px; font-weight: bold; cursor: pointer; color: #999;">&times;</button>
        <div id="consejoContent" style="padding-bottom: 20px;"></div>
      </div>
    </div>
  </main>

  <!-- FOOTER -->
  <footer style="position: fixed; bottom: 0; left: 0; width: 100%; background-color:rgb(2, 2, 2); color: white; display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; font-size: 14px; z-index: 50;">
    <div>629 65 24 29</div>
    <div style="font-weight: bold;">PINTURAS GENERAL</div>
    <div>Francisco Martinez de Asís</div>
  </footer>

  <!-- SCRIPTS -->
  <script>
    function toggleMenu() {
      const menu = document.getElementById("profile-menu");
      menu.classList.toggle("hidden");
    }

    function cerrarConsejo() {
      document.getElementById('consejoModalOverlay').style.display = 'none';
      document.body.style.overflow = 'auto';
    }

    function verConsejo(id) {
      fetch(`/blog/${id}`)
        .then(res => res.json())
        .then(c => {
          const fechaFormateada = new Date(c.Fecha).toLocaleDateString('es-ES', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
          });

          const html = `
            <h2 style="font-size: 1.6rem; font-weight: bold; margin-bottom: 10px;">${c.Titulo}</h2>
            <p style="font-size: 0.95rem; color: #777; margin-bottom: 20px;">📅 Publicado el ${fechaFormateada}</p>
            <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: flex-start;">
              ${c.Imagen ? `<img src="/${c.Imagen}" alt="Imagen del consejo" style="width: 240px; border-radius: 10px;">` : ''}
              <div style="flex: 1; font-size: 1.05rem; color: #333; line-height: 1.6; word-break: break-word;">
                ${c.Contenido}
              </div>
            </div>`;
          document.getElementById('consejoContent').innerHTML = html;
          document.getElementById('consejoModalOverlay').style.display = 'block';
          document.body.style.overflow = 'hidden';
        });
    }

    document.addEventListener('click', function (event) {
      const menu = document.getElementById('profile-menu');
      const button = event.target.closest('button[onclick="toggleMenu()"]');
      if (!menu.contains(event.target) && !button) {
        menu.classList.add('hidden');
      }
    });

    document.addEventListener("DOMContentLoaded", () => {
      const element = document.querySelector('.fade-in');
      const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
          }
        });
      }, { threshold: 0.1 });
      observer.observe(element);
    });
  </script>
</body>
</html>

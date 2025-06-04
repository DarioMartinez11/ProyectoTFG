<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sobre Nosotros - Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/nosotros/nosotros.css') }}">

</head>
<body class="bg-white text-black">


<header style="background-color: #e50914; color: white; padding: 20px;">
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

{{-- CONTENIDO PRINCIPAL --}}
<main class="fade-in" style="padding: 40px 20px; max-width: 1200px; margin: 0 auto;">

    {{-- ENCABEZADO COMPLETO: Logo - Texto - Botón --}}
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 20px; flex-wrap: wrap; margin-bottom: 40px;">
        {{-- Logo --}}
        <div style="flex: 1; min-width: 150px;">
            <img src="{{ asset('img/logo/logo.jpg') }}" alt="Logo Pinturas Paquito" style="max-width: 150px;">
        </div>

        {{-- Título y subtítulo centrado --}}
        <div style="flex: 2; min-width: 300px; text-align: center;">
            <h1 class="main-title" style="margin: 0;">PINTURAS GENERAL</h1>
            <p class="subtitle" style="margin: 4px 0;">Conócenos mejor</p>
            <div class="divider" style="margin-top: 10px;"></div>
        </div>

        {{-- Botón a la derecha --}}
        <div style="flex: 1; min-width: 150px; text-align: right;">
            <a href="{{ route('contacto') }}"
               style="background-color: #e50914; color: white; padding: 10px 18px; font-size: 14px;
                      border-radius: 6px; text-decoration: none; font-weight: bold;">
                Contáctanos
            </a>
        </div>
    </div>

    {{-- TEXTO DE PRESENTACIÓN --}}
    <section class="content">
        <p><strong>Pinturas en General</strong> es una empresa familiar con más de 25 años de experiencia dedicada a ofrecer servicios profesionales de pintura y decoración. Situada en <strong>El Puerto de Santa María (Cádiz)</strong>, nos enorgullece haber formado parte de numerosos proyectos en la zona, siempre con el compromiso de calidad, seriedad y atención personalizada que nos caracteriza.</p>

        <p>A lo largo de nuestra trayectoria, hemos realizado trabajos tanto en interiores como exteriores, fachadas, restauración de mobiliario y reformas decorativas. Cada proyecto lo abordamos con dedicación, utilizando materiales de alta calidad y técnicas adaptadas a las necesidades de cada cliente.</p>

        <p>Esta página web representa un paso más en nuestra evolución, sirviendo como escaparate digital de nuestros servicios. Aquí podrás conocer más sobre quiénes somos, consultar ejemplos de nuestros trabajos y contactar con nosotros de manera rápida y sencilla.</p>

        <p>En <strong>Pinturas en General</strong> trabajamos cada día con el mismo entusiasmo y profesionalismo que nos ha acompañado desde nuestros inicios. Nuestro mayor objetivo es la satisfacción del cliente y superar sus expectativas en cada encargo.</p>
    </section>
</main>



{{-- FOOTER --}}
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


{{-- SCRIPTS --}}
<script>
    // Animación scroll
    document.addEventListener("DOMContentLoaded", function () {
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

    // Menú perfil
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

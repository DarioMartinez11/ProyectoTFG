<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Política de Privacidad - Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/politicaprivacidad/politicaprivacidad.css') }}">

</head>
<body class="bg-white text-black">

<header style="background-color: #e50914; color: white; padding: 20px; position: fixed; top: 0; left: 0; width: 100%; z-index: 999;">
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
                <div id="profile-menu" class="hidden" style="position: absolute; right: 0; top: 42px; background: white; box-shadow: 0 8px 16px rgba(0,0,0,0.15); border-radius: 10px; overflow: hidden; z-index: 100; min-width: 180px; font-size: 14px; font-weight: 500; color: #444;">
                    <a href="{{ route('privacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">⚙️ Privacidad</a>
                    <a href="{{ route('politicaprivacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">📄 Política de Privacidad</a>
                    <a href="{{ route('logout') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">🔒 Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="fade-in" style="padding: 40px 20px; max-width: 1200px; margin: 50px auto 0;">

    <div style="text-align: center;">
        <h1 class="main-title">Política de Privacidad</h1>
        <p class="subtitle">Tus datos están seguros con nosotros</p>
        <div class="divider"></div>
    </div>

    <section class="content">
        <p>En <strong>Pinturas General</strong>, nos tomamos muy en serio la privacidad de nuestros clientes y visitantes. Esta política describe cómo recopilamos, usamos y protegemos la información personal que nos proporcionas al visitar nuestra web o utilizar nuestros servicios.</p>

        <p><strong>1. ¿Qué datos recogemos?</strong><br>
        Solo recopilamos los datos necesarios para poder responder a tus consultas o procesar tus pedidos: nombre, correo electrónico, teléfono, dirección y preferencias de contacto.</p>

        <p><strong>2. Uso de la información</strong><br>
        Utilizamos tus datos únicamente para ofrecerte un mejor servicio, gestionar los encargos y mantener una comunicación fluida. Nunca compartimos tu información con terceros sin tu consentimiento.</p>

        <p><strong>3. Seguridad</strong><br>
        Toda la información proporcionada está protegida mediante medidas técnicas y organizativas que garantizan su seguridad, confidencialidad e integridad.</p>

        <p><strong>4. Tus derechos</strong><br>
        Puedes acceder, modificar o solicitar la eliminación de tus datos en cualquier momento escribiendo a nuestro correo o llamando directamente.</p>

        <p><strong>5. Cookies</strong><br>
        Esta web utiliza cookies para mejorar la navegación. Puedes desactivarlas desde la configuración de tu navegador si lo prefieres.</p>

        <p><strong>6. Responsable</strong><br>
        Francisco Martínez de Asís – Responsable de Pinturas General. Con más de 25 años ofreciendo servicios de pintura, decoración y reformas con el compromiso de siempre: profesionalidad y confianza.</p>

        <p>Al navegar en nuestro sitio o contactar con nosotros, estás aceptando esta política. Si tienes dudas, no dudes en consultarnos.</p>
    </section>
</main>

<footer style="position: fixed; bottom: 0; left: 0; width: 100%; background-color:rgb(2, 2, 2); color: white; display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; font-size: 14px; z-index: 50;">
    <div>629 65 24 29</div>
    <div style="font-weight: bold;">PINTURAS GENERAL</div>
    <div>Francisco Martinez de Asís</div>
</footer>

<script>
    function toggleMenu() {
        const menu = document.getElementById("profile-menu");
        menu.classList.toggle("hidden");
    }

    document.addEventListener("click", function(event) {
        const menu = document.getElementById("profile-menu");
        const button = event.target.closest('button[onclick="toggleMenu()"]');
        if (!menu.contains(event.target) && !button) {
            menu.classList.add("hidden");
        }
    });

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
</script>

</body>
</html>

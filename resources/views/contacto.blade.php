<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto | Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/contacto/contacto.css') }}">

</head>
<body>

<header style="background-color: #e50914; color: white; padding: 20px; position: fixed; top: 0; left: 0; width: 100%; z-index: 999; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <h1 style="font-size: 22px; font-weight: bold; margin: 0;">PINTURAS GENERAL</h1>

        <nav style="display: flex; gap: 24px; align-items: center; font-size: 16px; flex-wrap: wrap;">
            <a href="{{ route('inicio') }}" style="color: white; text-decoration: none; padding: 8px 12px;">Inicio</a>
            <a href="{{ route('trabajos') }}" style="color: white; text-decoration: none; padding: 8px 12px;">Trabajos</a>
            <a href="{{ route('tienda.index') }}" style="color: white; text-decoration: none; padding: 8px 12px;">Tienda</a>
            <a href="{{ route('blog') }}" style="color: white; text-decoration: none; padding: 8px 12px;">Blog</a>
            <a href="{{ route('contacto') }}" style="color: white; text-decoration: none; padding: 8px 12px;">Contacto</a>
            <a href="{{ route('nosotros') }}" style="color: white; text-decoration: none; padding: 8px 12px;">Sobre Nosotros</a>
        </nav>

        <div style="display: flex; gap: 10px; align-items: center; position: relative;">
            <a href="https://www.facebook.com/share/1CAt5m8ubn/" target="_blank">
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" style="width: 24px; height: 24px;">
                 </a>
            <a href="https://www.instagram.com/paquitopinturas" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" style="width: 24px;">
            </a>

            <a href="{{ route('carrito.index') }}" style="margin-left: 10px; font-size: 18px; color: white; text-decoration: none;">
                🛒Carrito @if(isset($totalCarrito) && $totalCarrito > 0) ({{ $totalCarrito }}) @endif
            </a>

            <div style="position: relative; margin-left: 10px;">
                <button onclick="toggleMenu()" style="background: none; border: none; cursor: pointer;">
                    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png"
                         alt="Perfil"
                         style="width: 30px; height: 30px; border-radius: 50%; background: white; padding: 2px;">
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
                            color: #444;">
                    <a href="{{ route('privacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">⚙️ Privacidad</a>
                    <a href="{{ route('politicaprivacidad') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">📄 Política de Privacidad</a>
                    <a href="{{ route('logout') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #444; border-bottom: 1px solid #eee;">🔒 Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
</header>

<main style="padding: 60px 20px 120px; margin-top: 65px;">
    <h2>Contáctanos</h2>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('enviar.contacto') }}">
        @csrf

        <div class="row">
            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}">
            </div>
            <div class="form-group">
                <label for="servicio">Servicio de interés</label>
                <select id="servicio" name="servicio">
                    <option value="">Selecciona una opción</option>
                    <option value="interior">Pintura interior</option>
                    <option value="exterior">Fachadas y exteriores</option>
                    <option value="restauracion">Restauraciones</option>
                    <option value="otros">Otros</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>¿Qué te interesa?</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="motivo[]" value="presupuesto"> Solicitar presupuesto</label>
                <label><input type="checkbox" name="motivo[]" value="visita"> Pedir una visita</label>
                <label><input type="checkbox" name="motivo[]" value="dudas"> Dudas</label>
            </div>
        </div>

        <label><strong>¿Cómo prefieres que te contactemos?</strong></label>
        <div style="margin-bottom: 15px;">
            <label style="font-weight: normal;">
                <input type="radio" name="preferencia_contacto" value="Teléfono" required> Teléfono
            </label>
            <label style="font-weight: normal; margin-left: 20px;">
                <input type="radio" name="preferencia_contacto" value="Email"> Email
            </label>
        </div>

        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="mensaje" rows="5" required>{{ old('mensaje') }}</textarea>
        </div>

        <div class="form-group">
            <label style="font-weight: normal;">
                <input type="checkbox" name="privacidad" required> Acepto la política de privacidad.
            </label>
        </div>

        <button class="submit-btn" type="submit">📩 Enviar mensaje</button>
    </form>
</main>

<footer style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: rgb(2, 2, 2); color: white; display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; font-size: 14px; z-index: 50;">
    <div>629 65 24 29</div>
    <div style="font-weight: bold;">PINTURAS GENERAL</div>
    <div>Francisco Martinez de Asís</div>
</footer>

<!-- Botón flotante de WhatsApp -->
<a href="https://wa.me/34685237375?text=Hola%2C%20quiero%20pedir%20un%20presupuesto%20a%20Pinturas%20General" 
   class="whatsapp-float" 
   target="_blank" 
   title="Habla con Pinturas General por WhatsApp">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" />
</a>

<style>
.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 80px;
    right: 20px;
    z-index: 999;
    cursor: pointer;
}

.whatsapp-float img {
    width: 100%;
    height: auto;
    border-radius: 50%;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    transition: transform 0.3s ease;
}

.whatsapp-float:hover img {
    transform: scale(1.1);
}
</style>

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

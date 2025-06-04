<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio | Pinturas General</title>
    <link rel="stylesheet" href="{{ asset('css/inicio/inicio.css') }}">

</head>
<body class="bg-white text-black">

<header style="background-color: #e50914; color: white; padding: 16px;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
        <h1 style="font-size: 20px; font-weight: bold;">PINTURAS GENERAL</h1>
        <div style="display: flex; gap: 20px; align-items: center;">
            <div style="display: flex; gap: 10px;">
               <a href="https://www.facebook.com/share/1CAt5m8ubn/" target="_blank">
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" style="width: 24px; height: 24px;">
                 </a>

                <a href="https://www.instagram.com/paquitopinturas" target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" style="width: 24px; height: 24px;">
                </a>
            </div>
            <div style="position: relative;">
                <button onclick="toggleMenu()" style="background: none; border: none; cursor: pointer;">
                    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" style="width: 32px; height: 32px; border-radius: 50%; background: white; padding: 2px;">
                </button>
                <div id="profile-menu"
                     style="display: none; position: absolute; right: 0; top: 42px; background: white; box-shadow: 0 8px 16px rgba(0,0,0,0.15); border-radius: 10px; overflow: hidden; z-index: 100; min-width: 180px; font-size: 14px; font-weight: 500; color: #444;">
                    <a href="{{ route('privacidad') }}">⚙️ Privacidad</a>
                    <a href="{{ route('politicaprivacidad') }}">📄 Política de Privacidad</a>
                    <a href="{{ route('logout') }}">🔒 Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="hero" style="min-height: calc(100vh - 100px); background: url('{{ asset('img/proyectos/9.jpg') }}') center/cover no-repeat; position: relative;">
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.4); z-index:0;"></div>
    <div class="fade-in" style="position: relative; z-index: 2; text-align: center; color: #fff;">
        <h1 style="font-size: 3rem;">Transformamos tus espacios con color</h1>
        <p style="font-size: 1.2rem; margin-top: 10px;">Profesionales en interiores, fachadas y restauraciones</p>
        <div class="buttons" style="flex-wrap: wrap; justify-content: center; margin-top: 30px;">
            <a href="{{ route('trabajos') }}">Ver Trabajos</a>
            <a href="{{ route('tienda.index') }}">Tienda</a>
            <a href="{{ route('blog') }}">Blog</a>
            <a href="{{ route('contacto') }}">Contáctanos</a>
            <a href="{{ route('nosotros') }}">Sobre Nosotros</a>
        </div>
    </div>
</section>

<!-- WIDGET: MEJORES PROYECTOS -->
<div style="position: fixed; top: 100px; left: 30px; width: 340px; z-index: 1000; font-family: 'Segoe UI', sans-serif;">


    <div style="
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        padding: 20px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.2);
    ">
        <h2 style="font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 18px; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px;">
            🏆 Mejores Proyectos
        </h2>

        @foreach($mejoresTrabajos as $trabajo)
            <div style="display: flex; gap: 12px; margin-bottom: 16px; align-items: center;">
                <div style="flex-shrink: 0;">
                    <img src="{{ asset($trabajo->Imagen) }}"
                         alt="{{ $trabajo->Titulo }}"
                         style="width: 90px; height: 60px; object-fit: cover; border-radius: 10px;">
                </div>
                <div style="flex-grow: 1;">
                    <h3 style="font-size: 14px; font-weight: 600; margin: 0 0 4px; color: #fff;">{{ $trabajo->Titulo }}</h3>
                    <p style="margin: 0; font-size: 13px; color: #f1f1f1;">⭐ {{ number_format($trabajo->promedio, 1) }}/5</p>
                    <a href="{{ route('trabajos.show', ['id' => $trabajo->ID_Proyecto]) }}"
                       style="font-size: 13px; color: #ffdddd; font-weight: 500; text-decoration: none; transition: color 0.3s;"
                       onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#ffdddd'">
                       Ver más →
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $producto->Nombre }} | Tienda - Pinturas General</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/tienda/show.css') }}">
</head>
<body>

<header>
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <h1 style="font-size: 22px; font-weight: bold; margin: 0;">PINTURAS GENERAL</h1>
        <a href="{{ route('carrito.index') }}" style="margin-left: 10px; font-size: 18px; color: white;">
            🛒 Carrito <span id="contador-carrito">({{ $totalCarrito ?? 0 }})</span>
        </a>
    </div>
</header>

<h2 class="titulo">{{ $producto->Nombre }}</h2>

<main class="main-container">
    <div class="product-card">
        <div class="product-content">
            @if ($producto->imagenes->count())
                <div class="carousel-container">
                    <div class="carousel" id="carousel">
                        @foreach ($producto->imagenes as $img)
                            <img src="{{ asset($img->ruta) }}" alt="Imagen de {{ $producto->Nombre }}">
                        @endforeach
                    </div>
                    @if ($producto->imagenes->count() > 1)
                        <button class="prev" onclick="moverCarrusel(-1)">❮</button>
                        <button class="next" onclick="moverCarrusel(1)">❯</button>
                    @endif
                </div>
            @else
                <div class="no-image">Sin imagen</div>
            @endif

            <div class="product-info">
                <p><strong>Descripción:</strong></p>
                <div class="descripcion-scroll">{{ $producto->Descripcion }}</div>
                <p><strong>Categoría:</strong> {{ ucfirst($producto->Categoria) }}</p>
                <p><strong>Stock disponible:</strong> {{ $producto->Stock }}</p>
                <p class="price">💶 {{ number_format($producto->Precio, 2) }} €</p>
            </div>
        </div>

        <div class="actions botones-abajo">
            <button onclick="agregarAlCarrito({{ $producto->ID_Producto }})" class="btn-carrito">➕ Añadir al carrito</button>
            <a href="{{ route('tienda.index') }}" class="btn-volver">⬅ Volver a tienda</a>
        </div>

        <div id="mensaje-exito"><span style="font-size: 1.4rem;"></span></div>
    </div>
</main>

<footer>
    &copy; {{ date('Y') }} Pinturas General — Francisco Martinez de Asís
</footer>

<button id="cambiarFondoBtn" onclick="cambiarFondo()" title="Cambiar fondo">
    <span>&#x21bb;</span>
</button>

<script>
    let index = 0;
    function moverCarrusel(direccion) {
        const carrusel = document.getElementById('carousel');
        const total = carrusel.children.length;
        index = (index + direccion + total) % total;
        carrusel.style.transform = `translateX(-${index * 280}px)`;
    }

    function cambiarFondo() {
        const colores = ['#f4f4f4', '#fceae8', '#eaf7fc', '#e8fce9', '#fff9e6'];
        const actual = document.body.style.backgroundColor;
        let nuevo;
        do {
            nuevo = colores[Math.floor(Math.random() * colores.length)];
        } while (nuevo === actual);
        document.body.style.backgroundColor = nuevo;
    }

    function agregarAlCarrito(idProducto) {
        const mensaje = document.getElementById("mensaje-exito");
        const stockDisponible = {{ $producto->Stock }};
        const contador = document.getElementById("contador-carrito");
        let cantidadActual = parseInt(contador.innerText.replace(/\D/g, ''));

        if (cantidadActual >= stockDisponible) {
            mensaje.innerHTML = '<span style="color: red; font-weight: bold; font-size: 1.4rem;">❌ No hay más stock disponible</span>';
            mensaje.style.height = "auto";
            mensaje.style.marginTop = "25px";
            setTimeout(() => {
                mensaje.style.height = "0";
                mensaje.style.marginTop = "0";
            }, 2500);
            return;
        }

        fetch("/carrito/agregar/" + idProducto, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            }
        })
        .then(res => {
            if (res.ok) {
                mensaje.innerHTML = '<span style="color: green; font-weight: bold; font-size: 1.4rem;">✅ Producto añadido al carrito</span>';
                mensaje.style.height = "auto";
                mensaje.style.marginTop = "40px";
                setTimeout(() => {
                    mensaje.style.height = "0";
                    mensaje.style.marginTop = "0";
                }, 2500);
                if (contador) {
                    cantidadActual += 1;
                    contador.innerText = `(${cantidadActual})`;
                }
            } else {
                alert("❌ Error al añadir al carrito.");
            }
        })
        .catch(() => alert("❌ Fallo de conexión."));
    }
</script>

</body>
</html>

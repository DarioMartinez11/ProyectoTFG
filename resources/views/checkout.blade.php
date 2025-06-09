<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar compra | Pinturas General</title>
     <link rel="stylesheet" href="{{ asset('css/checkout/checkout.css') }}">



</head>
<body>

<header style="background-color: #e50914; color: white; padding: 20px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 40px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <h1 style="font-size: 22px; font-weight: bold; margin: 0;">
            PINTURAS GENERAL
        </h1>

        <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap; margin-left: auto;">
            <nav style="display: flex; gap: 24px; font-size: 16px;">
            <a href="{{ route('inicio') }}" style="color: white; text-decoration: none;">Inicio</a>
            <a href="{{ route('trabajos') }}" style="color: white; text-decoration: none;">Trabajos</a>
            <a href="{{ route('tienda.index') }}" style="color: white; text-decoration: none;">Tienda</a>
            <a href="{{ route('blog') }}" style="color: white; text-decoration: none;">Blog</a>
            <a href="{{ route('contacto') }}" style="color: white; text-decoration: none;">Contacto</a>
            <a href="{{ route('nosotros') }}" style="color: white; text-decoration: none;">Sobre Nosotros</a>
            </nav>

            <a href="{{ route('carrito.index') }}" style="font-size: 16px; color: white;">
                🛒 Carrito @if(isset($totalCarrito) && $totalCarrito > 0) ({{ $totalCarrito }}) @endif
            </a>
        </div>
    </div>
</header>

<div class="container">
    <div class="productos">
        <h2>🧾 Productos en tu carrito</h2>
        @foreach ($productos as $item)
            <div class="producto">
                @if ($item->producto->imagenes->count() > 0)
    <img src="{{ asset($item->producto->imagenes->first()->ruta) }}" alt="producto">
@else
    <img src="{{ asset('img/sin-imagen.png') }}" alt="Sin imagen">
@endif

                <div>
                    <p><strong>{{ $item->producto->Nombre }}</strong></p>
                    <p>💶 Precio: {{ number_format($item->producto->Precio, 2) }} €</p>
                    <p>🔢 Cantidad: {{ $item->Cantidad }}</p>
                    <p>📦 Subtotal: {{ number_format($item->Cantidad * $item->producto->Precio, 2) }} €</p>
                </div>
            </div>
              @endforeach

        <hr style="margin-top: 30px; margin-bottom: 10px; border: 1px solid #eee;">

        <p style="text-align: right; font-size: 1.2rem; font-weight: bold;">
            💰 Total:
            {{ number_format($productos->sum(fn($item) => $item->Cantidad * $item->producto->Precio), 2) }} €
        </p>
    </div>


    <div class="formulario">
        <h2>Datos de envío y pago</h2>
        @if ($errors->any())
    <div style="color:red; margin-bottom:20px; text-align:center; font-weight:bold;">
        {{ $errors->first() }}
    </div>
@endif

        <form method="POST" action="{{ route('pedido.procesar') }}" id="form-pedido">
            @csrf

            <fieldset>
                <legend>Datos personales</legend>
                <div class="grid-form">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" name="ciudad" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" name="telefono" pattern="\d{8,}" title="Debe contener al menos 8 dígitos" required>
                    </div>
                </div>
            </fieldset>

<fieldset>
    <legend>Datos de la tarjeta</legend>

    <div style="position: relative; width: 100%; max-width: 320px; height: 180px; background: linear-gradient(135deg, #3b3b98, #182C61); color: white; border-radius: 14px; padding: 16px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); overflow: hidden;">
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" alt="Mastercard" style="width: 50px; position: absolute; top: 16px; right: 16px;">

        <input type="text" name="tarjeta" id="input-tarjeta" placeholder="Número de tarjeta" maxlength="19"
            style="position: absolute; top: 70px; left: 16px; width: 88%; padding: 8px; font-size: 1rem; border: none; border-radius: 6px; background: rgba(255,255,255,0.15); color: white; outline: none;" required pattern="^(\d{4}\s){3}\d{4}$">

        <input type="text" name="expiracion" placeholder="MM/AA" maxlength="5"
            style="position: absolute; bottom: 16px; left: 16px; width: 45%; padding: 8px; font-size: 0.9rem; border: none; border-radius: 6px; background: rgba(255,255,255,0.15); color: white; outline: none;" required pattern="^(0[1-9]|1[0-2])\/\d{2}$">

        <input type="text" name="cvv" placeholder="CVV" maxlength="3"
            style="position: absolute; bottom: 16px; right: 16px; width: 30%; padding: 8px; font-size: 0.9rem; border: none; border-radius: 6px; background: rgba(255,255,255,0.15); color: white; outline: none;" required pattern="\d{3}">
    </div>
</fieldset>

            <button type="submit" class="btn-pedido">💳 Confirmar pedido</button>
        </form>
    </div>
</div>
<footer style="background-color: #1a1a1a; color: white; text-align: center; padding: 16px; font-size: 14px; position: fixed; bottom: 0; left: 0; width: 100%; z-index: 100;">
    &copy; {{ date('Y') }} Pinturas General — Francisco Martinez de Asís
</footer>


<script>
    const form = document.getElementById('form-pedido');
    const tarjetaInput = document.querySelector('input[name="tarjeta"]');

    form.addEventListener('submit', function (e) {
        const requiredFields = this.querySelectorAll('input[required]');
        let valid = true;
        let firstInvalid = null;

        requiredFields.forEach(input => {
            input.classList.remove('error');
            const pattern = input.getAttribute('pattern');
            const value = input.value.trim();

            if (!value) {
                input.setCustomValidity("Este campo es obligatorio.");
                input.reportValidity();
                input.classList.add('error');
                valid = false;
                if (!firstInvalid) firstInvalid = input;
            } else if (pattern && !(new RegExp(pattern).test(value))) {
                input.setCustomValidity("Campo inválido.");
                input.reportValidity();
                input.classList.add('error');
                valid = false;
                if (!firstInvalid) firstInvalid = input;
            } else {
                input.setCustomValidity("");
            }
        });

        // 🧼 Limpia los espacios del número de tarjeta antes de enviar
        if (tarjetaInput) {
            tarjetaInput.value = tarjetaInput.value.replace(/\s/g, '');
        }

        if (!valid) {
            e.preventDefault();
            firstInvalid.focus();
        }
    });

    // 🎯 Formato dinámico con espacios cada 4 dígitos
    if (tarjetaInput) {
        tarjetaInput.addEventListener('input', (e) => {
            let val = e.target.value.replace(/\D/g, '').substring(0, 19);
            val = val.replace(/(.{4})/g, '$1 ').trim();
            e.target.value = val;

            const valorNumerico = val.replace(/\s/g, '');
            if (valorNumerico.length >= 13 && valorNumerico.length <= 19) {
                tarjetaInput.setCustomValidity("");
            } else {
                tarjetaInput.setCustomValidity("Debe tener entre 13 y 19 dígitos.");
            }
        });
    }
    //  Formato de expiración MM/AA
        const expiracionInput = document.querySelector('input[name="expiracion"]');

    if (expiracionInput) {
        expiracionInput.addEventListener('input', (e) => {
            let valor = e.target.value.replace(/\D/g, ''); // Elimina todo lo que no sea dígito

            if (valor.length > 2) {
                valor = valor.slice(0, 2) + '/' + valor.slice(2, 4); // Inserta "/"
            }

            e.target.value = valor.slice(0, 5); // Limita a 5 caracteres

            const patron = /^(0[1-9]|1[0-2])\/\d{2}$/;
            if (patron.test(e.target.value)) {
                expiracionInput.setCustomValidity("");
            } else {
                expiracionInput.setCustomValidity("Formato inválido. Usa MM/AA");
            }
        });
    }

</script>



</body>
</html>

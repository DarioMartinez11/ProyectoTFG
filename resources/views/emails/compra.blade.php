<div style="max-width: 600px; margin: 40px auto; padding: 30px; background-color: #ffffff; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.08); font-family: 'Segoe UI', sans-serif; color: #333; line-height: 1.6;">
    <h2 style="color: #28a745; font-size: 24px; margin-bottom: 20px;">🎉 ¡Gracias por tu compra, {{ $datos['nombre'] }}!</h2>

    <p><strong>📍 Dirección:</strong> {{ $datos['direccion'] }}, {{ $datos['ciudad'] }}</p>
    <p><strong>📞 Teléfono:</strong> {{ $datos['telefono'] }}</p>
    <p><strong>✉️ Email:</strong> {{ $datos['email'] }}</p>

    <h3 style="margin-top: 30px; font-size: 20px; color: #e50914;">🛒 Productos comprados:</h3>
    <ul style="padding-left: 20px;">
        @foreach($productos as $item)
            <li style="margin-bottom: 8px;">
                <strong>{{ $item->producto->Nombre }}</strong> — {{ $item->Cantidad }} ud(s) —
                <span style="color: #28a745;">{{ number_format($item->Cantidad * $item->producto->Precio, 2) }} €</span>
            </li>
        @endforeach
    </ul>

    <p style="margin-top: 20px;"><strong>💰 Total final:</strong> <span style="color: #28a745;">{{ number_format($datos['total'], 2) }} €</span></p>
    <p><strong>💳 Pagado con tarjeta terminada en:</strong> **** **** **** {{ $datos['ultimos4'] }}</p>

    <p style="margin-top: 30px; font-size: 13px; color: #666;"><em>Este correo fue enviado automáticamente por <strong>Pinturas General</strong>.</em></p>
</div>


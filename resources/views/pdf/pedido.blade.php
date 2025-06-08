<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Pedido</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        h1 { color: #e50914; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <h1> Resumen de tu pedido</h1>

    <p><strong>Nombre:</strong> {{ $datos['nombre'] }} {{ $datos['apellido'] }}</p>
    <p><strong>Dirección:</strong> {{ $datos['direccion'] }}, {{ $datos['ciudad'] }}</p>
    <p><strong>Email:</strong> {{ $datos['email'] }}</p>
    <p><strong>Teléfono:</strong> {{ $datos['telefono'] }}</p>
    <p><strong>Tarjeta:</strong> **** **** **** {{ $datos['ultimos4'] }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $item)
                <tr>
                    <td>{{ $item->producto->Nombre }}</td>
                    <td>{{ $item->Cantidad }}</td>
                    <td>{{ number_format($item->producto->Precio, 2) }} €</td>
                    <td>{{ number_format($item->Cantidad * $item->producto->Precio, 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align: right; font-size: 16px; margin-top: 20px;"><strong>Total:</strong> {{ number_format($datos['total'], 2) }} €</p>
</body>
</html>

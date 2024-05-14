<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compra realizada</title>
</head>

<body>
    <header>
        <h1 style="text-align: center; color:blueviolet;">FASHION SHOP</h1>
    </header>

    <main>
        <h4>A continuación les adjuntamos la factura y los detalles de la compra</h4>
        <h2>Detalles de la compra</h2>
        <p>Fecha de la compra: {{ $sale->created_at }}</p>
        <p>Número de factura: {{ $sale->id }}</p>
        <h3>Productos comprados:</h3>
        @foreach ($sale->products as $product)
            <table>
                <tr>
                    <th>Producto</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th>Cantidad</th>
                    <td>{{ $product->pivot->quantity }}</td>
                </tr>
                <tr>
                    <th>Precio / Unidad</th>
                    <td>{{ $product->price }}</td>
                </tr>
                <tr>
                    <th>Precio Total</th>
                    <td>{{ $product->pivot->quantity * $product->price }}</td>
                </tr>
            </table>
            <br>
        @endforeach

        <h3>Total de la compra: {{ $sale->total }}</h3>

        <h4>Esperamos pronto ver les de nuevo en nuestra tienda!</h4>
    </main>

    <footer>
        <h4 style="color:rgb(133, 51, 12);">Aviso:</h4>
        <p style="color:rgb(133, 51, 12); in">Este es un correo eelectronico automatico que se genera en realizar una
            compra en nuestra Tienda Online</p>
        <p style="color:rgb(133, 51, 12); in">En caso de que no ha realizar una compra en nuestra Tienda Online puede
            ignorar este correo electronico</p>
        <p style="color:rgb(133, 51, 12); in">O poner se en contacto con nosotros en correo electronico
            <strong>info@fashionshop.com</strong>
        </p>
    </footer>
</body>

</html>

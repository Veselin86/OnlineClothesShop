<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        th {
            text-align: left;
        }

        td {
            text-align: center
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <h1 style="text-align: center">Fashion Shop</h1>
        <h2 style="text-align: center">Factura</h2>
        <p>Fecha: {{ $sale->created_at }}</p>
        <p>Factura #: {{ $sale->id }}</p>
        <p>Cliente: {{ $user->name }}</p>

        @foreach ($sale->products as $product)
            <table>
                <tr>
                    <th>Producto</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th>Cantidad</th>
                    <td>{{ $product->pivot->quantity }} und</td>
                </tr>
                <tr>
                    <th>Precio/Und</th>
                    <td>{{ $product->price }} €</td>
                </tr>
                <tr>
                    <th>Precio Total</th>
                    <td>{{ $product->pivot->quantity * $product->price }} €</td>
                </tr>
            </table>
            <br>
        @endforeach

        <h3>Entrega:</h3>
        <p>Direccion: {{ $sale->address->line_1 }} {{ $sale->address->line_2 }}</p>
        <p>Ciudad: {{ $sale->address->city }} </p>
        <p>Codigo postal: {{ $sale->address->post_code }}</p>  
        <p>Pais: {{ $sale->address->country }}</p>

        <h3>Precio Total: {{ $sale->total }} €</h3>

        <h3 style="text-align: center;"><br><br>Gracias por su compra<br>Esperamos pronto ver les de nuevo</h3>
    </div>
</body>

</html>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Area de usuario<br>
            Bienvenido, {{ Auth::user()->name }}<br>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </h2>

        <ul>
            @foreach (auth()->user()->sales as $sale)
                <li>
                    <a href="{{ route('sales.pdf', ['sale' => $sale->id])}}" target="_blank" class="btn-primary" style="text-decoration: none;">Factura</a>
                    <strong>Fecha de Compra:</strong> {{ $sale->created_at->toFormattedDateString() }}
                    <strong>Total de la Compra:</strong> {{ number_format($sale->total, 2) }} €
                    <strong>Estado:</strong> {{ $sale->status }}
                    <details style="margin-top: 1rem; margin-bottom: 1rem">
                        <summary>Ver detalles de la compra</summary>
                        @foreach ($sale->products as $product)
                            <div>
                                <p><strong>Producto:</strong><a href="{{ route('products.show', $product->id) }}">
                                        {{ $product->name }} </p></a>
                                <p><strong>Cantidad:</strong> {{ $product->pivot->quantity }} </p>
                                <p><strong>Talla:</strong> {{ $product->pivot->size }} </p>
                                <p><strong>Color:</strong> {{ $product->pivot->color }} </p>
                                <p><strong>Precio por Unidad:</strong> {{ number_format($product->pivot->price, 2) }} €
                                </p>
                                <p><strong>Subtotal:</strong> {{ number_format($product->pivot->total, 2) }} € </p>
                                @if ($sale->address)
                                    <div>
                                        <strong>Dirección de Entrega:</strong>
                                        <p>{{ $sale->address->line_1 }} {{ $sale->address->line_2 }}</p>
                                        <p>{{ $sale->address->city }}, {{ $sale->address->post_code }},
                                            {{ $sale->address->country }}
                                        </p>
                                    </div>
                                @else
                                    <p>No hay dirección registrada para esta venta.</p>
                                @endif
                            </div>
                        @endforeach
                    </details>
                </li>
            @endforeach
        </ul>

        @if (auth()->user()->phone === null)
            <div>
                <h2>Agregar Teléfono</h2>
                <form method="POST" action="{{ route('user.update.phone') }}">
                    @csrf
                    <label for="phone">Teléfono:</label>
                    <input type="text" name="phone" id="phone" required>
                    <button type="submit">Guardar Teléfono</button>
                </form>
            </div>
        @endif
        @if (auth()->user()->address === null)
            <div>
                @if (auth()->user()->addresses()->exists() === false)
                    <h3 style="color: red">Porfavor registra su dirección en nuestra sistema</h3>
                @endif
                <h2>Agregar Dirección</h2>
                <form method="POST" action="{{ route('user.update.address') }}">
                    @csrf
                    <div>
                        <label for="line_1">Line 1:</label>
                        <input type="text" name="line_1" id="line_1" required>
                    </div>
                    <div>
                        <label for="line_2">Line 2 (optional):</label>
                        <input type="text" name="line_2" id="line_2">
                    </div>
                    <div>
                        <label for="city">City:</label>
                        <input type="text" name="city" id="city" required>
                    </div>
                    <div>
                        <label for="post_code">Post Code:</label>
                        <input type="text" name="post_code" id="post_code" required>
                    </div>
                    <div>
                        <label for="country">Country:</label>
                        <input type="text" name="country" id="country" required>
                    </div>
                    <button type="submit">Guardar Dirección</button>
                </form>
            </div>
        @endif
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="cursor:auto">
            <form action="/products/{{ $product->id }}" method="POST">

                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <h3 style="max-width: 500px; word-wrap: break-word;">{{ $product->name }}</h3>
                <h3>Precio: {{ $product->price }}</h3>

                <h5>Tallas disponibles:</h5>
                @if ($product->sizes === null)
                    <ul>
                        <li style="list-style: none">Talla unica</li>
                        <input type="hidden" name="size" value="Única">
                    </ul>
                @else
                    @if (is_array($product->sizes))
                        <select name="size" required>
                            @foreach ($product->sizes as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                    @endif
                @endif


                <h5>Colores disponibles:</h5>
                @if ($product->colors === null)
                    <ul>
                        <li style="list-style: none">Color unico</li>
                        <input type="hidden" name="color" value="Único">
                    </ul>
                @else
                    @if (is_array($product->colors))
                        <select name="color" required>
                            @foreach ($product->colors as $color)
                                <option value="{{ $color }}">{{ $color }}</option>
                            @endforeach
                        </select>
                    @endif
                @endif

                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image">
                <p style="max-width: 500px; word-wrap: break-word;">{{ $product->description }}</p>
                <p>Cantidad disponible: {{ $product->stock }} </p>
                @auth
                    <p>Cantidad elegida:</p>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" class="form-control" name="quantity" id="quantity" min="1" value="1"
                        required>
                    <button class="btn-primary" type="submit">Comprar</button>
                @endauth
                @if (session('error'))
                    <div>
                        <h3 class="text-danger">{{ session('error') }}</h3>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection

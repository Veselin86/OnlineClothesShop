@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="product">
            <h3>{{ $product->name }}</h3>
            <h3>Precio: {{ $product->price }}</h3>
            <h5>Tallas disponibles:</h5>
            @if ($product->sizes === null)
                <ul>
                    <li>Talla unica</li>
                </ul>
            @else
                @if (is_array($product->sizes))
                    <ul>
                        @foreach ($product->sizes as $size)
                            {{-- <li>{{ $size }}</li> --}}
                            <button type="button" class="size-option"
                                data-size="{{ $size }}">{{ $size }}</button>
                        @endforeach
                    </ul>
                @endif
            @endif


            <h5>Colores disponibles:</h5>
            @if ($product->colors === null)
                <ul>
                    <li>Color unico</li>
                </ul>
            @else
                @if (is_array($product->colors))
                    <ul>
                        @foreach ($product->colors as $color)
                            {{-- <li>{{ $color }}</li> --}}
                            <button type="button" class="color-option"
                                data-color="{{ $color }}">{{ $color }}</button>
                        @endforeach
                    </ul>
                @endif
            @endif

            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            <p>{{ $product->description }}</p>
            @auth
                <button class="add-to-cart btn-primary">Añadir al carrito</button>
            @endauth
        </div>
    </div>
@endsection

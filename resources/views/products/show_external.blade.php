@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="cursor:auto">
            <form action="/external-product" method="POST">

                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <h3 style="max-width: 500px; word-wrap: break-word;">{{ $product->title }}</h3>
                <h3>Precio: {{ $product->price }} €</h3>
                <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" class="product-image">
                <p style="max-width: 500px; word-wrap: break-word;">{{ $product->description }}</p>
                <p>Cantidad disponible: {{ $product->rating->count }} </p>

                @auth
                    <p>Cantidad elegida:</p>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" class="form-control" name="quantity" id="quantity" min="1" value="1"
                        required>
                    <button class="btn-primary" type="submit">Comprar</button>
                @else
                    <div class="btn-primary" style="display: flex;">
                        <a href="{{ url('login') }}"
                            style="width: 500px; text-decoration: none; color:white; text-align: center">Iniciar Sesión</a>
                    </div>
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

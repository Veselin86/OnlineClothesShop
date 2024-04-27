@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($products as $product)
            <div class="product" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                <h3>{{ $product->name }}</h3>
                <h3>Precio: {{ $product->price }}</h3>
                {{-- <h5>{{ $product->sizes }}</h5>
            <h5>Colores disponibles: {{ $product->colors }}</h5> --}}
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                <p>{{ Str::limit($product->description, 30, '...') }}</p>
            </div>
        @endforeach
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div>
        <h1>Productos {{ isset($category_id) ? 'de la categoría ' . $category_id->name : '' }}</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Añadir Producto</a>
    </div>
    <div class="container">
        @foreach ($products as $product)
            <div class="product" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                <h3>{{ $product->name }}</h3>
                <h3>Precio: {{ $product->price }}</h3>
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                <p>{{ Str::limit($product->description, 30, '...') }}</p>
            </div>
        @endforeach
    </div>
@endsection

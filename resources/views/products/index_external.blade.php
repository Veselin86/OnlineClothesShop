@extends('layouts.app')

@section('content')
    <div>
        <h1>Productos {{ isset($category_id) ? 'de la categoría ' . $category_id->name : '' }}</h1>
    </div>
    <div class="container">
        @foreach ($products as $product)
            <div class="product" onclick="window.location.href='{{ route('external.product', $product->id) }}'">
                <h3>{{ $product->title }}</h3>
                <h3>Precio: {{ $product->price }} €</h3>
                <div class="product-image">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}">
                </div>
                <p>{{ Str::limit($product->description, 30, '...') }}</p>
            </div>
        @endforeach
    </div>
@endsection

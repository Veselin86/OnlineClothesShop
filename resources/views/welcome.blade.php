{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($categories as $category)
            <div class="card" onclick="window.location.href='{{ route('products.index.category', $category->id) }}'">
                <h3>{{ $category->name }}</h3>
                <div class="card-inner">
                    <div class="card-front"
                        style="background-image: url('{{ asset($category->image_url) }}'); background-size: cover;">
                    </div>
                    <div class="card-back">
                        <p>{{ $category->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        <div id="products-container"></div>
    </div>
@endsection
 --}}

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card" onclick="window.location.href='{{ route('categories.index') }}'">
            <h3>Productos Internos</h3>
            <div class="card-inner">
                <div class="card-front"
                    style="background-image: url('{{ asset('images/internal_store.jpeg') }}'); background-size: cover;">
                </div>
                <div class="card-back">
                    <p>Explora nuestra variedad de productos internos.</p>
                </div>
            </div>
        </div>

        <div class="card" onclick="window.location.href='{{ route('external.categories') }}'">
            <h3>Productos Externos</h3>
            <div class="card-inner">
                <div class="card-front"
                    style="background-image: url('{{ asset('images/fake_store_apì.jpeg') }}'); background-size: cover;">
                </div>
                <div class="card-back">
                    <p>Descubre productos de otras tiendas a través de nuestra API.</p>
                </div>
            </div>
        </div>

    </div>
@endsection

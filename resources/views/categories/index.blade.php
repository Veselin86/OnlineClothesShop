@extends('layouts.app')

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
    </div>
@endsection

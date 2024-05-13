@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($categories as $category)
            <div class="card" onclick="window.location.href='{{ route('external.products.category', $category) }}'">
                <div class="card-inner">
                    <div class="card-front" style="background-color: rgb(197, 186, 186);">
                        <h3>{{ strtoupper($category) }}</h3>
                    </div>
                    <div class="card-back">
                        <p>Explora productos de la categoría {{ $category }}.</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

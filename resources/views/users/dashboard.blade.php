@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Bienvenido, {{ Auth::user()->name }}</p>
    <a href="{{ route('home') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Iniciar Sesión</h2>
        {{-- Mostrar errores si los credenciales no coincidan --}}
        @if (session('success'))
            <h1> {{ session('success') }} </h1>
        @endif
        @if ($errors)
            <span class="text-danger"> {{ $errors->first() }} </span>
        @endif
        {{-- Formulario con metodo POST y ruta login.post --}}
        <form method="POST" action="{{ route('login.post') }}">
            @csrf {{-- Generacion de Cross-site request forgery token --}}

            {{-- Label + Input para correo electronico --}}
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" class="form-control" name="email" id="email" required autofocus>
            </div>
            
            {{-- Label + Input para contraseña --}}
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            {{-- Enlace para el Registro de nuevo usuario --}}
            <div class="form-group">
                <h3>¿No tienes cuenta? <a href="{{ route('register') }}">Registrate</a></h3>
            </div>
            
            {{-- Boton para envio de formulario --}}
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
@endsection

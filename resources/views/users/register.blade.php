@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registro</h2>
    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
        </div>

        <div class="form-group">
            <h3>¿Ya esta registrado?<a href="{{ route('login') }}">Log in</a></h3>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="form-group">
            <h3>¿Quieres crear una nueva categoria?</h3>
            <h3>Rellena el formulario a continuación:</h3>
        </div>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nombre de la categoria:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="description">Descripción de la categoria:</label>
                <input type="text" class="form-control" name="description" id="description" required>
            </div>

            <div class="form-group">
                <label for="image_url">Dirección URL de la imagen:</label>
                <input type="text" class="form-control" name="image_url" id="image_url" required>
            </div>

            <button type="submit" class="btn-primary">Guardar Categoria</button>

        </form>

    </div>
@endsection

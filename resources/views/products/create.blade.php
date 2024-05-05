@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="form-group">
            <h3>¿Quieres añadir un nuevo producto?</h3>
            <h3>Rellena el formulario a continuación:</h3>
        </div>

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nombre del producto:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="description">Descripción del producto:</label>
                <input type="text" class="form-control" name="description" id="description" required>
            </div>

            <div class="form-group">
                <label for="price">Precio del producto:</label>
                <input type="number" class="form-control" name="price" id="price" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock del producto:</label>
                <input type="number" class="form-control" name="stock" id="stock" required>
            </div>

            {{--             
            <div class="form-group">
                <label for="sizes">Tamaños disponibles separados por coma:</label>
                <input type="text" class="form-control" name="sizes" id="sizes" required>
            </div> 

            <div class="form-group">
                <label for="colors">Colores disponibles:</label>
                <input type="text" class="form-control" name="colors" id="colors" required>
            </div>
 --}}
            <div class="form-group">
                <label for="sizes">Tamaños disponibles:</label>
                <select name="sizes[]" id="sizes" class="form-control" multiple>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                </select>
            </div>

            <div class="form-group">
                <label for="colors">Colores disponibles:</label>
                <select name="colors[]" id="colors" class="form-control" multiple>
                    <option value="Negro">Negro</option>
                    <option value="Blanco">Blanco</option>
                    <option value="Rojo">Rojo</option>
                    <option value="Azul">Azul</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Dirección URL de la imagen:</label>
                <input type="text" class="form-control" name="image" id="image" required>
            </div>

            <div class="form-group">
                <label for="provider_id">ID del proveedor:</label>
                <input type="text" class="form-control" name="provider_id" id="provider_id" required>
            </div>

            <div class="form-group">
                <label for="category_id">ID de la categoria:</label>
                <input type="text" class="form-control" name="category_id" id="category_id" required>
            </div>

            <button type="submit" class="btn-primary">Guardar Producto</button>

        </form>

    </div>
@endsection

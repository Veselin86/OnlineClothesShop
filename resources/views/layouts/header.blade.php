<header>
    <div class="container">
        <h1>Bienvenido a Nuestra Tienda</h1>
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Fashion Store Logo" style="height: 100px;">
        </a>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/categories') }}">Categorías</a></li>
                <li><a href="{{ url('/products') }}">Productos</a></li>
                <li><a href="{{ url('/info') }}">Sobre Nosotros</a></li>
                <li><a href="{{ url('/users') }}">Usuario</a></li>
            </ul>
        </nav>
    </div>
</header>

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
                @auth
                    <li>
                        <a href="{{ url('dashboard') }}">{{ Auth::user()->name }}</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <li><a href="{{ url('login') }}">Iniciar Sesión</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

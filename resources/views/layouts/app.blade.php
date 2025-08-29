<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <div id="app">
        <nav class="navbar">
            <div class="logo-container">
                <div class="brand-name">TL MODA</div>
                <div class="tagline">FEMENINA</div>
            </div>
            @php
                $categories = \App\Models\Category::all();
            @endphp
            @if (auth()->user()->role === 'client')

                <ul class="nav-links">
                    @php $categoryCount = 0; @endphp
                    @foreach ($categories as $category)
                        @if ($categoryCount < 4)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('productos.categoria', $category->name) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @elseif ($categoryCount === 4)
                            <li style="z-index: 10" class="dropdown">
                                <a href="#" class="nav-link">Más categorías <i class="bi bi-chevron-down"></i></a>
                                <div class="dropdown-content">
                        @endif

                        @if ($categoryCount >= 4)
                            <a href="{{ route('productos.categoria', $category->name) }}">
                                {{ $category->name }}
                            </a>
                        @endif

                        @php $categoryCount++; @endphp
                    @endforeach

                    @if ($categoryCount > 4)
    </div>
    </li>
    @endif
    </ul>
    @endif


    <ul style="margin-right: 60px" class="navbar-nav ms-auto">
        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="{{ route('pedidos.mis') }}" class="d-flex align-items-center justify-content-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/9198/9198214.png" width="30" height="30"
                            alt="entrega de pedidos icono gratis" title="entrega de pedidos icono gratis">
                        <span class="ms-2">Ver mis pedidos</span>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('carrito.index') }}"
                        class="d-flex align-items-center justify-content-center position-relative">
                        <svg fill="#000000" width="25px" height="25px" viewBox="0 0 24 24" id="cart"
                            data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color">
                            <path id="secondary-upstroke" d="M11,20.5h.1m5.9,0h.1"
                                style="fill: none; stroke: rgb(44, 169, 188); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                            </path>
                            <path id="primary" d="M3,3H5.14a1,1,0,0,1,1,.85L6.62,7,8,16l11-1,2-8H6.62"
                                style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                            </path>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count(session('carrito', [])) }}
                        </span>
                    </a>
                </li>

                <li style="z-index: 10" class="dropdown">
                    <a href="#"> <i class="bi bi-person-fill"></i>
                        {{ Auth::user()->name }}</a>
                    <div class="dropdown-content">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>
        @endguest
    </ul>

    </nav>

    <div class="floating-buttons">
        <a href="https://wa.me/+573223374989" target="_blank" class="floating-button whatsapp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="https://www.facebook.com/erika.aconcha" target="_blank" class="floating-button facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://www.instagram.com/tucuenta" target="_blank" class="floating-button instagram">
            <i class="fab fa-instagram"></i>
        </a>
    </div>
    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>
<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h4>TL MODA FEMENINA</h4>
            <p>Tu destino de moda preferido</p>
        </div>
        <div class="footer-section">
            <h4>Contacto</h4>
            <p><i class="bi bi-telephone"></i> +57 322 3374989</p>
            <p><i class="bi bi-envelope"></i> info@tlmoda.com</p>
        </div>
        <div class="footer-section">
            <h4>Síguenos</h4>
            <div class="social-links">
                <a href="https://wa.me/+573223374989" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="https://www.facebook.com/erika.aconcha" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/tucuenta" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2023 TL MODA FEMENINA. Todos los derechos reservados.</p>
    </div>
</footer>

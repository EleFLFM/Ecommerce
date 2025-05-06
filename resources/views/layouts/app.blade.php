<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body style="background-color: #121212">

    <div  id="app">
        <nav class="navbar">
            <div class="logo-container">
                <div class="logo">
                    <span style="color: #d4af37; font-size: 16px; font-weight: bold;">TL</span>
                </div>
                <div class="logo-text"><a style="color: #d4af37; text-decoration: none; " href="{{ url('/') }}">
                        TL MODA FEMENINA
                    </a></div>
            </div>
            @php
                $categories = \App\Models\Category::all();
            @endphp
            @if (auth()->user()->role === 'client')

                <ul class="nav-links">
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos.categoria', $category->name) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
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
                        <li>
                            <a style="width: 115px" href="{{ route('carrito.index') }}" class="btn btn-outline-secondary">
                                🛒 Carrito ({{ count(session('carrito', [])) }})
                            </a>
                            
                        </li>
                        <li class="dropdown">
                            <a href="#"> <i class="bi bi-person-fill"></i>
                                {{ Auth::user()->name }}</a>
                            <div class="dropdown-content">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    TL MODA FEMENINA
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav me-auto">
                        @foreach ($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('productos.categoria', $category->name) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    :root {
        --primary-color: #111;
        --accent-color: #d4af37;
        --hover-bg: #333;
        --dropdown-bg: #222;
        --text-color: white;
        --border-color: #333;
    }

    body {
        background-color: #f5f5f5;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: var(--primary-color);
        padding: 0 2rem;
        height: 80px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .logo-container {
        display: flex;
        align-items: center;
    }

    .logo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary-color);
        border: 2px solid var(--accent-color);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .logo-text {
        font-size: 24px;
        text-transform: uppercase;
        color: var(--accent-color);
        font-weight: bold;
        letter-spacing: 1px;
    }

    .nav-links {
        display: flex;
        list-style: none;
        gap: 2rem;
        margin: 0%
    }

    .nav-links a {
        text-decoration: none;
        color: var(--text-color);
        font-size: 16px;
        font-weight: 400;
        transition: color 0.3s;
        position: relative;
        display: block;
        padding: 10px 0;
    }

    .nav-links a:hover {
        color: var(--accent-color);
    }

    .ofertas {
        color: var(--accent-color) !important;
    }

    /* Estilos para dropdown */
    .dropdown {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: var(--dropdown-bg);
        min-width: 200px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
        border-top: 2px solid var(--accent-color);
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content a {
        color: #f9f9f9;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        border-bottom: 1px solid var(--border-color);
    }

    .dropdown-content a:hover {
        background-color: var(--hover-bg);
    }

    .dropdown::after {
        font-size: 10px;
        margin-left: 5px;
        position: absolute;
        right: -15px;
        top: 12px;
        color: var(--accent-color);
    }

    .icons-container {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .icon {
        color: white;
        font-size: 20px;
        cursor: pointer;
        transition: color 0.3s;
    }

    .icon:hover {
        color: var(--accent-color);
    }

    /* Estilos responsivos */
    @media (max-width: 992px) {
        .navbar {
            padding: 0 1rem;
        }

        .nav-links {
            gap: 1rem;
        }
    }

    @media (max-width: 768px) {
        .logo-text {
            font-size: 18px;
        }

        .nav-links {
            display: none;
        }
    }
</style>

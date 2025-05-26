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

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body style="background-color: #121212">

    <div id="app">
        <nav  class="navbar">
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
                <li><a style="width: 180px" href="{{ route('pedidos.mis') }}" class="btn btn-outline-primary">
                        🧾 Ver mis pedidos
                    </a></li>
                <li>
                    <a style="width: 115px" href="{{ route('carrito.index') }}" class="btn btn-outline-secondary">
                        🛒 ({{ count(session('carrito', [])) }})
                    </a>

                </li>

                <li style="z-index: 10" class="dropdown">
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
    <style>
        .floating-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 1000;
        }

        .nav-links .dropdown .bi-chevron-down {
            font-size: 12px;
            margin-left: 5px;
        }

        .nav-links .dropdown-content {
            min-width: 200px;
            padding: 10px 0;
            border-radius: 0 0 8px 8px;
        }

        .nav-links .dropdown-content a {
            padding: 10px 20px;
            font-size: 14px;
            border-bottom: 1px solid var(--border-color);
        }

        .nav-links .dropdown-content a:last-child {
            border-bottom: none;
        }

        .floating-button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .floating-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .whatsapp {
            background-color: #25D366;
        }

        .facebook {
            background-color: #1877F2;
        }

        .instagram {
            background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D, #F56040, #F77737, #FCAF45, #FFDC80);
        }
    </style>
    <div class="floating-buttons">
        <a href="https://wa.me/+573006879210" target="_blank" class="floating-button whatsapp">
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

<style>
    .navbar {
        background-color: #1a1a1a;
        color: #fff;
        padding: 10px 0;
    }
    footer {
        background-color: #1a1a1a;
        color: #fff;
        padding: 40px 0 20px;
        margin-top: 50px;
    }

    .footer-content {
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        flex-wrap: wrap;
        gap: 30px;
    }

    .footer-section {
        flex: 1;
        min-width: 250px;
    }

    .footer-section h4 {
        color: #d4af37;
        margin-bottom: 15px;
        font-size: 1.2rem;
    }

    .footer-section p {
        margin-bottom: 10px;
        color: #ccc;
    }

    .social-links {
        display: flex;
        gap: 15px;
    }

    .social-links a {
        color: #fff;
        font-size: 1.5rem;
        transition: color 0.3s ease;
    }

    .social-links a:hover {
        color: #d4af37;
    }

    .footer-bottom {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #333;
    }

    .footer-bottom p {
        color: #888;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .footer-content {
            flex-direction: column;
            text-align: center;
        }

        .footer-section {
            margin-bottom: 20px;
        }

        .social-links {
            justify-content: center;
        }
    }
</style>
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
        background-color: #1a1a1a;
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
    <div class="comments-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="comments-box">
                        <h4>Déjanos tu comentario</h4>
                        <form  method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Tu nombre" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Tu correo electrónico" required>
                            </div>
                            <div class="form-group mb-3">
                                <textarea class="form-control" name="message" rows="4" placeholder="Tu mensaje" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .comments-section {
            background-color: #1a1a1a;
            padding: 50px 0;
            margin-top: -50px;
        }

        .comments-box {
            background-color: #222;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .comments-box h4 {
            color: #d4af37;
            margin-bottom: 20px;
            text-align: center;
        }

        .comments-box .form-control {
            background-color: #333;
            border: 1px solid #444;
            color: #fff;
            margin-bottom: 15px;
        }

        .comments-box .form-control:focus {
            background-color: #444;
            border-color: #d4af37;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            color: #fff;
        }

        .comments-box .form-control::placeholder {
            color: #888;
        }

        .comments-box .btn-primary {
            background-color: #d4af37;
            border-color: #d4af37;
            width: 100%;
            padding: 10px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .comments-box .btn-primary:hover {
            background-color: #c4a030;
            border-color: #c4a030;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .comments-box {
                padding: 20px;
            }
        }
    </style>
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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
        background-color: #1a1a1a;
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

    .

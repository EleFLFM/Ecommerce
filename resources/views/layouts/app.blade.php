<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Mi Ecommerce'))</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Barra de navegación unificada -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Inicio</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            @endif
                            <a href="{{ route('profile.edit') }}" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Perfil</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Cerrar sesión</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Iniciar sesión</a>
                            <a href="{{ route('register') }}" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Registrarse</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Cabecera opcional -->
        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Contenido principal -->
        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
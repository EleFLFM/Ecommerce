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
    <!-- Bootstrap JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <!-- Bootstrap JS -->
</head>

<body style="background-color: #121212">
    <div class="admin-container" id="app">
        <!-- Barra lateral -->
        <div class="admin-sidebar">
            <div class="sidebar-header">
                <h3>Panel Admin</h3>
            </div>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="active">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                
                <!-- Menú desplegable de Usuarios -->
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-people-fill"></i> Usuarios
                        <i class="bi bi-chevron-down float-end"></i>
                    </a>
                    <div class="sidebar-submenu">
                        <a href="{{ route('admin.users.index') }}">Listar Usuarios</a>
                        <a href="{{-- {{ route('admin.users.create') }} --}}">Crear Usuario</a>
                    </div>
                </li>
                
                <!-- Menú desplegable de Productos -->
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-box-seam-fill"></i> Productos
                        <i class="bi bi-chevron-down float-end"></i>
                    </a>
                    <div class="sidebar-submenu">
                        <a href="{{ route('admin.products.index') }}">Listar Productos</a>
                        <a href="{{ route('admin.products.create') }}">Crear Producto</a>
                        <a href="{{ route('admin.categories.index') }}">Categorías</a>
                    </div>
                </li>
                
                <!-- Otras opciones -->
                <li>
                    <a href="{{-- {{ route('admin.orders.index') }} --}}">
                        <i class="bi bi-cart-check-fill"></i> Pedidos
                    </a>
                </li>
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="admin-main">
            <!-- Barra superior -->
            <nav class="admin-topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                
               <!-- En tu layout admin-app.blade.php -->
<div class="dropdown">
    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        {{ Auth::user()->name }}
    </a>
    
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Cerrar sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>
            </nav>

            <!-- Contenido dinámico -->
            <main class="admin-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Toggle sidebar en móviles
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('collapsed');
        });
        
        // Toggle dropdowns del menú
        document.querySelectorAll('.sidebar-dropdown > a').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                const submenu = this.nextElementSibling;
                const icon = this.querySelector('.bi-chevron-down');
                
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
                icon.classList.toggle('rotate');
            });
        });
    </script>
    
</body>

</html>

<style>
    /* Estilos generales */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }
    
    :root {
        --sidebar-width: 250px;
        --sidebar-collapsed-width: 80px;
        --sidebar-bg: #1a1a1a;
        --sidebar-color: #b3b3b3;
        --sidebar-active-bg: #333;
        --sidebar-active-color: #d4af37;
        --topbar-bg: #222;
        --topbar-color: #fff;
        --content-bg: #121212;
        --transition-speed: 0.3s;
    }
    
    body {
        overflow-x: hidden;
    }
    
    /* Layout principal */
    .admin-container {
        display: flex;
        min-height: 100vh;
    }
    
    /* Barra lateral */
    .admin-sidebar {
        width: var(--sidebar-width);
        background: var(--sidebar-bg);
        color: var(--sidebar-color);
        transition: width var(--transition-speed);
        position: fixed;
        height: 100vh;
        z-index: 1000;
    }
    
    .admin-sidebar.collapsed {
        width: var(--sidebar-collapsed-width);
    }
    
    .sidebar-header {
        padding: 20px;
        background: rgba(0, 0, 0, 0.2);
        border-bottom: 1px solid #333;
        text-align: center;
    }
    
    .sidebar-header h3 {
        color: var(--sidebar-active-color);
        margin: 0;
        white-space: nowrap;
    }
    
    .admin-sidebar.collapsed .sidebar-header h3 {
        display: none;
    }
    
    /* Menú principal */
    .sidebar-menu {
        list-style: none;
        padding: 0;
    }
    
    .sidebar-menu li a {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        color: var(--sidebar-color);
        text-decoration: none;
        transition: all var(--transition-speed);
        white-space: nowrap;
    }
    
    .sidebar-menu li a:hover,
    .sidebar-menu li a.active {
        background: var(--sidebar-active-bg);
        color: var(--sidebar-active-color);
    }
    
    .sidebar-menu li a i {
        margin-right: 10px;
        font-size: 1.2rem;
    }
    
    .admin-sidebar.collapsed .sidebar-menu li a span {
        display: none;
    }
    
    .admin-sidebar.collapsed .sidebar-menu li a i {
        margin-right: 0;
        font-size: 1.5rem;
    }
    
    /* Submenú */
    .sidebar-submenu {
        display: none;
        background: rgba(0, 0, 0, 0.2);
        padding-left: 20px;
    }
    
    .sidebar-submenu a {
        display: block;
        padding: 10px 20px;
        color: var(--sidebar-color);
        text-decoration: none;
        transition: all var(--transition-speed);
        font-size: 0.9rem;
    }
    
    .sidebar-submenu a:hover {
        color: var(--sidebar-active-color);
    }
    
    .bi-chevron-down.rotate {
        transform: rotate(180deg);
    }
    
    /* Contenido principal */
    .admin-main {
        flex: 1;
        margin-left: var(--sidebar-width);
        transition: margin-left var(--transition-speed);
    }
    
    .admin-sidebar.collapsed ~ .admin-main {
        margin-left: var(--sidebar-collapsed-width);
    }
    
    /* Barra superior */
    .admin-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background: var(--topbar-bg);
        color: var(--topbar-color);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-toggle {
        background: none;
        border: none;
        color: var(--topbar-color);
        font-size: 1.5rem;
        cursor: pointer;
    }
    
    /* Contenido */
    .admin-content {
        padding: 20px;
        min-height: calc(100vh - 60px);
        background: var(--content-bg);
        color: #fff;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .admin-sidebar {
            width: var(--sidebar-collapsed-width);
        }
        
        .admin-sidebar .sidebar-header h3,
        .admin-sidebar .sidebar-menu li a span {
            display: none;
        }
        
        .admin-sidebar .sidebar-menu li a i {
            margin-right: 0;
            font-size: 1.5rem;
        }
        
        .admin-main {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        .admin-sidebar.expanded {
            width: var(--sidebar-width);
        }
        
        .admin-sidebar.expanded .sidebar-header h3,
        .admin-sidebar.expanded .sidebar-menu li a span {
            display: block;
        }
        
        .admin-sidebar.expanded .sidebar-menu li a i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .admin-sidebar.expanded ~ .admin-main {
            margin-left: var(--sidebar-width);
        }
    }
</style>
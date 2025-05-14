<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Ruta principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Autenticación
Auth::routes();

// Grupo de rutas protegidas
Route::middleware(['auth'])->group(function () {
    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    
    // Productos (acceso público pero creación/edición solo para admin)
    Route::resource('products', ProductController::class);
     // Productos
     Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
     Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
     Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
     Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
     Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
     Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    

     //usuarios
     // Usuarios (si necesitas gestión de usuarios)
    Route::resource('user', UserController::class);
    Route::get('/users', [UserController::class, 'UserController'])->name('admin.users.index');
    Route::get('/user/create', [UserController::class, 'UserController'])->name('admin.users.create');
    // Carrito de compras
    Route::resource('cart', CartController::class)->only(['index', 'store', 'update', 'destroy']);
    
    // Rutas de administración
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});

// Redirección después de login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// productos
Route::get('/home', [ProductController::class, 'index'])->name('productos.index');
Route::get('/productos/{id}', [ProductController::class, 'show'])->name('productos.show');
Route::get('/categoria/{slug}', [ProductController::class, 'porCategoria'])->name('productos.categoria');

//carrito de compras
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidosController;
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

//ruta de pedidos
Route::post('/pedido/confirmar', [PedidosController::class, 'confirmarPedido'])->name('pedido.confirmar');
Route::get('/mis-pedidos', [PedidosController::class, 'misPedidos'])->name('pedidos.mis')->middleware('auth');



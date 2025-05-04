<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
    
    // Carrito de compras
    Route::resource('cart', CartController::class)->only(['index', 'store', 'update', 'destroy']);
    
    // Rutas de administración
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});

// Redirección después de login
Route::get('/home', [HomeController::class, 'redirect'])->name('home.redirect');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// productois
Route::get('/home', [ProductController::class, 'index'])->name('productos.index');

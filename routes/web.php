<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Página de inicio pública
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación (login, registro, etc.)
require __DIR__.'/auth.php';

// Grupo de rutas PARA TODOS LOS USUARIOS AUTENTICADOS
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard genérico (redirige según rol)
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin' 
            ? redirect()->route('admin.dashboard')
            : view('dashboard');
    })->name('dashboard');
    
    // Rutas de perfil compartidas
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas exclusivas para CLIENTES
    Route::middleware('can:client')->group(function () {
        Route::get('/my-account', [HomeController::class, 'account'])->name('client.account');
        // Otras rutas para clientes...
    });
});

// Grupo de rutas EXCLUSIVAS PARA ADMIN
Route::middleware(['auth', 'verified', 'is_admin'])->prefix('admin')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Panel de administración
    Route::get('/panel', [AdminController::class, 'panel'])->name('admin.panel');
    
    // Perfil admin (opcional, puede usar el genérico)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
});
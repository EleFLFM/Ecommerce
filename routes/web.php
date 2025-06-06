<?php
use App\Http\Controllers\Admin\CategoryController;
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
    

     Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'destroy' => 'admin.categories.destroy'
    ]);
   
     
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::get('users/show/{id}', [UserController::class, 'show'])->name('admin.users.show');
    
    
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
Route::get('/pedidos', [PedidosController::class, 'indexAdmin'])->name('pedidos.index')->middleware('auth');
Route::put('/pedidos/{pedido}/actualizar-estado', [PedidosController::class, 'actualizarEstado'])
    ->name('pedidos.actualizar-estado')
    ->middleware('auth');

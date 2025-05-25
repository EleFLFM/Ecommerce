<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DetallePedido;
use App\Models\Product;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Estadísticas para el dashboard del admin
            $totalPedidos = Pedido::count();
            $pedidosPendientes = Pedido::where('estado', 'pendiente')->count();
            $pedidosCompletados = Pedido::where('estado', 'completado')->count();
            $totalClientes = User::where('role', 'client')->count();
            $productosBajoStock = Product::where('stock', '<', 5)->count();
            
            // Últimos pedidos
            $ultimosPedidos = Pedido::with('usuario')
                ->latest()
                ->take(5)
                ->get();
            
            // Datos para gráficos
           // En el método index() del HomeController
$pedidosPorEstado = Pedido::selectRaw('estado, count(*) as total')
    ->groupBy('estado')
    ->get()
    ->mapWithKeys(function($item) {
        return [strtolower($item->estado) => $item->total];
    });

$pedidosPorMes = Pedido::selectRaw('MONTH(created_at) as mes, count(*) as total')
    ->whereYear('created_at', date('Y'))
    ->groupBy('mes')
    ->get()
    ->mapWithKeys(function($item) {
        return [$item->mes => $item->total];
    });
// En tu HomeController
$pedidosPorCategoria = DetallePedido::selectRaw('categories.name as categoria, COUNT(*) as total')
    ->join('products', 'detalle_pedidos.producto_id', '=', 'products.id')
    ->join('categories', 'products.category_id', '=', 'categories.id')
    ->groupBy('categories.name')
    ->get();

$productosPorCategoria = Product::selectRaw('categories.name as categoria, COUNT(*) as total')
    ->join('categories', 'products.category_id', '=', 'categories.id')
    ->groupBy('categories.name')
    ->get();

$ventasPorCategoria = DetallePedido::selectRaw('categories.name as categoria, SUM(detalle_pedidos.precio_unitario * detalle_pedidos.cantidad) as total')
    ->join('products', 'detalle_pedidos.producto_id', '=', 'products.id')
    ->join('categories', 'products.category_id', '=', 'categories.id')
    ->groupBy('categories.name')
    ->get();
    $clientesTop = Pedido::selectRaw('users.name as cliente, COUNT(*) as total_pedidos, SUM(pedidos.total) as total_gastado')
    ->join('users', 'pedidos.user_id', '=', 'users.id')
    ->groupBy('users.name')
    ->orderByDesc('total_gastado')
    ->limit(5)
    ->get();
    $productosMasVendidos = DetallePedido::selectRaw('products.name as producto, SUM(detalle_pedidos.cantidad) as total_vendido')
    ->join('products', 'detalle_pedidos.producto_id', '=', 'products.id')
    ->groupBy('products.name')
    ->orderByDesc('total_vendido')
    ->limit(5)
    ->get();
// Rellenar meses sin pedidos con cero
$pedidosPorMesCompleto = collect();
for ($i = 1; $i <= 12; $i++) {
    $pedidosPorMesCompleto[$i] = $pedidosPorMes->get($i, 0);
}
            return view('admin.dashboard', compact(
                'totalPedidos',
                'pedidosPendientes',
                'pedidosCompletados',
                'totalClientes',
                'productosBajoStock',
                'ultimosPedidos',
                'pedidosPorEstado',
                'pedidosPorMes',
                'pedidosPorCategoria',
                'productosPorCategoria',
                'ventasPorCategoria',
                'pedidosPorMesCompleto',
                'clientesTop',
                'productosMasVendidos',
                
            ));
            
            
        } elseif ($user->role === 'client') {
            $products = Product::all();
            $categories = Category::with('products')->get();
            return view('client.dashboard', compact('products','categories'));
        }
    }
}
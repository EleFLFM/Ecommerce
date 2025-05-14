<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class PedidosController extends Controller
{
    //Este es para el pedidos.index de el admin donde se van a listar todos los pedidos de los usuarios
   public function indexAdmin()
{
    $pedidos = Pedido::with(['usuario', 'detalles.producto'])
        ->latest()
        ->get();
        
    return view('pedidos.index', compact('pedidos'));
}
    public function confirmarPedido()
    {
        $carrito = session('carrito', []);
        $usuario = Auth::user();


        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío');
        }

        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // 1. Crear pedido
        $pedido = Pedido::create([
            'user_id' => $usuario->id,
            'total' => $total,
            'estado' => 'pendiente'
        ]);

        // 2. Guardar detalles
        foreach ($carrito as $item) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $item['producto_id'],
                'talla' => $item['talla'],
                'color' => $item['color'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio']
            ]);
        }

        session()->forget('carrito');

        return redirect()->route('pedidos.mis')->with('success', 'Pedido realizado correctamente');
    }
    public function misPedidos()
    {
        //esto es para los pedidos de los usuarios
        $usuario = Auth::user();
        $pedidos = $usuario->pedidos()->with('detalles.producto')->latest()->get();

        return view('pedidos.mis', compact('pedidos'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class PedidosController extends Controller
{
    public function confirmarPedido()
{
    $carrito = session('carrito', []);
    $usuario = Auth::user();

    if (empty($carrito)) {
        return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío');
    }

    $total = 0;
    $erroresStock = [];

    // 1. Validar stock
    foreach ($carrito as $item) {
        $producto = Product::find($item['producto_id']);

        if (!$producto) {
            $erroresStock[] = "El producto con ID {$item['producto_id']} no existe.";
        } elseif ($producto->stock < $item['cantidad']) {
            $erroresStock[] = "No hay suficiente stock para el producto {$producto->nombre} (Disponible: {$producto->stock}, Solicitado: {$item['cantidad']}).";
        }

        $total += $item['precio'] * $item['cantidad'];
    }

    if (!empty($erroresStock)) {
        return redirect()->route('carrito.index')->withErrors($erroresStock);
    }

    // 2. Crear pedido
    $pedido = Pedido::create([
        'user_id' => $usuario->id,
        'total' => $total,
        'estado' => 'pendiente'
    ]);

    // 3. Guardar detalles y descontar stock
    foreach ($carrito as $item) {
        DetallePedido::create([
            'pedido_id' => $pedido->id,
            'producto_id' => $item['producto_id'],
            'talla' => $item['talla'],
            'color' => $item['color'],
            'cantidad' => $item['cantidad'],
            'precio_unitario' => $item['precio']
        ]);

        // Descontar stock
        $producto = Product::find($item['producto_id']);
        $producto->stock -= $item['cantidad'];
        $producto->save();
    }

    // 4. Limpiar carrito
    session()->forget('carrito');

    return redirect()->route('pedidos.mis')->with('success', 'Pedido realizado correctamente');
}
    public function misPedidos()
    {
        $usuario = Auth::user();
        $pedidos = $usuario->pedidos()->with('detalles.producto')->latest()->get();

        return view('pedidos.mis', compact('pedidos'));
    }
}

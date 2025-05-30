<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    public function agregar1(Request $request)
    {
        $producto = Product::findOrFail($request->producto_id);
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad']++;
        } else {
            $carrito[$producto->id] = [
                'nombre' => $producto->name,
                'precio' => $producto->price,
                'imagen' => $producto->image,
                'cantidad' => 1,
            ];
        }

        session()->put('carrito', $carrito);
        return redirect()->route('home')->with('success', 'Producto agregado al carrito.');
    }




    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:products,id',
            'cantidad' => 'required|integer|min:1',
            'talla' => 'required|string',
            'color' => 'required|string',
        ]);

        $producto = Product::findOrFail($request->producto_id);
        $carrito = session()->get('carrito', []);

        $key = $producto->id . '_' . $request->talla . '_' . $request->color;

        if (isset($carrito[$key])) {
            $carrito[$key]['cantidad'] += $request->cantidad;
        } else {
            $carrito[$key] = [
                'producto_id' => $producto->id,
                'nombre' => $producto->name,
                'precio' => $producto->price,
                'imagen' => $producto->image,
                'talla' => $request->talla,
                'color' => $request->color,
                'cantidad' => $request->cantidad,
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }


    public function actualizar(Request $request)
    {
        if ($request->id && $request->cantidad) {
            $carrito = session()->get('carrito');
            $carrito[$request->id]['cantidad'] = $request->cantidad;
            session()->put('carrito', $carrito);
        }
        return redirect()->route('carrito.index');
    }

    public function eliminar(Request $request)
    {
        $carrito = session()->get('carrito');
        unset($carrito[$request->id]);
        session()->put('carrito', $carrito);
        return redirect()->route('carrito.index');
    }
}

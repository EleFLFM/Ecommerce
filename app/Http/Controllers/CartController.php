<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();
        
        return view('cart.index', compact('products', 'cart'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = $request->session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'quantity' => 1,
                'price' => $product->price
            ];
        }
        
        $request->session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Producto añadido al carrito');
    }

    public function remove(Request $request, $productId)
    {
        $cart = $request->session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $request->session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }

    public function update(Request $request, $productId)
    {
        $quantity = $request->input('quantity');
        $cart = $request->session()->get('cart', []);
        
        if (isset($cart[$productId]) && $quantity > 0) {
            $cart[$productId]['quantity'] = $quantity;
            $request->session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Carrito actualizado');
    }
}
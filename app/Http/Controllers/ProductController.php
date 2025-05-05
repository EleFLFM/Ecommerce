<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $productos = Product::all();
        return view('client.dashboard', compact('productos'));
    }
    //filtrar por categorias

    public function porCategoria($slug)
    {
        $category = Category::where('name', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();

        return view('client.dashboard', compact('products', 'category'));
    }
    public function show($id)
    {
        $producto = Product::with('category')->findOrFail($id); // Asegúrate de tener la relación con categoría

        return view('products.show', compact('producto'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

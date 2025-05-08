<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // if (auth()->user()->role !== 'admin') {
        //     abort(403, 'Acceso no autorizado');
        // }

        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        // if (auth()->user()->role !== 'admin') {
        //     abort(403, 'Acceso no autorizado');
        // }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string'
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoría creada exitosamente');
    }

    public function update(Request $request, Category $category)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
        'description' => 'nullable|string'
    ]);

    $category->update($validated);

    return redirect()->route('admin.categories.index')
        ->with('success', 'Categoría actualizada exitosamente');
}

    public function destroy(Category $category)
    {
        // if (auth()->user()->role !== 'admin') {
        //     abort(403, 'Acceso no autorizado');
        // }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Categoría eliminada exitosamente');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $user = Auth::user();
    if ($user->role !== 'admin') {
        abort(403, 'Acceso no autorizado');
    }

    $query = User::query();

    // Búsqueda por nombre o email
    if ($request->has('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        });
    }

    // Filtro por rol
    if ($request->has('role') && !empty($request->role)) {
        $query->where('role', $request->role);
    }

    // Ordenar por ID descendente
    $query->orderBy('id', 'desc');

    // Paginar resultados
    $users = $query->paginate(10)->withQueryString();

    return view('admin.users.index', compact('users'));
}

    /**
     * Show the form for creating a new resource.
     */
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            // 'role' => 'required|in:user,admin'
        ]);

        // Actualizar el usuario
        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario eliminado exitosamente');
    }
}

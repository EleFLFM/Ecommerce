<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function     index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.dashboard');
        } elseif ($user->role === 'client') {

            $products = Product::all();
            $categories = Category::with('products')->get();
            return view('client.dashboard', compact('products','categories'));
        }
    }

}

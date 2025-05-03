<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user(); // O auth()->user()

        if ($user->role === 'admin') {
            return view('admin.dashboard');
        } elseif ($user->role === 'client') {
            return view('client.dashboard');
        } else {
            return view('other.dashboard');
        }
    }
}

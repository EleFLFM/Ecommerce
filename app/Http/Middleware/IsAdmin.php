<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin{
public function handle(Request $request, Closure $next): Response
{
    // Verifica si el usuario está autenticado y es admin
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        abort(403, 'Acceso restringido a administradores');
    }

    return $next($request);
}
}

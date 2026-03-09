<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Vérifie que l'utilisateur est admin.
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie que l'utilisateur est connecté et qu'il est admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // redirige vers home ou renvoie 403
            abort(403, 'Accès interdit : administrateur requis.');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->roles === 'admin') {
            return $next($request);
        }

        // Si el usuario no es un administrador, redireccionar o mostrar un mensaje de error.
        return redirect()->route('acceso-no-autorizado');
    }
}
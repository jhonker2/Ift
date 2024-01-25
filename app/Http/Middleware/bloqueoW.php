<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class bloqueoW
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si la sesión ha sido iniciada
        if (!$request->session()->has('SESSION_ID')) {
            // Si no hay sesión, redirige al usuario a la página de inicio de sesión
            return redirect()->route('error');
        }

        // Si hay sesión, permite que la solicitud continúe
        return $next($request);
    }
}

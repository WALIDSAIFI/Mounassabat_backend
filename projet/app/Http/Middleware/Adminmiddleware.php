<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Auth::user()->role;

        if (Auth::check() && $role === 'administrateur') {
            return $next($request);
        }

        return response()->json([
            'error' => 'Vous n\'avez pas accès à cette section.',
        ], 403);
    }
}

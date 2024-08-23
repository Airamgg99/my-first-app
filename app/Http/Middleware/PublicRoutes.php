<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicRoutes
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // OYE YA ESTAS LOGUEADO
            return redirect()->route('index');
        }

        return $next($request);
    }
}

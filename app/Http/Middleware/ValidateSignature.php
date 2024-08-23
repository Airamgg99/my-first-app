<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateSignature
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasValidSignature()) {
            return redirect()->route('logout');
        }

        return $next($request);
    }
}

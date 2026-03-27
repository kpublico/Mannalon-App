<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckFarmer
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isFarmer()) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Farmer access only.');
    }
}

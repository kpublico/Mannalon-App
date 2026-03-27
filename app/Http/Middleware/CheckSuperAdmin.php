<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isSuperAdmin()) {
            return $next($request);
        }

        return redirect()->route('admin.dashboard')->with('error', 'Super Admin access required.');
    }
}

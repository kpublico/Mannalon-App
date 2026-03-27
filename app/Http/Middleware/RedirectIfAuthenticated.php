<?php

namespace App\Http\Middleware;

// use Illuminate\Auth\Middleware\RedirectIfAuthenticated as Middleware;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (\Illuminate\Support\Facades\Auth::guard($guard)->check()) {
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}

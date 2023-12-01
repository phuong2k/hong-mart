<?php

namespace App\Http\Middleware;

use Closure;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Nếu không phải là HTTPS, chuyển hướng sang HTTPS
        if (app()->environment('production') && !$request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $user_type = $user->user_type;

        return $next($request);
    }
}

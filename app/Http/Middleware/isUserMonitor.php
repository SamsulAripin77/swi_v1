<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isUserMonitor
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
        if(Auth::user() && (Auth::user()->roles->where('title', '=', 'User Monitor')->count() > 0)){
            return $next($request);
        }
        abort(404);
    }
}

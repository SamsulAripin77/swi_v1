<?php

namespace App\Http\Middleware;


use Closure;
use Auth;

class IsUserMitra
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

        if(Auth::user() && (Auth::user()->roles->where('title', '=', 'Mitra')->count() > 0 || Auth::user()->roles->where('title', '=', 'Super Admin')->count() > 0)){
            return $next($request);
        }
        abort(404);
    }
}

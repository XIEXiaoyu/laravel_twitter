<?php

namespace App\Http\Middleware;

use Closure;

class ifLoggedin
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
        if(! $request->session()->get('user_id'))
        {
            return redirect('login');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\News;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SetGlobalAuthVariables
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
        if(Auth::check()){
            View::share('user', Auth::user()->name);
            View::share('news', News::all());
        }

        return $next($request);
    }
}

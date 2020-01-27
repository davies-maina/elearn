<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Administrator
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
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return $next($request);
            } else {
                $request->session()->flash('error', 'You are not allowed to perform this action');
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}

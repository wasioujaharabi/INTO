<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('LoggedUser') && ($request->path() != 'Auth/login' && $request->path()!='Auth/register')){
            return redirect('Auth/login')-> with('fail','Log in to see The page');
        }
        if(session()->has('LoggedUser')&& ($request->path()=='Auth/login'||$request->path()=='Auth/register')){
            return back();
        }
        return $next($request);
    }
}

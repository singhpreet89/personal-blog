<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        /* If the user is not Authenticated OR is not an Admin then send him back to the index page
         *
         * This user()->role is equivalent to user()->admin because the value of $role='admin' and is passed from the Constructor of Controller
         * Auth::user()->admin is checking the value of admin field within the users table with the help of AUTH FACADE
         */
        if(Auth::check() == false || Auth::user()->$role != true)
        {
            return redirect('/');
        }
        return $next($request);
    }
}

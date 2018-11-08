<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkUserAndAdmin
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

        if(Auth::user()->user_role == 'Beide'){
            return $next($request);
        } elseif(Auth::user()->user_role == 'Beheerder') {
            redirect('/manage_stock');
        } else {
            redirect('/stock');
        }
        
    }
}

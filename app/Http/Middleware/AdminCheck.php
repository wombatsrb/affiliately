<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheck
{

    
    public function handle($request, Closure $next)
    {
        if($request->session()->has('user')){
            $user = $request->session()->get('user');
            if($user->role_name == 'Admin'){
                return $next($request);
            } else {
                return abort(404);
            }
        }
        
        return abort(404);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;

class UserCheck
{

    
    public function handle($request, Closure $next)
    {
        if($request->session()->has('user')){
            $user = $request->session()->get('user');
            if($user->role_name == 'User'){
                return $next($request);
            } else {
                return abort(404);
            }
        }
        
        return abort(404);
    }
}
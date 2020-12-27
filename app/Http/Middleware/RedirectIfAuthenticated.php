<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\UserType;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // return redirect(RouteServiceProvider::HOME);
            $userType = Auth::user()->user_type_id;
            $userType = UserType::where('id',Auth::user()->user_type_id)->value('type');
            
            if ($userType=='provider') {
                return redirect('/provider/profile');
            }
            return redirect('/user/buildingMaterialServices');
        }

        return $next($request);
    }
}

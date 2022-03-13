<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param mixed                    $guard
     *
     * @return mixed
     */
    // public function handle($request, Closure $next, $guard = 'admin')
    // {
    //     $user = $request->user();
    //     if (Auth::guard($guard)->guest()) {
    //         if ($user && 'ADMIN' == $user->role) {
    //         } else {
    //             return redirect()->route('login');
    //         }
    //     }
    //     return $next($request);
    // }

    public function handle($request, Closure $next, $guard = 'admin')
    {
        // if (Auth::guard($guard)->guest()) {
        //     if ($request->ajax() || $request->wantsJson()) {
        //         return response('Unauthorized.', 401);
        //     } else {
        //         return redirect()->route('login');
        //     }
        // }
        // return $next($request);
        if (Auth::guard('admin')->user() !== null) {
            $user = $request->user();
            // if ($user != null && 'ADMIN' == $user->role || 'USER' == $user->role || 'SUPERADMIN' == $user->role) {
            // } else {
            //     return redirect()->route('login');
            // }
            // if ($request->ajax() || $request->wantsJson()) {
            //     return response('Unauthorized.', 401);
            // } else {
            //     return redirect()->route('login');
            // }
        } else {
            return redirect()->route('login');
        }

        return $next($request);
    }
}

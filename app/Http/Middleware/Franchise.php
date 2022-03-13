<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Franchise
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
    // public function handle($request, Closure $next, $guard = 'franchise')
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

    public function handle($request, Closure $next, $guard = 'franchise')
    {
        if (Auth::guard($guard)->guest()) {
            $user = $request->user();
             if ($user && 'FRANCHISE' == $user->role) {
            } else {
                return redirect()->route('login');
            }
            // if ($request->ajax() || $request->wantsJson()) {
            //     return response('Unauthorized.', 401);
            // } else {
            //     return redirect()->route('login');
            // }
        }

        return $next($request);
    }
}

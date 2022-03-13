<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class User
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
    public function handle($request, Closure $next, $guard = 'user')
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->user_type == 'USER') {
            return redirect()->route('login');
        }

        return $next($request);
    }
}

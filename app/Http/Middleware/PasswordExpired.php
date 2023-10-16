<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class PasswordExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guard = $this->guardName();
        if (auth()->guard($guard)->check()) {
            $user = auth()->guard($guard)->user();
            $password_changed_at = new Carbon(($user->password_changed_at) ? $user->password_changed_at : $user->created_at);

            if (Carbon::now()->diffInDays($password_changed_at) >= config('auth.password_expires_days')) {
                return redirect()->route('change.password')->with('warning', "Your Password is expired, You need to change your password.");
            }
            return $next($request);
        }
        abort('403');
    }

    public function guardName()
    {
        $guards = array_keys(config('auth.guards'));
        foreach($guards as $guard){
            if(auth()->guard($guard)->check()){
                return $guard;
            }
        }
    }
}

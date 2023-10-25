<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectWordpressUserToAuth
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
        if (is_user_logged_in()) {
            $username = wp_get_current_user()->user_login;
            // $foundFasUser = $allUsers->where("name", $username)->first();
            $user = User::where("name", $username)->first();
            if ($user) {
                Auth::setUser($user);
            }
        }

        return $next($request);
    }
}

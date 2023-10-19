<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Closure;

class AuthenticationAware extends Middleware
{
    /**
     * This set the user if logged in but unlike Authentication
     * still permits to access the page by not redirecting to login if not
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, $next, ...$guards): Response
    {

        $allUsers=User::all();
        $username=wp_get_current_user()->user_login;
        $foundFasUser=$allUsers->where("name", $username)->first();
        if ($foundFasUser!==null) {
            Auth::setUser($foundFasUser);
        }

        return $next($request);
    }
}

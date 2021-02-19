<?php

namespace App\Http\Middleware;

use Closure;
use App\Consts\Roles;
use App\Actions\GetRedirectAction;

class AdminCustom
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
        $user = auth()->user();

        if($user->role_id != Roles::ADMIN) {
            $redirect = (new GetRedirectAction)($user);
            return redirect($redirect);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Actions\GetRedirectAction;

class CustomGuest
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
        if(auth()->check()) {
            $redirect = (new GetRedirectAction)(auth()->user());
            return redirect($redirect);
        }
        return $next($request);
    }
}

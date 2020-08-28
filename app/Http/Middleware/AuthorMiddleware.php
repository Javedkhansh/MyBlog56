<?php

namespace App\Http\Middleware;

use Closure;

class AuthorMiddleware
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
        // return $next($request);
        $user = $request->user();
        if($user->role->id === 1 || $user->role->id === 2 ){
            return $next($request);
        }
        return redirect('/');
    }
}

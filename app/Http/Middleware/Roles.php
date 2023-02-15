<?php
 
namespace App\Http\Middleware;
 
use Closure;
 
class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if((auth()->user()->level == "u") AND count(array_intersect($role, auth()->user()->units_current()->roles())) == 0):
            abort(403);
        endif;
        
        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;

class CheckCustomerOffer
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

        $mNext =$next($request);

            return $mNext;



    }
}

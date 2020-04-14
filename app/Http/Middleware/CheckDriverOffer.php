<?php

namespace App\Http\Middleware;

use Closure;

class CheckDriverOffer
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
        if($mNext->original->driverOffer->status_id==1)
        {
            return $mNext;
        }
        return redirect()->back();

    }
}

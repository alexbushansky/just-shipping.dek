<?php

namespace App\Http\Middleware;

use Closure;

class CheckActiveOrder
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

        if($mNext->original->order->customer->user->id == $request->user()->id)
        {
            return $mNext;

        }

        if($mNext->original->order->driver->user->id == $request->user()->id)
        {
            return $mNext;
        }

        return redirect()->back();
    }
}

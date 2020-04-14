<?php

namespace App\Http\Middleware;

use Closure;

class CheckListActiveOrders
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
        $mNext = $next($request);
        $user =$request->user();

        foreach ($mNext->original->orders as $order)
        {
            if($order->driver->user->id==$user->id || $order->customer->user->id == $user->id)
            {
                return $mNext;
            }

        }

        return redirect()->back();
    }
}

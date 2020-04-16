<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserCabinet
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
        if($mNext->original->user->id == auth()->user()->id)
        {
            return $mNext;
        }
        return redirect()->back();
    }
}

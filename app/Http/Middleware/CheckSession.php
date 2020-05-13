<?php

namespace App\Http\Middleware;

use View;
use Closure;

class CheckSession
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
        $input = $request->all();
        if(empty($input))
            return redirect('login');
        return $next($request);
    }
}

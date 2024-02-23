<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class middle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $name = $request->path();
        if($request->session()->has('role'))
            if($request->session()->get('role') != '')
                if(str_contains($name,$request->session()->get('role')))            
                    return $next($request);
        
        return redirect('/');
    }
}

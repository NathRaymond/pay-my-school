<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Applicant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        if (auth()->user()->user_type == "Applicant") {
            return $next($request);
            // return redirect('/logout');
        }
        // dd("here");
        return redirect()->route('api.unauthorized');
    }
}

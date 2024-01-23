<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role_id)
    {
        if (Auth::check()) {
            // Check if the user has the required role
            if (Auth::user()->role_id == $role_id) {
                return $next($request);
            } else {
                return response()->json(["error" => "You don't have permission to access this page"]);
            }
        } else {
            // Handle the case where the user is not authenticated
            return response()->json(["error" => "Unauthorized"]);
        }


    }
}

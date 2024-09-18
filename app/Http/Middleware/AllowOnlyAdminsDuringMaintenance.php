<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AllowOnlyAdminsDuringMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /* public function handle(Request $request, Closure $next)
    {
        // Check if the application is in maintenance mode
        if (app()->isDownForMaintenance()) {
            // Retrieve the currently authenticated user
            $user = $request->user();
            
            // Log user role and maintenance mode status
            Log::info('Maintenance mode status: true');
            Log::info('User role: ' . ($user ? $user->role : 'No authenticated user'));

            // Check if the user is authenticated and has the correct role
            if ($user && ($user->role === 'System Admin' || $user->role === 'ICT Admin')) {
                return $next($request);
            }

            // Return a 503 Service Unavailable response if not authorized
            return response('Service Unavailable', 503);
        }

        return $next($request);
    } */
}

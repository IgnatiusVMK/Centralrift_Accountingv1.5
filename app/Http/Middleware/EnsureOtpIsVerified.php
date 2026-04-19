<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureOtpIsVerified
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

        // Fetch the authenticated user
        $user = Auth::user();

        // Check if the user exists and if OTP verification is required
        if ($user && $user->otp_enabled === 0) {
            // Allow the user to proceed without OTP verification
            return $next($request);
        }

        // Check if the OTP has been verified
        if (!Session::has('otp_verified')) {
            // Avoid redirecting to OTP page if the user is already on that page
            if ($request->route()->getName() !== 'otp-authform') {
                return redirect()->route('otp-authform');
            }
        }

        return $next($request);
    }
}

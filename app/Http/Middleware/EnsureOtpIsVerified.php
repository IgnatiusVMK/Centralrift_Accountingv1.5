<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        // Check if the OTP has been verified (could use session or database flag)
        if (!Session::has('otp_verified')) {
            // Avoid redirecting to OTP page if the user is already on that page
            if ($request->route()->getName() !== 'otp-authform') {
                return redirect()->route('otp-authform');
            }
        }

        return $next($request);
    }
}

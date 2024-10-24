<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Jobs\SendMail;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = Auth::user();
        // Check if OTP is enabled for this user
        if ($user->otp_enabled) {

            // Check if OTP is already verified
            if (session()->has('otp_verified') && session('otp_verified') === true) {
                // If OTP is already verified, redirect to the dashboard
                return redirect()->route('dashboard');
            }

            //Generate OTP 
            $otp = rand(100000, 999999); //Generates 6-digit OTP

            // Save OTP in Session
            session(['otp'=> $otp]);

            //Log OTP for offline testing purposes
            Log::info('Generated OTP for user '. Auth::user()->email.' : ' .$otp);

            $user = Auth::user();
            $mail_to = Auth::user()->email;

            // Prepare OTP for dispatch
            $dispatchData = [
                'mail_to' => $mail_to,
                'subject' => 'OTP Login Request',
                'message' => 'You recently attempted to log in to your account. Please use the one-time password (OTP) below to complete your login:',
                'otp' => $otp,
                'mailable' => 'LoginOtpMail',
                'user_name' => Auth::user()->name,
            ];

            // Dispatch the Otp for Login Authetication
            dispatch(new SendMail($dispatchData, $user));

            //Redirect user to OTP Verification Page.
            return redirect ()->route('otp-authform')->with('success','A One TIme Password has been sent to your mail.');
        }
        
        // If OTP is disabled, log the user in directly
        $request->session()->regenerate();

        $user = Auth::user();
            $mail_to = Auth::user()->email;
            $now = Carbon::now('Africa/Nairobi');
            $currentTime = $now->format('Y-m-d h:i:s');

            $dispatchData = [
                'mail_to' => $mail_to,
                'subject' => 'New Login Notification',
                'message' => 'We noticed a new login to your account. Here are the details:',
                'login_time' => $currentTime,
                'mailable' => 'LoginNotificationMail',
                'user_name' => Auth::user()->name,
            ];

            // Dispatch the job
        dispatch(new SendMail($dispatchData, $user));
        return redirect()->intended(RouteServiceProvider::HOME);

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

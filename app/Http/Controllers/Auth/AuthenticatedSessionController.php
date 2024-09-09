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

        $request->session()->regenerate();

        $user = Auth::user();
        $mail_to = Auth::user()->email;
        $now = Carbon::now('Africa/Nairobi');
        $currentTime = $now->format('Y-m-d h:i:s');

        // Prepare dispatch data
        $dispatchData = [
            'mail_to' => $mail_to,
            'subject' => "New Login Notification",
            'message' => "Your account has been logged in today as at; " . $currentTime,
            'mailable' => "LoginNotificationMail",
            'user_name' => Auth::user()->name,
        ];
        // Dispatch the job
        dispatch(new SendMail($dispatchData, $user));
        /* SendMail::dispatch($dispatchData, $user); */

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

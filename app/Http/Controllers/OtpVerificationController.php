<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OtpVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.otp-verify');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function verify(Request $request)
    {

        $request->validate([
            'otp'=>'required|numeric',
        ]);

        // Here, retrieve the OTP sent to the user, e.g., stored in session or the database.
        $sentOtp = Session::get('otp');

        // Get the user's actual IP address
        $userIp = $request->ip(); // This will take into account the trusted proxy headers


        if ($sentOtp && $request->input('otp') == $sentOtp) {
            // If OTP matches, mark the OTP as verified in the session
            Session::put('otp_verified', true);

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

            /// Redirect to the intended page, typically the dashboard or any other protected route
            return redirect()->route('dashboard');

        }
        // If OTP doesn't match, redirect back with an error message
        return redirect()->route('otp-authform')->with('error', 'The provided OTP is incorrect.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

     public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

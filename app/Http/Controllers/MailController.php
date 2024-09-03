<?php

namespace App\Http\Controllers;

use App\Jobs\SendCashBook;
use App\Jobs\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public function index()
    {
        $jobs = DB::table('jobs')->get();
        $failedJobs = DB::table('failed_jobs')->get();

        return view('emailwelcome', compact('jobs', 'failedJobs'));
    }

    public function sendMail(Request $request)
    {
        $mailable = "WelcomeMail";

        $request->validate([
            'mail_to' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $dispatchData = [
            'mail_to' => $request->mail_to,
            'subject' => $request->subject,
            'message' => $request->message,
            'mailable' =>$mailable,
            'user_name' => Auth::user()->name,
        ];

        dispatch(new SendMail($dispatchData));

        /* SendMail::dispatch($dispatchData); */

        toastr()->success('Mail sent successfully');
        return redirect('/welcome');
    }
}
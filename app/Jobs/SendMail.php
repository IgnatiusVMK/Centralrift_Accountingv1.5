<?php

namespace App\Jobs;

use App\Mail\CashbookMail;
use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $dispatchData;
    public $name;
    public $email;

    /**
     * Create a new job instance.
     */
    public function __construct($dispatchData, $user)
    {
        $this->dispatchData = $dispatchData;
        $this->name = $user->name;
        $this->email = $user->email;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
{
    $mailableClass = $this->dispatchData['mailable'];
    $mailTo = $this->dispatchData['mail_to'];
    
    switch ($mailableClass) {
        case 'WelcomeMail':
            $mailable = new WelcomeMail([
                'subject' => $this->dispatchData['subject'],
                'message' => $this->dispatchData['message'],
                'user_name' => $this->dispatchData['user_name'],
            ]);
            break;

        case 'CashbookMail':
            $mailable = new CashbookMail([
                'subject' => $this->dispatchData['subject'],
                'message' => $this->dispatchData['message'],
                'user_name' => $this->name, // Pass the name directly
            ]);
            break;

        default:
            throw new \Exception("Mailable class not found: {$mailableClass}");
    }

    try {
        Mail::to($mailTo)->send($mailable);
    } catch (\Exception $e) {
        Log::error('Failed to send email: ' . $e->getMessage());
        throw $e; // Re-throw the exception to mark the job as failed
    }
}

}
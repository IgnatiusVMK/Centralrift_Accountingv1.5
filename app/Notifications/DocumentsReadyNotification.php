<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class DocumentsReadyNotification extends Notification /* implements ShouldQueue */
{
    use Queueable;

    public $zipPath;
    public $documents;

    // public function __construct(string $zipPath, array $documents = [])
    // {
    //     $this->zipPath = $zipPath;
    //     $this->documents = $documents;
        
    //     Log::info('Notification created', [
    //         'zip_path' => $zipPath,
    //         'documents_count' => (count($this->documents['invoices'] ?? [])) + (count($this->documents['delivery_notes'] ?? []))
    //     ]);
    // }

    public function __construct(string $zipPath, array $documents = [])
    {
        $this->zipPath = $zipPath;
        $this->documents = $documents;
        
        Log::debug('Notification constructor called', [
            'zip_path' => $zipPath,
            'documents' => $documents,
            'mail_config' => [
                'driver' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'from' => config('mail.from'),
                'queue' => config('queue.default')
            ],
            'app_env' => config('app.env')
        ]);
    }

    /* public function via($notifiable)
    {
        Log::info('Determining notification channels', [
            'user_id' => $notifiable->id,
            'email' => $notifiable->email
        ]);
        
        return ['mail', 'database'];
    } */
   public function via($notifiable)
{
    $channels = ['database'];
    
    if (filter_var($notifiable->email, FILTER_VALIDATE_EMAIL)) {
        $channels[] = 'mail';
    } else {
        Log::error('Invalid email address for notification', [
            'user_id' => $notifiable->id,
            'email' => $notifiable->email
        ]);
    }
    
    return $channels;
}

    public function toMail($notifiable)
{
    Log::info('Sending DocumentsReadyNotification', [
        'to' => $notifiable->email,
        'zip_path' => $this->zipPath,
        'mailer' => config('mail.default'),
        'host' => config('mail.mailers.smtp.host')
    ]);

    try {
        $mail = (new MailMessage)
            ->subject('Your Documents Are Ready')
            ->line('We have generated the following documents for you:')
            ->line(sprintf('- Invoices: %d', count($this->documents['invoices'] ?? [])))
            ->line(sprintf('- Delivery Notes: %d', count($this->documents['delivery_notes'] ?? [])))
            ->action('Download Documents', url('/documents/download/'.$this->zipPath))
            ->line('Thank you for using our application!');

        Log::debug('MailMessage created', ['mail' => $mail]);
        return $mail;
        
    } catch (\Exception $e) {
        Log::error('Mail creation failed', ['error' => $e->getMessage()]);
        throw $e;
    }
}

    public function toDatabase($notifiable)
    {
        return [
            'zip_path' => $this->zipPath,
            'invoices' => $this->documents['invoices'] ?? [],
            'delivery_notes' => $this->documents['delivery_notes'] ?? [],
            'download_url' => url('/documents/download/'.$this->zipPath),
            'generated_at' => now()->toDateTimeString()
        ];
    }
}
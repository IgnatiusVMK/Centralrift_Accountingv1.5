<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Sales;
use App\Models\User;
use App\Notifications\DocumentsReadyNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\Log;

class GenerateInvoicesDelivery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $salesIds;
    protected $options;
    protected $userId;
    protected $generatedFiles = [];

    public function __construct(array $salesIds, array $options, int $userId)
    {
        $this->salesIds = $salesIds;
        $this->options = $options;
        $this->userId = $userId;
    }

    public function handle()
    {
        // Notify user with document details
            $user = User::findOrFail($this->userId);

            // In your handle() method, before sending notification:
            Log::info('System check before notification', [
                'queue_connection' => config('queue.default'),
                'mail_driver' => config('mail.default'),
                'queue_on' => config('queue.default') !== 'sync',
                'user_has_email' => !empty($user->email),
                'user_notifiable' => method_exists($user, 'routeNotificationForMail')
            ]);

            if (empty($user->email)) {
                Log::error('Cannot send notification - user has no email', ['user_id' => $user->id]);
                return;
            }

            if (!method_exists($user, 'routeNotificationForMail')) {
                Log::error('User model is not notifiable', ['user_id' => $user->id]);
                return;
            }
        try {
            $sales = Sales::with('customer')->whereIn('Sales_Id', $this->salesIds)->get();
            
            if ($sales->isEmpty()) {
                throw new \Exception("No sales records found");
            }

            $tempDir = 'temp/docs_'.$this->userId.'_'.time();
            Storage::makeDirectory($tempDir);

            // Generate documents
            foreach ($sales as $sale) {
                if ($this->options['generate_invoice']) {
                    $this->generateInvoice($sale, $tempDir);
                }
                
                if ($this->options['generate_delivery_note']) {
                    $this->generateDeliveryNote($sale, $tempDir);
                }
            }

            $zipPath = $this->createZip($tempDir);
            Storage::deleteDirectory($tempDir);
            
            // Notify user with document details
            $user = User::findOrFail($this->userId);

            // $user->notify(new DocumentsReadyNotification(
            //     $zipPath,
            //     [
            //         'invoices' => $this->getGeneratedFilesByType('invoice'),
            //         'delivery_notes' => $this->getGeneratedFilesByType('delivery_note')
            //     ]
            // ));

            // Verify documents were generated
            if (empty($this->generatedFiles)) {
                Log::error('No documents were generated', ['sales_ids' => $this->salesIds]);
                return;
            }

            Log::info('Dispatching notification', [
                'user_id' => $this->userId,
                'zip_path' => $zipPath,
                'documents_count' => count($this->generatedFiles)
            ]);

            Log::info('Queue connection: '.config('queue.default'));
            Log::info('Mail driver: '.config('mail.driver'));

            $user->notify(new DocumentsReadyNotification(
                $zipPath,
                [
                    'invoices' => $this->getGeneratedFilesByType('invoice'),
                    'delivery_notes' => $this->getGeneratedFilesByType('delivery_note'),
                    'generated_at' => now()->toDateTimeString()
                ]
            ));

            Log::info('Notification should have been sent', [
                'user' => $user->id,
                'email' => $user->email,
                'channels' => $user->preferredNotificationChannels()
            ]);

            Log::info('Documents ready notification dispatched', [
                'user_id' => $user->id,
                'documents_count' => count($this->generatedFiles)
            ]);

            return $zipPath;

        } catch (\Exception $e) {
            Log::error("Document generation failed: " . $e->getMessage());
            throw $e; // Will trigger job retry if configured
        }
    }

    protected function generateInvoice($sale, $tempDir)
    {
        $pdf = Pdf::loadView('financials.sales.invoice', [
            'sales' => [$sale],
            'invoiceDetails' => $sale,
            'CustomerInvoiceDetails' => $sale->customer
        ]);
        
        $filename = "invoice_{$sale->Sales_Id}.pdf";
        Storage::put("$tempDir/$filename", $pdf->output());
        $this->generatedFiles[] = ['type' => 'invoice', 'id' => $sale->Sales_Id];
    }

    protected function generateDeliveryNote($sale, $tempDir)
    {
        $pdf = Pdf::loadView('financials.sales.delivery_note', [
            'sale' => $sale,
            'customer' => $sale->customer
        ]);
        
        $filename = "delivery_note_{$sale->Sales_Id}.pdf";
        Storage::put("$tempDir/$filename", $pdf->output());
        $this->generatedFiles[] = ['type' => 'delivery_note', 'id' => $sale->Sales_Id];
    }

    protected function createZip($tempDir)
    {
        $zip = new ZipArchive;
        $zipName = 'documents_'.time().'.zip';
        $zipPath = storage_path("app/$tempDir/$zipName");
        
        if ($zip->open($zipPath, ZipArchive::CREATE) !== TRUE) {
            throw new \Exception("Could not create ZIP file");
        }

        $files = Storage::files($tempDir);
        
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                $zip->addFile(
                    storage_path("app/$file"),
                    basename($file)
                );
            }
        }
        
        $zip->close();
        return "$tempDir/$zipName";
    }

    protected function getGeneratedFilesByType(string $type): array
    {
        return array_map(function($file) {
            return $file['id'];
        }, array_filter($this->generatedFiles, function($file) use ($type) {
            return $file['type'] === $type;
        }));
    }
}
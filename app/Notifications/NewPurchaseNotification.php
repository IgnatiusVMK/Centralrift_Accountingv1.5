<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Purchase;

class NewPurchaseNotification extends Notification
{
    protected $purchase;

    // Constructor to pass in the purchase details
    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    // Define which channels the notification will be sent through
    public function via($notifiable)
    {
        return ['database'];  // Send via database and queue
    }

    // The data to store in the database channel
    public function toDatabase($notifiable)
    {

        return [
            'purchase_id' => $this->purchase->Purchase_Id,
            'item_name' => $this->purchase->Item_Name,
            'total_cost' => $this->purchase->Total_Cost,
            'message' => "New purchase record created by: " . $this->purchase->maker->name,
        ];
    }
}

<?php

namespace Illuminate\Notifications;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Notification extends Model
{
    // The `notifications` table is used by default
    protected $table = 'notifications';

    // Define the data type for the 'data' column which stores JSON data
    protected $casts = [
        'data' => 'array',
    ];

    // The `notifiable` relation allows you to fetch the entity (e.g. a User)
    public function notifiable()
    {
        return $this->morphTo();
    }
}

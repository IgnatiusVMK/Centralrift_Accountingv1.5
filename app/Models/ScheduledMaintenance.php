<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledMaintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduled_at',
        'is_completed',
        'maker_id'
        
    ];

    // Specify the date casting for the scheduled_at column
    protected $casts = [
        'scheduled_at' => 'datetime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; 

class HarvestOrder extends Model
{
    use HasFactory;

    protected $table = 'harvest_orders';

    protected $fillable = [
        'product_name',
        'company_name',
        'order_date',
        'planting_date',
        'harvest_date',
    ];

    protected $dates = [
        'planting_date',
        'harvest_date',
    ];

    public function getProgressAttribute()
    {
        $plantingDate = Carbon::parse($this->planting_date);
        $harvestDate = Carbon::parse($this->harvest_date);
        $totalDays = $plantingDate->diffInDays($harvestDate);
        $elapsedDays = $plantingDate->isPast() ? $plantingDate->diffInDays(now()) : 0;

        $percentage = ($elapsedDays / $totalDays) * 100;
        $remainingDays = $harvestDate->diffInDays(now());

        return [
            'percentage' => number_format($percentage, 2),
            'total_days' => $totalDays,
            'elapsed_days' => $elapsedDays,
            'remaining_days' => $remainingDays,
        ];
    }


} 

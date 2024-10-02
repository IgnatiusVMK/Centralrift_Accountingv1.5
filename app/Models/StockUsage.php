<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockUsage extends Model
{
    use HasFactory;
    
    protected $table = "stock_usage";

    protected $fillable = [
        'Cycle_Id',
        'Allocation_Id',
        'quantity_used',
        'usage_date',
        'checker_id',
        'maker_id',
    ];
}

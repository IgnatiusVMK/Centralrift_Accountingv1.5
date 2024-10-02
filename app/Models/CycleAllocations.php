<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CycleAllocations extends Model
{
    use HasFactory;

    protected $table = 'cycle_allocations';

    protected $fillable = [
        'Cycle_Id',
        'stock_id',
        'allocated_quantity',
        'allocation_date',
        'remaining_quantity',
        'checker_id',
        'maker_id',
    ];
}

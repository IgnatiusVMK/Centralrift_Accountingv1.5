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

    public function maker(){
        return $this->belongsTo(User::class,'maker_id');
    }

    public function cyc_alloc(){
        return $this->belongsTo(Cycles::class,'Cycle_Id', 'Cycle_Id');
    }
    public function stock()
    {
        return $this->belongsTo(Stocks::class, 'stock_id', 'id');
    }
    public function getCategoryAttribute()
    {
        return $this->stock->purchase->Category_Id ?? null;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    use HasFactory;

    protected $table = 'stocks';
    protected $fillable = [
        'Purchase_Id',
        'Stock_Name',
        'Total_Quantity',
        'Remaining_Quantity',
        'Unit_Cost',
        'Total_Cost',
        'checker_id',
        'maker_id',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'Purchase_Id', 'Purchase_Id');
    }
    public function maker(){
        return $this->belongsTo(User::class,'maker_id');
    }
}

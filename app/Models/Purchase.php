<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';

    protected $fillable = [
        'Purchase_Id',
        'Item_Name',
        'Supplier_Id',
        'Category_Id',
        'Quantity',
        'Unit_Cost',
        'Total_Cost',
        'Status',
        'checker_id',
        'maker_id',
        'Purchase_Date'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'Supplier_Id', 'Supplier_Id');
    }
    public function maker(){
        return $this->belongsTo(User::class,'maker_id');
    }
}

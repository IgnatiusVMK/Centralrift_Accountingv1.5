<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';

    protected $fillable = [
        'Item_Name',
        'Supplier_Id',
        'Category_Id',
        'Quantity',
        'Unit_Cost',
        'Total_Cost',
        'checker_id',
        'maker_id',
        'Purchase_Date'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'Supplier_Id', 'Supplier_Id');
    }
}

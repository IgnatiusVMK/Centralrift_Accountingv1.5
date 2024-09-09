<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'maker_id',
        'Sales_Id',
        'Customer_Id',
        'Cycle_Id',
        'Lpo_No',
        'Sale_Date',
        'Net_Weight',
        'Total_Price',
        'Payment_Status',
        'packaging_option',
        'Description',
        'No_of_boxes',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_sales', 'Sales_Id', 'Product_Id');
    }

    public function customer(){
        return $this->belongsTo(Customers::class, 'Customer_Id', 'id');
    }

    public function maker(){
        return $this->belongsTo(User::class,'maker_id');
    }
}

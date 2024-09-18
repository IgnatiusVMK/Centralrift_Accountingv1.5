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
        'Cycle_Id',  
        'Sales_Id', 
        'Customer_Id',
        'Cust_Account_No',
        'Lpo_No',
        'Description', 
        'packaging_option',
        'Quantity',
        'Unit_Price', 
        'Total_Price',
        'Payment_Status', 
        'Sale_Date', 
        'Net_Weight', 
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

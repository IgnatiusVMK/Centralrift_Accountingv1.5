<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'Sales_Id',
        'Customer_Id',
        'Cycle_Id',
        'Sale_Date',
        'Quantity',
        'Total_Price',
        'Payment_Method',
        'Payment_Status',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_sales', 'Sales_Id', 'Product_Id');
    }

    public function customer(){
        return $this->belongsTo(Customers::class, 'Customer_Id', 'Customer_Id');
    }
}

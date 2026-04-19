<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProductPricing extends Model
{
    protected $table = 'customer_product_pricing';

    protected $fillable = [
        'customer_id',
        'product_id',
        'type',
        'price',
        'valid_from',
        'valid_to'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'Product_Id');
    }
}

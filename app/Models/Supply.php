<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_Id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'Supplier_Id');
    }
}

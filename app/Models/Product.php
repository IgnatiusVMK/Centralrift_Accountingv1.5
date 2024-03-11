<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'Category_Id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'Supplier_Id');
    }

    public function sales()
    {
        return $this->belongsToMany(Sales::class, 'products_sales', 'Product_Id', 'Sales_Id');
    }

    public function supplies()
    {
        return $this->hasMany(Supply::class, 'Product_Id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class, 'Supplier_Id');
    }

    public function supplies()
    {
        return $this->hasMany(Supply::class, 'Supplier_Id');
    }
}

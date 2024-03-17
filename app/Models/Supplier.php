<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'Supplier_Name',
        'Contact_Name',
        'Address',
        'Phone',
        'Email',
        'Created_Date',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'Supplier_Id');
    }

    public function supplies()
    {
        return $this->hasMany(Supply::class, 'Supplier_Id');
    }
}

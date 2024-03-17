<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'Category_Name',
        'Description',
        'Created_Date',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'Category_Id');
    }
}

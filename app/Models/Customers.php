<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'Customer_Id',
        'Customer_Fname',
        'Customer_Lname',
        'Email',
        'Contact',
        'Address'/* ,
        'is_active' */
    ];

    public function sales()
    {
        return $this->hasMany(Sales::class, 'Customer_Id');
    }
}

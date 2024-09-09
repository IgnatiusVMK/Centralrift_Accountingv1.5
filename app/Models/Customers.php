<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'Customer_Name',
        'Cust_Account_No',
        'Address',
        // Add other fields if necessary, like 'is_active'
    ];

    // Define the relationship with the Sales model
    public function sales()
    {
        return $this->hasMany(Sales::class, 'customer_id', 'id');
    }

    // Define the relationship with the SalesPerson model
    public function salespersons()
    {
        return $this->belongsToMany(SalesPerson::class, 'customer_salesperson', 'customer_id', 'sales_person_id');
    }
}

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
        'email',
        'AddressLine1',
        'AddressLine2',
        'City',
        'Region_State',
        'PostalCode',
        'Country',
        'invoicable',
        'AttentionTo'
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

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'customer_id', 'id');
    }

    public function pricing()
    {
        return $this->hasMany(CustomerProductPricing::class, 'customer_id');
    }

    public function invoiceAddress()
    {
        return $this->hasOne(CustomerInvoiceAddress::class, 'customer_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInvoiceAddress extends Model
{
    use HasFactory;

    protected $table = 'customer_invoice_addresses'; // optional if Laravel naming convention matches

    // Fillable columns (only ship_ prefixed columns plus customer_id)
    protected $fillable = [
        'customer_id',
        'ship_AddressLine1',
        'ship_AddressLine2',
        'ship_City',
        'ship_Region_State',
        'ship_PostalCode',
        'ship_Country',
    ];

    /**
     * Relationship to Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
}

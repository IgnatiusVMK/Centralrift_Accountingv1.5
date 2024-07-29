<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContacts extends Model
{
    use HasFactory;

    protected $table = 'supplier_contacts';

    protected $fillable = [
        'Supplier_Id',
        'Contact_Name',
        'Address',
        'Phone',
        'Email',
        'Created_Date',
    ];
}

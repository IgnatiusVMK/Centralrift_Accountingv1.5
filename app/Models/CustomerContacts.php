<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerContacts extends Model
{
    use HasFactory;

    protected $table = 'customer_contacts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'Customer_Id',
        'Email',
        'Contact',
        'Address'
    ];
}

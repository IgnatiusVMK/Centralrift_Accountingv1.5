<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPerson extends Model
{
    use HasFactory;

    protected $table = 'salespersons'; // specify the table name

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    /**
     * The customers that this salesperson is associated with.
     */
    public function customers()
    {
        return $this->belongsToMany(Customers::class, 'customer_salesperson', 'sales_person_id', 'customer_id');
    }

    /**
     * Get the full name of the salesperson.
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
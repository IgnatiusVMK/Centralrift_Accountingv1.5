<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccSales extends Model
{
    use HasFactory;

    protected $table = 'acc_sales';

    public function account()
    {
        return $this->belongsTo(Account::class, 'Transaction_Id');
    }

    public function sale()
    {
        return $this->belongsTo(Sales::class, 'Sales_Id');
    }
}

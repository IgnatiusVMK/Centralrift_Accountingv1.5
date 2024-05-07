<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'Transaction_Id',
        'Cycle_Id',
        'Description',
        'Crd_Amnt',
        'Dbt_Amt',
        'Bal',
        'Crd_Dbt_Date',
        'Date_Created',
        'checker_id',
        'maker_id',
    ];

    // Account.php

public function financial()
{
    return $this->hasOne(Financial::class, 'Transaction_Id', 'Cycle_Id');
}

public function sale()
{
    return $this->hasOne(Sales::class, 'Transaction_Id', 'Description');
}

public function purchase()
{
    return $this->hasOne(Purchase::class, 'Transaction_Id', 'Description');
}

public function credit()
{
    return $this->hasOne(Credit::class, 'Transaction_Id', 'Credit_Id');
}

}

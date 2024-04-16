<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapitalWithdrawal extends Model
{
    use HasFactory;

    protected $table = 'capital_withdrawal';

    protected $fillable = [
        'Capt_Withdraw_Id',
        'Description',
        'Amount'
    ];
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}

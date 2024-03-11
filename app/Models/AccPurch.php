<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccPurch extends Model
{
    use HasFactory;

    protected $table = 'acc_purch';

    public function account()
    {
        return $this->belongsTo(Account::class, 'Transaction_Id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'Purchase_Id');
    }
}

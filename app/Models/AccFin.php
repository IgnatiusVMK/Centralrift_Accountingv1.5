<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccFin extends Model
{
    use HasFactory;

    protected $table = 'acc_fin';

    public function account()
    {
        return $this->belongsTo(Account::class, 'Transaction_Id');
    }

    public function financial()
    {
        return $this->belongsTo(Financial::class, 'Financial_Id');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $table = 'credits';

    protected $fillable = [
        'Credit_Id',
        'Source',
        'Description',
        'Amount',
        'Status',
        'checker_id',
        'maker_id'
    ];
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function maker(){
        return $this->belongsTo(User::class,'maker_id');
    }
}

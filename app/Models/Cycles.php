<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycles extends Model
{
    use HasFactory;

    protected $table = 'cycles';

    protected $fillable = [
        'Cycle_Id',
        'Block_Id',
        'Category_Id',
        'Product',
        'Client_Name',
        'Cycle_Name',
        'Cycle_Start',
        'Cycle_End',
        'checker_id',
        'maker_id',
    ];

    public function block()
    {
        return $this->belongsTo(Blocks::class, 'Block_Id', 'Block_Id');
    }

    public function maker(){
        return $this->belongsTo(User::class,'maker_id');
    }
    
}

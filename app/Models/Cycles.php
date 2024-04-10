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
        'Cycle_Name',
        'Cycle_Start',
        'Cycle_End',
    ];

    public function block()
    {
        return $this->belongsTo(Blocks::class, 'Block_Id', 'Block_Id');
    }
    

}

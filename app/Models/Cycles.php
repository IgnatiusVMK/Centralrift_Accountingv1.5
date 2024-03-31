<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycles extends Model
{
    use HasFactory;

    protected $table = 'cycles';

    protected $fillable = [
        'Block_Id',
        'Cycle_Name',
        'Created_Date',
    ];
}

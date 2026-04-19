<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harvests extends Model
{
    use HasFactory;

    protected $table= 'harvests';

    protected $fillable= [
        'Cycle_Id',
        'Product',
        'Customer_Name',
        'harvest_date',
        'quantity_harvested',
        'quantity_spoilt',
        'quality_grade',
        'remarks',
        'maker_id',
    ];

    public function cycle(){
        return $this->belongsTo(Cycles::class, 'Cycle_Id', 'Cycle_Id');
    }

    public function sales(){
        return $this->hasMany(Sales::class);
    }

    public function maker(){
        return $this->belongsTo(User::class,'maker_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'Customer_Name', 'Customer_Name');
    }

    
}

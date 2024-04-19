<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Departments extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = [
        'department_name',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_departments', 'department_id', 'user_id');
    }
    
}

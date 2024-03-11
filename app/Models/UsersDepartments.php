<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersDepartments extends Model
{
    use HasFactory;

    protected $table = 'users_departments';

    protected $fillable = [
        'user_id',
        'department_id',
    ];
}


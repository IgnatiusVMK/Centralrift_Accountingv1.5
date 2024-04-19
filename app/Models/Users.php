<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'is_active',
        'role',
        'password'
    ];

    public function departments()
    {
        return $this->belongsToMany(\App\Models\Departments::class, 'users_departments', 'user_id', 'department_id');
    }

}

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
        return $this->belongsToMany(Departments::class, 'users_departments', 'user_id', 'department_id');
    }

    public function roles(){
        return $this->belongsToMany(Roles::class,'user_roles',);
    }

    public function permissions(){
        return $this->belongsToMany(Permissions::class,'user_permissions');
    }

    public function hasRole($roles){
        return $this->roles()->where('Name', $roles)->exists();
    }
    public function hasPermission($permissions){
        return $this->permissions()->where('Name', $permissions)->exists();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'Name',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
    
    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'permission_role', 'roles_id', 'permissions_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermissions extends Model
{
    use HasFactory;

    protected $table = 'user_permissions';

    protected $fillable = [
        'User_Id',
        'Permission_Id',
    ];
}

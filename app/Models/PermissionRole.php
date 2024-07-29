<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';
    protected $primaryKey = [ 'permissions_id', 'roles_id'];

    protected $fillable = [
        'permissions_id',
        'roles_id',
    ];
    public $incrementing = false; // Since the primary key is not an auto-incrementing integer
    public $timestamps = false;
}

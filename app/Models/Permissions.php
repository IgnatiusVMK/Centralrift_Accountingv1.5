<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'Name',
    ];

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'permission_role');
    }

}

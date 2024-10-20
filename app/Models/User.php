<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_active',
        'role',
        'password',
        'otp_enabled',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function departments()
    {
        return $this->belongsToMany(Departments::class, 'users_departments', 'user_id', 'department_id');
    }

    public function roles(){
        return $this->belongsToMany(Roles::class, 'role_user', 'user_id', 'role_id');
    }


    // Check if the user is an admin
    public function isAdmin()
    {
        // Check if the user has the admin role (role_id = 1)
        return $this->roles->contains('id', 1);
    }

    public function permissions()
    {
        return $this->hasManyThrough(Permissions::class, Roles::class);
    }

    public function hasRole($role)
    {
        $hasRole = $this->roles()->where('Name', $role)->exists();
           return $hasRole;
    }

    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            $hasPermission = $role->permissions->contains('Name', $permission);
            /* dd($permission, $hasPermission);  */// Check permission name and whether the role has the permission
            if ($hasPermission) {
                return true;
            }
        }
        return false;
    }

}

<?php

namespace App\Policies;

use App\Models\User;

class UsersPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function access(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermission('access_users');
    }
    public function view(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermission('view_users');
    }
    public function create(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermission('create_users');
    }
    public function modify(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermission('modify_users');
    }
    public function delete(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermission('delete_users');
    }

    // Define more authorization methods as needed
}

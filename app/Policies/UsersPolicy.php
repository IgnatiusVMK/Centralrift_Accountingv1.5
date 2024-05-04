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

    // Define more authorization methods as needed
}

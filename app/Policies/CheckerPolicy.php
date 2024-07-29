<?php

namespace App\Policies;

use App\Models\User;

class CheckerPolicy
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
        return $user->hasRole('Admin') || $user->hasPermission('access_approval');
    }
    public function create(User $user)
    {
        return $user->hasRole('Admin') ||  $user->hasPermission('create_approval');
    }
    public function view(User $user)
    {
        return $user->hasRole('Admin') ||  $user->hasPermission('view_approval');
    }
}

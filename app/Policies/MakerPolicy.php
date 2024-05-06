<?php

namespace App\Policies;

use App\Models\User;

class MakerPolicy
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
        return $user->hasRole('Admin') || $user->hasPermission('access_maker');
    }
    public function create(User $user)
    {
        return $user->hasRole('Admin') ||  $user->hasPermission('create_maker');
    }
    public function view(User $user)
    {
        return $user->hasRole('Admin') ||  $user->hasPermission('view_maker');
    }
}

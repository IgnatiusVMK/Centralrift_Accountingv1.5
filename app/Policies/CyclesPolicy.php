<?php

namespace App\Policies;

use App\Models\Cycles;
use App\Models\User;

class CyclesPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function access(User $user, Cycles $cycles)
    {
        return $user->hasRole('Admin') || $user->hasPermission('access_cycles');
    }
    public function create(User $user, Cycles $cycles)
    {
        return $user->hasRole('Admin') ||  $user->hasPermission('create_cycles');
    }
    public function view(User $user, Cycles $cycles)
    {
        return $user->hasRole('Admin') ||  $user->hasPermission('view_cycles');
    }
}

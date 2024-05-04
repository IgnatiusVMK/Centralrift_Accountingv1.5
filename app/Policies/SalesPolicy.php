<?php

namespace App\Policies;

use App\Models\Sales;
use App\Models\User;

class SalesPolicy
{
    public function access(User $user, Sales $sales)
    {
        return $user->hasRole('Admin') || $user->hasPermission('access_sales');
    }
    public function view(User $user, Sales $sales)
    {
        return $user->hasRole('Admin') || $user->hasPermission('view_sales');
    }

    // Define more authorization methods as needed
}

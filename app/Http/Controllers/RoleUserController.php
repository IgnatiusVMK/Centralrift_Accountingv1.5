<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function index($id)
    {
        $role = Roles::findOrFail($id);
        $permissions = Permissions::get();
        
        return view('roles.roles-permissions', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }
}

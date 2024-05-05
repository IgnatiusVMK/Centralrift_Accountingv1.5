<?php

namespace App\Http\Controllers;

use App\Models\PermissionRole;
use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function store(Request $request, $roles_id)
    {

        // Log the entire request input
        Log::info('Submitted form data:', $request->all());

        $request->validate([
            'permissions' => 'required|array',
        ]);

        $selectedPermissions = collect($request->permissions)->map(function ($permission_id) {
            return $permission_id;
        })->filter()->toArray(); // Filter out null values
        
        
        Log::info('Selected Permissions:', $selectedPermissions); // Log selected permissions        
        

        Log::info('Selected Permissions:', $selectedPermissions);// Log existing permissions before deletion

        if (empty($selectedPermissions)) {
            // If no permissions are selected, delete all existing roles for the user
            $existingPermissions = PermissionRole::where('roles_id', $roles_id)->pluck('permissions_id')->toArray();

            // Log existing roles before deletion
            Log::info('Existing Permissions:', $existingPermissions);

            PermissionRole::where('roles_id', $roles_id)->whereIn('permissions_id', $existingPermissions)->delete();
        } else {
            // Determine roles to be deleted
            $existingPermissions = PermissionRole::where('roles_id', $roles_id)->pluck('permissions_id')->toArray();
            Log::info('Existing Roles:', $existingPermissions); // Log existing roles before deletion
            $permissionsToDelete = array_diff($existingPermissions, $selectedPermissions);

            // Determine roles to be created
            $rolesToCreate = array_diff($selectedPermissions, $existingPermissions);

            // Delete roles that are no longer selected
            if (!empty($permissionsToDelete)) {
                PermissionRole::where('roles_id', $roles_id)->whereIn('permissions_id', $permissionsToDelete)->delete();
            }

            // Create roles that are newly selected
            foreach ($rolesToCreate as $permissions_id) {
                PermissionRole::create([
                    'roles_id' => $roles_id,
                    'permissions_id' => $permissions_id,
                ]);
            }
        }

        return redirect()->route('roles-permissions', ['roles_id' => $roles_id])->with('status', 'Permissions Assigned/Deassigned');
    }

    public function deletePermissions(Roles $role)
    {
        // Delete all permissions associated with the role
        PermissionRole::where('roles_id', $role->id)->delete();

        return redirect()->back()->with('status', 'All permissions for this role have been deleted.');
    }

}

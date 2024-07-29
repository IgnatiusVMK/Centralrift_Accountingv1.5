<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserRolePermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $user = User::findOrFail($id);
        $roles = Roles::get();
        
        return view('users-roles-permissions.users-roles-permissions', [
            'user' => $user,
            'roles' => $roles
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $user_id)
    {
        $request->validate([
            'roles' => 'required|array',
        ]);

        $selectedRoles = collect($request->roles)->map(function ($role_combination) {
            return explode('-', $role_combination)[1]; // Extract role_id
        })->toArray();

        Log::info('Selected Roles:', $selectedRoles);// Log existing roles before deletion

        if (empty($selectedRoles)) {
            // If no roles are selected, delete all existing roles for the user
            $existingRoles = RoleUser::where('user_id', $user_id)->pluck('role_id')->toArray();

            // Log existing roles before deletion
            Log::info('Existing Roles:', $existingRoles);

            RoleUser::where('user_id', $user_id)->whereIn('role_id', $existingRoles)->delete();
        } else {
            // Determine roles to be deleted
            $existingRoles = RoleUser::where('user_id', $user_id)->pluck('role_id')->toArray();
            Log::info('Existing Roles:', $existingRoles); // Log existing roles before deletion
            $rolesToDelete = array_diff($existingRoles, $selectedRoles);

            // Determine roles to be created
            $rolesToCreate = array_diff($selectedRoles, $existingRoles);

            // Delete roles that are no longer selected
            if (!empty($rolesToDelete)) {
                RoleUser::where('user_id', $user_id)->whereIn('role_id', $rolesToDelete)->delete();
            }

            // Create roles that are newly selected
            foreach ($rolesToCreate as $role_id) {
                RoleUser::create([
                    'user_id' => $user_id,
                    'role_id' => $role_id,
                ]);
            }
        }

        return redirect()->route('users-roles-permissions', ['user_id' => $user_id])->with('status', 'Roles Assigned/Deassigned');
    }

    public function deleteRoles(Roles $user)
    {
        // Delete all roles associated with the user
        RoleUser::where('user_id', $user->id)->delete();

        return redirect()->back()->with('status', 'All Roles for this User have been deleted.');
    }

}

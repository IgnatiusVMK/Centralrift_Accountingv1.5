<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'user_id' => 'required|integer',
            'role_id' => 'required|integer',
        ]);

        RoleUser::create([
            'user_id' => $request->user_id,
            'role_id' => $request->role_id,
        ]);

        return redirect('users-roles-permissions/{id}/create')->with('status','Roles Assigned');
    }

    public function edit(int $id){
        $roles = RoleUser::findOrFail($id);
        return view('users-roles-permissions.edit', compact('customer'));

    }
    public function update(Request $request,int $id)
    {
        $request->validate([
            'Name' => 'required|max:255|string',
        ]);
        Roles::findOrFail($id)->update([
            'Name' => $request->Name,
        ]);

        return redirect()->back()->with('status','Roles Updated');
    }
    public function destroy(int $id){
        $roles= RoleUser::findOrFail($id);
        $roles->delete();

        return redirect()->back()->with('status','Roles Deleted');
    }
}

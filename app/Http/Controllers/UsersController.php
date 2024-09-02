<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Roles;
use App\Models\User;
use App\Models\UsersDepartments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function index(){
        
        $this->authorize('access-users');

        $users = User::with('departments')->get();
        $role = Roles::get();
        return view('users.users', [
            'users'=> $users,
            'role'=> $role,
        ]);
    }
    public function create(){
        $this->authorize('create-users');

        $departments = Departments::all();
        return view('users.create', compact('departments'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255|string',	
            'email' => 'required|max:255|string',
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|max:255|string',
            'password' => 'required|max:255|string',
            'is_active' => 'sometimes'
        ]);

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active == true ? 1:0,
        ]);

        // Attach the user to the department
        $users->departments()->attach($request->input('department_id'));

        return redirect('users/create')->with('status','User Created');
    }
    public function edit(int $id){

        $this->authorize('modify-users');

        $users = User::findOrFail($id);
        $departments = Departments::all();
        return view('users.edit', compact('users','departments'));

    }
   /*  public function update(Request $request,int $id)
    {
        $request->validate([
            'name' => 'required|max:255|string',	
            'email' => 'required|max:255|string',
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|max:255|string',
            'password' => 'required|max:255|string',
            'is_active' => 'sometimes'
        ]);
        Users::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department_id,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active == true ? 1:0,
        ]);

        $users = Users::findOrFail($id);

        // Attach the user to the department
        $users->departments()->sync($request->input('department_id'));

        return redirect()->back()->with('status','User Updated');
    } */
    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required|max:255|string',    
            'email' => 'required|max:255|string',
            'role' => 'required|max:255|string',
            'is_active' => 'sometimes'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_active' => $request->is_active == true ? 1 : 0,
        ]);

        // Sync the user's departments
        $user->departments()->sync($request->input('departments'));

        return redirect()->back()->with('status', 'User Updated');
    }
    public function destroy(int $id){
        $this->authorize('delete-users');

        $user = User::findOrFail($id);
        $user->departments()->detach();
        $user->delete();

        return redirect()->back()->with('status','User Deleted');
    }
}

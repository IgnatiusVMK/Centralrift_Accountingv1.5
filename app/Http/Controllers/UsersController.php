<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Users;
use App\Models\UsersDepartments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function index(){
        $role = Users::with('departments')->get();
        return view('role.role', compact('role'));
    }
    public function create(){
        $departments = Departments::all();
        return view('role.create', compact('departments'));
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

        $role = Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active == true ? 1:0,
        ]);

        // Attach the user to the department
        $role->departments()->attach($request->input('department_id'));

        return redirect('role/create')->with('status','User Created');
    }
    public function edit(int $id){
        $role = Users::findOrFail($id);
        $departments = Departments::all();
        return view('role.edit', compact('role','departments'));

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

        $role = Users::findOrFail($id);

        // Attach the user to the department
        $role->departments()->sync($request->input('department_id'));

        return redirect()->back()->with('status','User Updated');
    } */
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|max:255|string',    
        'email' => 'required|max:255|string',
        'role' => 'required|max:255|string',
        'password' => 'required|max:255|string',
        'is_active' => 'sometimes'
    ]);

    $user = Users::findOrFail($id);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'password' => Hash::make($request->password),
        'is_active' => $request->is_active == true ? 1 : 0,
    ]);

    // Sync the user's departments
    $user->departments()->sync($request->input('departments'));

    return redirect()->back()->with('status', 'User Updated');
}
    public function destroy(int $id){
        $user = Users::findOrFail($id);
        $user->departments()->detach();
        $user->delete();

        return redirect()->back()->with('status','User Deleted');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Users;
use App\Models\UsersDepartments;
use Illuminate\Http\Request;

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
            'password' => $request->password,
            'is_active' => $request->is_active == true ? 1:0,
        ]);

        // Attach the user to the department
        $role->departments()->attach($request->input('department_id'));

        return redirect('user-role/create')->with('status','User Created');
    }
}

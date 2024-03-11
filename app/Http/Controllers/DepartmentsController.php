<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index(){
        $departments = Departments::get();
        return view('departments.departments', compact('departments'));
    }
    public function create(){
        return view('departments.create');
    }
    public function store(Request $request){
        $request->validate([
            'department_name' => 'required|max:255|string'
        ]);

        Departments::create([
            'department_name' => $request->department_name,
        ]);

        return redirect('departments/create')->with('status','Department Created');
    }
}

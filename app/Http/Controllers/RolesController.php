<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $roles = Roles::get();
        return view('roles.roles', compact('roles'));
    }
    public function create(){
        return view('roles.create');
    }
    public function store(Request $request){
        $request->validate([
            'Name' => 'required|max:255|string'
        ]);

        Roles::create([
            'Name' => $request->name,
        ]);

        // Attach the user to the department
        /* $users->departments()->attach($request->input('department_id')); */

        return redirect('roles/create')->with('status','Role Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

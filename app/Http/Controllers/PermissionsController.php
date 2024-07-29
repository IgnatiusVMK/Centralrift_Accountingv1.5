<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $permissions = Permissions::get();
        return view('permissions.permissions', compact('permissions'));
    }
    public function create(){
        return view('permissions.create');
    }
    public function store(Request $request){
        $request->validate([
            'Name' => 'required|max:255|string'
        ]);

        Permissions::create([
            'Name' => $request->name,
        ]);

        // Attach the user to the department
        /* $users->departments()->attach($request->input('department_id')); */

        return redirect('permissions/create')->with('status','Role Created');
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

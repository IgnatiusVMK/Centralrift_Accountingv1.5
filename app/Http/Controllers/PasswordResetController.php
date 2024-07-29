<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Users;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $users = Users::with('departments')->get();
        return view('password-reset.password-reset', compact('users'));
    }
    public function create(){
        $departments = Departments::all();
        return view('role.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

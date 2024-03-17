<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customers::get();
        /* return $customers; */
        return view('customers.customers', compact('customers'));
    }
    public function create(){
        return view('customers.create');
    }
    public function store(Request $request){
        $request->validate([
            'Customer_Id' => 'required|max:255|string',
            'Customer_Fname' => 'required|max:255|string',	
            'Customer_Lname' => 'required|max:255|string',	
            'Email' => 'required|max:255|string',
            'Contact' => 'required|regex:/^254\d{9}$/|max:15',
            'Address' => 'required|max:255|string'
        ]);

        Customers::create([
            'Customer_Id' => $request->Customer_Id,
            'Customer_Fname' => $request->Customer_Fname,
            'Customer_Lname' => $request->Customer_Lname,
            'Email' => $request->Email,
            'Contact' => $request->Contact,
            'Address' => $request->Address,
            /* 'is_active' => $request->is_active == true ? 1:0, */
        ]);

        return redirect('customers/create')->with('status','Customer Created');
    }

    public function edit(int $Customer_Id){
        $customer = Customers::findOrFail($Customer_Id);
        return view('customers.edit', compact('customer'));

    }
    public function update(Request $request,int $id)
    {
        $request->validate([
            'Customer_Fname' => 'required|max:255|string',	
            'Customer_Lname' => 'required|max:255|string',	
            'Email' => 'required|max:255|string',
            'Contact' => 'required|max:255|string',
            'Address' => 'required|max:255|string',
            'is_active' => 'sometimes'
        ]);
        Customers::findOrFail($id)->update([
            'Customer_Fname' => $request->Customer_Fname,
            'Customer_Lname' => $request->Customer_Lname,
            'Email' => $request->Email,
            'Contact' => $request->Contact,
            'Address' => $request->Address,
            'is_active' => $request->is_active == true ? 1:0,
        ]);

        return redirect()->back()->with('status','Customer Updated');
    }
    public function destroy(int $id){
        $customer= Customers::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('status','Customer Deleted');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // customer home page
    public function home()
    {
        return view('customer.insert');
    }
    // create customer data
    public function insert(Request $request)
     {  //first way
        // Customer::create([
        //     'name' => $request->customerName,
        //     'address' => $request->customerAddress,
        //     'phone' => $request->customerPhone,
        //     'created_at'=>$request->customerDate,
        // ]);

        //second way
        $saveData = new Customer;
        $saveData->name = $request->customerName;
        $saveData->address = $request->customerAddress;
        $saveData->phone = $request->customerPhone;
        $saveData->save();
        return "Successful.............";
    }
    public function read()
    {   //first way
        // dd(Customer::findOrFail(1)->toarray());
        dd(Customer::where('address','kani')->get()->toarray());

        // second way
        // $data = new Customer;
        // dd($data->findOrFail(2)->toarray());
    }
}

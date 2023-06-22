<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        return view('index');
    }

    // handle insert employee ajax request
    public function store(Request $request){
        $file = $request->file('avatar'); // get attribute name which is the avatar
        $fileName = time().'.'.$file->getClientOriginalExtension();   // '.' <- meaning file extension
        $file->storeAs('public/images', $fileName); //store the file into storage directory
    
        $empData = [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'post' => $request->post,
            'avatar' => $fileName
        ];

        Employee::create($empData);
        return response()->json([
            'status' => 200
        ]);
    }
}

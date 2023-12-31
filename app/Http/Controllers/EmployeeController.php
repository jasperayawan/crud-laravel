<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    // handle fetch all employees ajax request
    public function fetchAll(){
        $emps = Employee::all();
        $output = '';

        //count all the rows
        // .= means concatenate
        if($emps->count() > 0){
            $output .= '<table class="table table-striped table-sm text-center align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Post</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
            <tbody>
            ';
            foreach($emps as $emp){
                $output .= '<tr>
                    <td>'.$emp->id.'</td>
                    <td><img src="storage/images/'.$emp->avatar.'" width="50" 
                        class="img-thumbnail rounded-circle"/></td>
                    <td>'.$emp->first_name.' '.$emp->last_name.'</td>
                    <td>'.$emp->email.'</td>
                    <td>'.$emp->post.'</td>
                    <td>'.$emp->email.'</td>
                    <td>
                        <a href="#" id="'.$emp->id.'" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal">
                            <i class="bi-pencil-square h4"></i>
                        </a>

                        <a hre="#" id="'.$emp->id.'" class="text-danger mx-1 deleteIcon">
                            <i class="bi-trash h4"></i>
                        </a>
                    </td>
                </tr>';
            }

            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle edit employee ajax request
    public function edit(Request $request){
        $id = $request->id;
        //employee = find the row by Id
        $emp = Employee::find($id);
        return response()->json($emp);
    }

    // handle update employee ajax request
    public function update(Request $request){
        $fileName = '';

        // find the id of employee
        $emp = Employee::find($request->emp_id);

        // remove the old avatar then replace the new one
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            // store file into storage directory
            $file->storeAs('public/images', $fileName);
            if($emp->avatar){
                //remove the previous image
                Storage::delete('public/images/'.$emp->avatar);
            }
        } else {
            // in case you don't want to update the old image
            $fileName = $request->emp_avatar;
        }

        $empData = [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'post' => $request->post,
            'avatar' => $fileName,
        ];

        $emp->update($empData);
        return response()->json([
            'status' => 200
        ]);
    }

    // handle delete employee ajax request
    public function delete(Request $request){
        $id = $request->id;
        $emp = Employee::find($id);
        if(Storage::delete('public/images/'.$emp->avatar)){
            Employee::destroy($id);
        }
    }
}

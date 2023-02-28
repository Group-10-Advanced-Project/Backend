<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
class EmployeeController extends Controller
{
    public function addEmployee(Request $request){
         
        $employee = new Employee();
        $employee_id= $request->input('employee_id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email= $request->input('email');
        $phone_number=$request->input('phone_number');
        $picture_path= $request->file('picture')->store('pictures','public');
        // $team_id = $request->input('team_id');
        // $team = Team::find($team_id);
        $employee->first_name = $first_name;
        $employee->last_name = $last_name;
        $employee->employee_id=$employee_id;
        $employee->email=$email;
        $employee->phone_number=$phone_number;
        $employee->picture = $picture_path;
        // $employee->team()->associate($team);
        $employee->save();
        return response()->json([
            'message' => ' Employee created successfully!'
     
        ]);

}

public function getEmployee(Request $request,$id ){
         
    $employees =  Employee::find($id)->get();

    return response()->json([
        'message' => $employees,
        
    ]);
}

public function deleteEmployee(Request $request, $id){
         
    $employee =  Employee::find($id);
    $employee->delete();
    return response()->json([
        'message' => 'Employee deleted Successfully!',
 
    ]);
}
public function editEmployee(Request $request, $id){
    $employ =  Employee::find($id);
    // if (!$employ) {
    //     return response()->json([
    //         'message' => 'Employee not found',
    //     ], 404);
    // }

    $inputs= $request->except('picture','first_name','last_name','phone_number','employee_id','email','_method');
    $employ->update($inputs);
    // if($request->has('team')){
    //     $employee->teams()->sync(json_decode($request->input('teams')));
    // }
    if($request->hasFile('pictures')){
        Storage::delete('public/'.$employ->picture);
        $picture_path = $request->file('picture')->store('pictures','public');
        $employ->update(['picture' => $picture_path]);

    }
    $employ->update([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'phone_number' => $request->input('phone_number'),
        'email' => $request->input('email'),
        'employee_id' => $request->input('employee_id')
    ]);

    return response()->json([
        'message'=>'Employee edit successfully',
        'Employee' => $employ,
 
    ]);

}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function addEmployee(Request $request)
    {
        
            $validator = Validator::make($request->all(), [
                'employee_id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone_number' => 'required',
                'picture' => 'required|image|max:2048',
                'team_id' => 'required|exists:teams,id',
            ]);

            if ($validator->fails()) {
                $employee = [
                        
                    'message' => $validator->errors()->first(),
                    
                ]; ;
                return $employee;
            }
            else{
            $employee = new Employee();
            $employee->first_name = $request->input('first_name');
            $employee->last_name = $request->input('last_name');
            $employee->employee_id = $request->input('employee_id');
            $employee->email = $request->input('email');
            $employee->phone_number = $request->input('phone_number');
            $picture_path = $request->file('picture')->store('pictures', 'public');
            $url = Storage::url($picture_path);
            $employee->picture = $url;
            $team_id = $request->input('team_id');
            $team = Team::find($team_id);
            $employee->team()->associate($team);
            $employee->save();
            
            return response()->json([
                'message' => 'Employee created successfully!',
                'employee'=>$employee,
            ]);
            }
    }

    public function getEmployee(Request $request, $id)
    {
        try {
            $employee = Employee::where('employee_id', $id) /*->with(['teams'])*/->get();

            if (!$employee) {
                throw new \Exception(json_encode(['error' => 'Employee not found']), 422);
            }

            return response()->json([
                'message' => 'Employee found',
                'employee' => $employee
            ]);
        } catch (\Exception $err) {
            return response()->json(['error' => json_decode($err->getMessage(), true)], $err->getCode());
        }
    }

    public function deleteEmployee(Request $request, $id)
    {
        $employee = Employee::where('employee_id', $id) /*->with(['teams'])*/->delete();
        if ($employee) {
        // $employee->delete();
        $response = [
            
            'message' => 'Employee deleted successfully!',
            
        ];
        return $response;
    } else {
        $error= [
            
            'message' => 'Employee not found',
            
        ];
        return $error;
    }
    }
    public function editEmployee(Request $request, $id)
    {
        try {
            $employee =Employee::where('employee_id', $id)->firstOrFail();;

            $validator = Validator::make($request->all(), [
                'employee_id' => 'sometimes|required',
                'first_name' => 'sometimes|required',
                'last_name' => 'sometimes|required',
                'email' => 'sometimes|required|email',
                'phone_number' => 'sometimes|required',
                'picture' => 'sometimes|required|image|max:2048',
                'team_id' => 'sometimes|required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            // Update employee details
            if ($request->hasFile('picture')) {
                Storage::delete('public/' . $employee->picture);
                $picture_path = $request->file('picture')->store('pictures', 'public');
                $employee->picture = $picture_path;
            }
            if($request->hasFile('teams')){
                $employee->teams()->sync(json_decode($request->input('teams')));
            }
    

            $employee->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'employee_id' => $request->input('employee_id'),
                // 'team_id' => $request->input('team_id'),
            ]);

            return response()->json([
                'message' => 'Employee updated successfully',
                'Employee' => $employee,
            ]);

        } catch (\Exception $err) {
            return response()->json([
                'error' => 'Error updating employee: ' . $err->getMessage(),
            ], 500);
        }
    }


//     public function getAllEmployee(Request $request){
//         {
           
          
//             $perPage = $request->input('per_page', 10);

//             $employee = Employee::paginate($perPage);
//                 // ->with(['employee', 'recurring']);
//                 // ->orderBy('email')
//                 // ->paginate($perPage);
        
//             return response()->json(
//                 // 'message' => 'Successfully got Employee',
//                 // 'data' => 
//                 $employee,
//             );
           
//         }
// }
public function getAllEmployee()
{
    $employees = Employee::get();

    return response()->json(
         $employees
    );
}
 }
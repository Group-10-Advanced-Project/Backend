<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Role ;
use Illuminate\Support\Facades\Validator;


class RoleController extends Controller
{
    //insert Role into db 
    public function addRole(Request $request){
        // Validate input
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);
        
        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            //create new empty model
            $Role= new Role;
            $description=$request->input('description');
            $Role->description = $description;
            $Role->save();  
            return response()->json([
                'message'=>'Role created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create Role',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function getRole(Request $request,$id){
        try {
            //create new empty model
            if (!is_numeric($id)) {
                return response()->json([
                    'message' => 'Role id is invalid',
                ], 404);
            }   
            
            $Role=Role::find($id);
            if (!$Role) {
                return response()->json([
                    'message'=> 'Role not found'
                ]);
            }

            $Role=Role::find($id);
            return response()->json([
                'message'=>$Role
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get Role',
                'error' => $e->getMessage()
            ], 500);
        }
   }
   public function editRole(Request $request, $id){
    try {
        $Role =  Role::find($id);

        if (!$Role) {
            return response()->json([
                'message' => 'Role not found',
            ], 404);
        }    $inputs= $request->except('_method');
        $Role->update($inputs);

        return response()->json([
            'message' => 'Role edited successfully!',
            'Role' => $Role,
        ]); } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to edit Role',
                'error' => $e->getMessage()
            ], 500);
        }
    

}

 

  public function deleteRole(Request $request, $id)
    {
        try {
            $Role =  Role::find($id);

            if (!$Role) {
                return response()->json([
                    'message' => 'Role not found',
                ], 404);
            }

            $Role->delete();

            return response()->json([
                'message' => 'Role deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete Role',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
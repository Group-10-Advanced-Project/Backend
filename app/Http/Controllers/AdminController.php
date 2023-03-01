<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function addAdmin(Request $request){

        $admin = new Admin;
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $admin->first_name = $first_name;
        $admin->last_name = $last_name;
        $admin->email = $email;
        $admin->password = $password;
        $admin->save();

        return response()->json([
            'message' => 'Admin Created Successfully!'
        ]);
    }

    public function getAllAdmins(){

        $admins = Admin::all();

        return response()->json([
            'message' => $admins,
        ]);
    }

    public function getAdminByID($id){

        $admin =  Admin::find($id);

        return response()->json([
            'message' => $admin,
        ]);
    }
    
    public function deleteAdmin(Request $request, $id){
        $admin =  Admin::find($id);
        $admin->delete();
        return response()->json([
            'message' => 'Admin Deleted Successfully!'
        ]);
    }

    public function editAdmin(Request $request, $id){
        $admin  = Admin::find($id);
        $inputs = $request->except('password','_method');
        $admin->update($inputs);
        if ($request->has('password')) {
            $password = Hash::make($request->input('password'));
            $admin->update(['password' => $password]);
        }
        return response()->json([
           'message' => 'Admin Updated Successfully',
           'updated' => $admin,
        ]);
    }

}


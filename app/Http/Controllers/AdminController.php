<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //Create a new instance
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function getAllAdmins()
    {

        $admins = Admin::all();

        return response()->json([
            'message' => $admins,
        ]);
    }

    public function getAdminByID($id)
    {

        $admin = Admin::find($id);

        return response()->json([
            'message' => $admin,
        ]);
    }

    public function deleteAdmin(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return response()->json([
            'message' => 'Admin Deleted Successfully!'
        ]);
    }

    public function editAdmin(Request $request, $id)
    {
        $admin = Admin::find($id);
        $inputs = $request->except('password', '_method');
        $admin->update($inputs);
        if ($request->has('password')) {
            $password = $request->input('password');
            echo $password;
            $admin->update(['password' => $password]);
        }
        return response()->json([
            'message' => 'Admin Updated Successfully',
            'updated' => $admin,
        ]);
    }

    public function addAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $admin = Admin::create(
            array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            )
        );
        return response()->json([
            'message' => 'User successfully registered',
            'admin' => $admin
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
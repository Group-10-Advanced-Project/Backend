<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//admin routes
Route::Post('/admin', [AdminController::class, "addAdmin"]);
Route::Get('/admin', [AdminController::class, "getAllAdmins"]);
Route::Get('/admin/{id}', [AdminController::class, "getAdminByID"]);
Route::Delete('/admin/{id}', [AdminController::class, "deleteAdmin"]);
Route::Patch('/admin/{id}', [AdminController::class, "editAdmin"]);

// login and logout
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::Post('/addAdmin', [AdminController::class, "addAdmin"]);
    Route::Post('/login', [AdminController::class, "login"]);
    Route::Post('/logout', [AdminController::class, "logout"]);
});

//employee routes
Route::Post('/employee',[EmployeeController::class,'addEmployee']);
Route::Get('/employee/{id}',[EmployeeController::class,'getEmployee']);
Route::Delete('/employee/{id}',[EmployeeController::class,'deleteEmployee']);
Route::Patch('/employee/{id}',[EmployeeController::class,'editEmployee']);

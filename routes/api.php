<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
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

Route::Post('/employee',[EmployeeController::class,'addEmployee']);
Route::Get('/employee/{id}',[EmployeeController::class,'getEmployee']);
Route::Delete('/employee/{id}',[EmployeeController::class,'deleteEmployee']);
Route::Patch('/employee/{id}',[EmployeeController::class,'editEmployee']);
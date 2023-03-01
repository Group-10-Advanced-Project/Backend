<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


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
//kpi routes
Route::Post('/kpi',[KpiController::class,'addKpi']);
Route::Get('/getkpi/{id}',[KpiController::class,'getKpi']);
Route::delete('/deletekpi/{id}',[KpiController::class,'deleteKpi']);    
Route::Put('/editKpi/{id}',[KpiController::class,'editKpi']);    


//admin routes
Route::Post('/admin', [AdminController::class, "addAdmin"]);
Route::Get('/admin', [AdminController::class, "getAllAdmins"]);
Route::Get('/admin/{id}', [AdminController::class, "getAdminByID"]);
Route::Delete('/admin/{id}', [AdminController::class, "deleteAdmin"]);
Route::Patch('/admin/{id}', [AdminController::class, "editAdmin"]);

//employee routes
Route::Post('/employee',[EmployeeController::class,'addEmployee']);
Route::Get('/employee/{id}',[EmployeeController::class,'getEmployee']);
Route::Delete('/employee/{id}',[EmployeeController::class,'deleteEmployee']);
Route::Patch('/employee/{id}',[EmployeeController::class,'editEmployee']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});




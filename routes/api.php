<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;


use App\Http\Controllers\EvaluationController;

use App\Http\Controllers\KpiController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProjectController;




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

// Evaluation Route
Route::Post('/evaluation', [EvaluationController::class, 'addEvaluation']);
Route::Get('/evaluation', [EvaluationController::class, 'getEvaluation']);
Route::Get('/evaluation/{id}', [EvaluationController::class, 'getEvaluationById']);
Route::Patch('/evaluation/{id}', [EvaluationController::class, 'updateEvaluation']);
Route::Delete('/evaluation/{id}', [EvaluationController::class, 'deleteEvaluation']);

//kpi routes
Route::Post('/kpi', [KpiController::class, 'addKpi']);
Route::Get('/getkpi/{id}', [KpiController::class, 'getKpi']);
Route::delete('/deletekpi/{id}', [KpiController::class, 'deleteKpi']);
Route::Put('/editKpi/{id}', [KpiController::class, 'editKpi']);


//Role routes
Route::Post('/Role', [RoleController::class, 'addRole']);
Route::Get('/getRole/{id}', [RoleController::class, 'getRole']);
Route::delete('/deleteRole/{id}', [RoleController::class, 'deleteRole']);
Route::Put('/editRole/{id}', [RoleController::class, 'editRole']);

//employee routes
Route::Post('/employee', [EmployeeController::class, 'addEmployee']);
Route::Get('/employee/{id}', [EmployeeController::class, 'getEmployee']);
Route::Delete('/employee/{id}', [EmployeeController::class, 'deleteEmployee']);
Route::Patch('/employee/{id}', [EmployeeController::class, 'editEmployee']);

//admin routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::Post('/login', [AdminController::class, "login"]);
    Route::Post('/logout', [AdminController::class, "logout"]);
    Route::Post('/addadmin', [AdminController::class, "addAdmin"]);
    Route::Get('/admin', [AdminController::class, "getAllAdmins"]);
    Route::Get('/admin/{id}', [AdminController::class, "getAdminByID"]);
    Route::Delete('/admin/{id}', [AdminController::class, "deleteAdmin"]);
    Route::Patch('/admin/{id}', [AdminController::class, "editAdmin"]);
});



//team routes

Route::Post('/team', [TeamController::class, 'addTeam']);
Route::Get('/team', [TeamController::class, 'getAllTeams']);
Route::Get('/team/teamname/{name}', [TeamController::class, 'getTeamByName']);
Route::Get('/team/id/{id}', [TeamController::class, 'getTeamById']);
Route::delete('/team/{id}', [TeamController::class, 'deleteTeam']);
Route::Patch('/team/{id}', [TeamController::class, 'editTeam']);

Route::Post('/project', [ProjectController::class, 'addProject']);
Route::Get('/project/{id}', [ProjectController::class, 'getProject']);
Route::Delete('/project/{id}', [ProjectController::class, 'deleteProject']);
Route::Patch('/project/{id}', [ProjectController::class, 'editProject']);
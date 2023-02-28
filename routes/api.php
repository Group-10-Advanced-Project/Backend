<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::Post('/admin', [AdminController::class, "addAdmin"]);
Route::Get('/admin', [AdminController::class, "getAllAdmins"]);
Route::Get('/admin/{id}', [AdminController::class, "getAdminByID"]);
Route::Delete('/admin/{id}', [AdminController::class, "deleteAdmin"]);
Route::Patch('/admin/{id}', [AdminController::class, "editAdmin"]);
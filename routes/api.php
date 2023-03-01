<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluationController;

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
Route::Post('/evaluation', [EvaluationController::class,'addEvaluation']);
Route::Get('/evaluation', [EvaluationController::class, 'getEvaluation']);
Route::Get('/evaluation/{id}',[EvaluationController::class, 'getEvaluationById']);
Route::Patch('/evaluation/{id}', [EvaluationController::class, 'updateEvaluation']);
Route::Delete('/evaluation/{id}', [EvaluationController::class, 'deleteEvaluation']);

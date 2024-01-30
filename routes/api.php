<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\CompleteTaskController;

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

Route::prefix('v1')->group(function(){
    Route::apiResource('/tasks',TaskController::class);
    Route::patch("/tasks/{task}/complete",CompleteTaskController::class);
});

//! api resources only
//Route::apiResource('/tasks',TaskController::class)->only(['index,show,update,store']);

// ! add param to the method
//! here we can add id? and if null get all , else find the task by id
Route::get("taskList/{id?}",[TaskController::class,"taskListParam"]);
Route::get("/fetchTasks",[TaskController::class,"fetchTaskssUsingSql"]);

//Route::post("create",[TaskController::class,"store"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

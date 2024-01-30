<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\storeTaskRequest;
use App\Http\Requests\updateTaskRequest;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return TaskResource::Collection(Task::all());
    }

    public function taskListParam($id=null)
    {
        //
        return  $id?  new TaskResource(Task::find($id)) : TaskResource::Collection(Task::all()) ;
    }

    // fetch data using sql
    public function fetchTaskssUsingSql(){
        $users = DB::select('select * from Tasks');
        return $users;

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(storeTaskRequest $request)
    {
        $task = Task::create($request->validated());
        return TaskResource::make($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
        return TaskResource::make($task);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(updateTaskRequest $request, Task $task)
    {

        $task->update($request->validated());
        return TaskResource::make($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return response()->noContent();
    }
}

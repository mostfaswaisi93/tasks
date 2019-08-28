<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Project;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.task.tasks')->with('tasks', Task::paginate(3));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.task.createTask')
            ->with('tasks', Task::get())
            ->with('employees', Employee::get(['id', 'full_name']))
            ->with('projects', Project::get(['id', 'title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $task = new Task();

        $task->title = $request->title;
        $task->description = $request->description;
        $task->employee_id = $request->employee_id;
        $task->project_id = $request->project_id;
        $task->time = $request->time;
        $task->date = $request->date;
        $task->notes = $request->notes;
        $task->active = true;
        $task->save();

        return redirect('admin/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('admin.task.showTask')->with('task', $task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('admin.task.editTask')
            ->with('task', $task)
            ->with('employees', Employee::get(['id', 'full_name']))
            ->with('projects', Project::get(['id', 'title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->title = $request->title;
        $task->description = $request->description;
        $task->employee_id = $request->employee_id;
        $task->project_id = $request->project_id;
        $task->time = $request->time;
        $task->date = $request->date;
        $task->notes = $request->notes;
        $task->active = true;
        $task->save();

        return redirect('admin/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('admin/tasks');
    }
}

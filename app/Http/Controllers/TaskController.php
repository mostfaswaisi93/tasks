<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Project;
use App\Task;
use Carbon\Carbon;
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
        return view('admin.task.tasks')
            ->with('tasks', Task::paginate(3))
            ->with('tasks', Task::get())
            ->with('employees', Employee::get(['id', 'full_name']))
            ->with('projects', Project::get(['id', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'start'        => 'date_format:H:i',
            'end'          => 'date_format:H:i|after:start',
        ];

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            $rules,
            'notes' => 'required'
        ]);

        $task = new Task();
        // dd($request->all());

        $task->title = $request->title;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->start = Carbon::createFromFormat('H:i', $request->start);
        $task->end = Carbon::createFromFormat('H:i', $request->end);
        $task->notes = $request->notes;
        $task->save();
        $task->employees()->attach($request->employee_id);

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
        //
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
        $rules = [
            'start'        => 'date_format:H:i',
            'end'          => 'date_format:H:i|after:start',
        ];

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            $rules,
            'notes' => 'required'
        ]);

        // dd($request->all());

        $task->title = $request->title;
        $task->description = $request->description;
        $task->employee_id = $request->employee_id;
        $task->project_id = $request->project_id;
        $task->start = Carbon::createFromFormat('H:i', $request->start);
        $task->end = Carbon::createFromFormat('H:i', $request->end);
        $task->empEndTask = NULL;
        $task->notes = $request->notes;
        // $task->status =  $request->status;
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

    public function pending($id)
    {
        $task = Task::find($id);
        $task->status = 'pending';
        $task->save();

        return redirect()->back();
    }

    public function in_progress($id)
    {
        $task = Task::find($id);
        $task->status = 'in_progress';
        $task->save();

        return redirect()->back();
    }

    public function done($id)
    {
        $task = Task::find($id);
        $task->status = 'done';
        $task->save();

        return redirect()->back();
    }

    public function completed($id)
    {
        $task = Task::find($id);
        $task->status = 'completed';
        $task->save();

        return redirect()->back();
    }

    public function cancel($id)
    {
        $task = Task::find($id);
        $task->status = 'cancel';
        $task->save();

        return redirect()->back();
    }

    public function late($id)
    {
        $task = Task::find($id);
        $task->status = 'late';
        $task->save();

        return redirect()->back();
    }
}

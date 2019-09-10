<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Project;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tasks = Task::get();
        if ($request->ajax()) {
            $data = Task::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editTask"><i class="far fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteTask"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.task.tasks')->with('tasks', $tasks);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255'
        ]);

        Task::updateOrCreate(
            ['id' => $request->task_id],
            ['name' => $request->name]
        );

        return response()->json(['success' => 'Task saved successfully.']);
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return response()->json($task);
    }

    public function destroy($id)
    {
        Task::find($id)->delete();

        return response()->json(['success' => 'Task deleted successfully.']);
    }

    // public function index()
    // {
    //     return view('admin.task.tasks')
    //         ->with('tasks', Task::paginate(3))
    //         ->with('tasks', Task::get())
    //         ->with('employees', Employee::get(['id', 'full_name']))
    //         ->with('projects', Project::get(['id', 'title']));
    // }

    // public function store(Request $request)
    // {
    //     $rules = [
    //         'start'        => 'date_format:H:i',
    //         'end'          => 'date_format:H:i|after:start',
    //     ];

    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //         $rules,
    //         'notes' => 'required'
    //     ]);

    //     $task = new Task();
    //     // dd($request->all());

    //     $task->title = $request->title;
    //     $task->description = $request->description;
    //     $task->project_id = $request->project_id;
    //     $task->start = Carbon::createFromFormat('H:i', $request->start);
    //     $task->end = Carbon::createFromFormat('H:i', $request->end);
    //     $task->notes = $request->notes;
    //     $task->save();
    //     $task->employees()->attach($request->employee_id);

    //     return redirect('admin/tasks');
    // }

    // public function edit(Task $task)
    // {
    //     return view('admin.task.editTask')
    //         ->with('task', $task)
    //         ->with('employees', Employee::get(['id', 'full_name']))
    //         ->with('projects', Project::get(['id', 'title']));
    // }

    // public function update(Request $request, Task $task)
    // {
    //     $rules = [
    //         'start'        => 'date_format:H:i',
    //         'end'          => 'date_format:H:i|after:start',
    //     ];

    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //         $rules,
    //         'notes' => 'required'
    //     ]);

    //     // dd($request->all());

    //     $task->title = $request->title;
    //     $task->description = $request->description;
    //     $task->employee_id = $request->employee_id;
    //     $task->project_id = $request->project_id;
    //     $task->start = Carbon::createFromFormat('H:i', $request->start);
    //     $task->end = Carbon::createFromFormat('H:i', $request->end);
    //     $task->empEndTask = NULL;
    //     $task->notes = $request->notes;
    //     // $task->status =  $request->status;
    //     $task->save();

    //     return redirect('admin/tasks');
    // }

    // public function destroy(Task $task)
    // {
    //     $task->delete();

    //     return redirect('admin/tasks');
    // }

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

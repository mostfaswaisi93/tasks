<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Project;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Task::get())
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i class="far fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.task.tasks')
            ->with('employees', Employee::get(['id', 'full_name']))
            ->with('projects', Project::get(['id', 'title']));
    }

    public function store(Request $request)
    {
        $rules = array(
            'title'         => 'required',
            'description'   => 'required',
            'project_id'    => 'required',
            'notes'         => 'required',
            'start'         => 'date_format:H:i',
            'end'           => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'title'                 =>  $request->title,
            'description'           =>  $request->description,
            'project_id'            =>  $request->project_id,
            'notes'                 =>  $request->notes,
            'start'                 =>  Carbon::createFromFormat('H:i', $request->start),
            'end'                   =>  Carbon::createFromFormat('H:i', $request->end)
        );

        Task::create($form_data)->employees()->attach($request->employee_id);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Task::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'description' => 'required',
            'notes' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'title'        =>  $request->title,
            'description'        =>  $request->description,
            'notes'        =>  $request->notes
        );

        Task::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Task::findOrFail($id);
        $data->delete();
    }

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

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
        $tasks = Task::with(['project', 'employees']);
        $project_id = request()->get('project_id');
        $employee_id = request()->get('employee_id');
        $status = request()->get('status');
        $date = request()->get('DATE(start)');

        if (request()->ajax()) {
            if (isset($project_id))
                $tasks->whereHas('project', function ($q) use ($project_id) {
                    $q->where('id', $project_id);
                });

            if (isset($employee_id))
                $tasks->whereHas('employees', function ($q) use ($employee_id) {
                    $q->where('employees.id', $employee_id);
                });

            if (isset($status))
                $tasks->where('status', $status);

            if (isset($date))
            // $tasks->where('start', $date);
            $tasks->where('start', '<=', $date);

            $tasks = $tasks->get();
            return datatables()->of($tasks)
                ->addColumn('project', function ($data) {
                    return $data->project->title;
                })
                ->addColumn('employees', function ($data) {
                    return $data->employees;
                })
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
            ->with('tasks', Task::get())
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
            'end'           => 'date_format:H:i|after:start'
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
            $data = Task::with(['employees'])->findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'title'         => 'required',
            'description'   => 'required',
            'project_id'    => 'required',
            'notes'         => 'required',
            'start'         => 'date_format:H:i',
            'end'           => 'date_format:H:i|after:start'
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

        $task = Task::findOrFail($request->hidden_id);
        $task->update($form_data);
        $task->employees()->sync($request->employee_id);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Task::findOrFail($id);
        $data->delete();
        $data->employees()->detach();
    }

    public function updateStatus(Request $request, $id)
    {
        $task   = Task::find($id);
        $status     = $request->get('status');
        $task->status = $status;
        $task   = $task->save();

        if ($task) {
            return response(['success' => TRUE, "message" => 'Done']);
        }
    }
}

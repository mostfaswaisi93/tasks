<?php

namespace App\Http\Controllers;

use App\Department;
use App\Project;
use Illuminate\Http\Request;
use Validator;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::with(['department'])->get();

        if (request()->ajax()) {
            return datatables()->of($projects)
                ->addColumn('department', function ($data) {
                    return $data->department->name;
                })
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i class="far fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="show" id="' . $data->id . '" class="showBtn btn btn-info btn-sm"><i class="fa fa-eye"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.project.projects')
            ->with('projects', Project::get())
            ->with('departments', Department::get(['id', 'name']));
    }

    public function store(Request $request)
    {
        $rules = array(
            'title'             => 'required',
            'description'       => 'required',
            'department_id'     => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        Project::create($request->all());
        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function show($id)
    {
        if (request()->ajax()) {
            $data   = Project::with('department')->findOrFail($id);
            $data->department->name;
            return response()->json(['data' => $data]);
        }
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Project::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'title'             => 'required',
            'description'       => 'required',
            'department_id'     => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $project = Project::findOrFail($request->hidden_id);
        $project->update($request->all());
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Project::findOrFail($id);
        $data->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $project = Project::find($id);
        $status = $request->get('status');
        $project->status = $status;
        $project = $project->save();

        if ($project) {
            return response(['success' => TRUE, "message" => 'Done']);
        }
    }
}

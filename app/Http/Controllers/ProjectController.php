<?php

namespace App\Http\Controllers;

use App\Department;
use App\Project;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $projects = Project::get();
        if ($request->ajax()) {
            $data = Project::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProject"><i class="far fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProject"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.project.projects')->with('projects', $projects)
            ->with('departments', Department::get(['id', 'name']));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        Project::updateOrCreate(
            ['id' => $request->project_id],
            ['name' => $request->name]
        );

        //     $project = new Project();

        //     $project->title = $request->title;
        //     $project->description = $request->description;
        //     $project->department_id = $request->department_id;
        //     $project->save();

        return response()->json(['success' => 'Project saved successfully.']);
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return response()->json($project);
    }

    public function destroy($id)
    {
        Project::find($id)->delete();

        return response()->json(['success' => 'Project deleted successfully.']);
    }

    public function pending($id)
    {
        $project = Project::find($id);
        $project->status = 'pending';
        $project->save();

        return redirect()->back();
    }

    public function in_progress($id)
    {
        $project = Project::find($id);
        $project->status = 'in_progress';
        $project->save();

        return redirect()->back();
    }

    public function done($id)
    {
        $project = Project::find($id);
        $project->status = 'done';
        $project->save();

        return redirect()->back();
    }

    public function completed($id)
    {
        $project = Project::find($id);
        $project->status = 'completed';
        $project->save();

        return redirect()->back();
    }

    public function cancel($id)
    {
        $project = Project::find($id);
        $project->status = 'cancel';
        $project->save();

        return redirect()->back();
    }

    public function late($id)
    {
        $project = Project::find($id);
        $project->status = 'late';
        $project->save();

        return redirect()->back();
    }
}

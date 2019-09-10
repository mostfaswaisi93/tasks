<?php

namespace App\Http\Controllers;

use App\Department;
use App\Project;
use Illuminate\Http\Request;
use DataTables;

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
        return view('admin.project.projects')->with('projects', $projects);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255'
        ]);

        Project::updateOrCreate(
            ['id' => $request->project_id],
            ['name' => $request->name]
        );

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



    // public function index()
    // {
    //     return view('admin.project.projects')
    //         ->with('projects', Project::paginate(3))
    //         ->with('departments', Department::get(['id', 'name']));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required'
    //     ]);

    //     $project = new Project();

    //     $project->title = $request->title;
    //     $project->description = $request->description;
    //     $project->department_id = $request->department_id;
    //     $project->save();

    //     return redirect('admin/projects');
    // }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required'
    //     ]);

    //     // dd($request->all());
    //     $project = Project::findOrFail($request->project_id);
    //     $project->update($request->all());

    //     return redirect('admin/projects');
    // }

    // public function destroy(Request $request)
    // {
    //     $project = Project::findOrFail($request->project_id);
    //     $project->delete();
    //     return back();
    // }

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

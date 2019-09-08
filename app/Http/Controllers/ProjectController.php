<?php

namespace App\Http\Controllers;

use App\Department;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
        return view('admin.project.projects')
            ->with('projects', Project::paginate(3))
            ->with('departments', Department::get(['id', 'name']));
            // ->with('project', Project::get());
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
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $project = new Project();

        $project->title = $request->title;
        $project->description = $request->description;
        $project->department_id = $request->department_id;
        // $project->status =  $request->status;
        $project->save();

        return redirect('admin/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        // dd($request->all());
        $project = Project::findOrFail($request->project_id);
        $project->update($request->all());

        return redirect('admin/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        $project = Project::findOrFail($request->project_id);
        $project->delete();
        return back();
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

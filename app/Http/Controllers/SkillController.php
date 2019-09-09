<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
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
        return view('admin.skill.skills')->with('skills', Skill::paginate(3));
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
            'name' => 'required',
        ]);

        $skill = new Skill();
        $skill->name = $request->name;
        $skill->save();

        return redirect('admin/skills');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        //
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // dd($request->all());
        $skill = Skill::findOrFail($request->skill_id);
        $skill->update($request->all());

        return redirect('admin/skills');
    }

    public function destroy(Request $request)
    {
        $skill = Skill::findOrFail($request->skill_id);
        $skill->delete();
        return back();
    }
}

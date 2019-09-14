<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class SkillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $skills = Skill::get();
        if ($request->ajax()) {
            $data = Skill::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editSkill"><i class="far fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteSkill"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.skill.skills')->with('skills', $skills);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        Skill::updateOrCreate(
            ['id' => $request->skill_id],
            ['name' => $request->name]
        );

        return response()->json(['success' => 'Skill saved successfully.']);
    }

    public function edit($id)
    {
        $skill = Skill::find($id);
        return response()->json($skill);
    }

    public function destroy($id)
    {
        Skill::find($id)->delete();

        return response()->json(['success' => 'Skill deleted successfully.']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use DataTables;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $departments = Department::get();
        if ($request->ajax()) {
            $data = Department::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editDepartment"><i class="far fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteDepartment"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.department.departments')->with('departments', $departments);
    }

    public function store(Request $request)
    {
        Department::updateOrCreate(
            ['id' => $request->department_id],
            ['name' => $request->name],
            ['description' => $request->description]
        );

        return response()->json(['success' => 'Department saved successfully.']);
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return response()->json($department);
    }

    public function destroy($id)
    {
        Department::find($id)->delete();

        return response()->json(['success' => 'Department deleted successfully.']);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'description' => 'required'
    //     ]);

    //     $department = new Department();
    //     $department->name = $request->name;
    //     $department->description = $request->description;
    //     $department->save();

    //     return redirect('admin/departments');
    // }

}

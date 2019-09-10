<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $employees = Employee::get();
        if ($request->ajax()) {
            $data = Employee::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editEmployee"><i class="far fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteEmployee"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.employee.employees')->with('employees', $employees);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255'
        ]);

        Employee::updateOrCreate(
            ['id' => $request->employee_id],
            ['name' => $request->name]
        );

        return response()->json(['success' => 'Employee saved successfully.']);
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    public function destroy($id)
    {
        Employee::find($id)->delete();

        return response()->json(['success' => 'Employee deleted successfully.']);
    }

    // public function index()
    // {
    //     return view('admin.employee.employees')
    //         ->with('employees', Employee::paginate(3))
    //         ->with('departments', Department::get(['id', 'name']))
    //         ->with('skills', Skill::get(['id', 'name']));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'full_name' => 'required',
    //         'email' => 'required',
    //         'phone' => 'required',
    //         'address' => 'required',
    //         'job_title' => 'required',
    //     ]);

    //     $employee = new Employee();
    //     $employee->full_name = $request->full_name;
    //     $employee->email = $request->email;
    //     $employee->phone = $request->phone;
    //     $employee->address = $request->address;
    //     $employee->job_title = $request->job_title;
    //     $employee->department_id = $request->department_id;
    //     $employee->user_id = Auth::id();
    //     $employee->save();
    //     $employee->skills()->attach($request->skill_id);

    //     return redirect('admin/employees');
    // }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'full_name' => 'required',
    //         'email' => 'required',
    //         'phone' => 'required',
    //         'address' => 'required',
    //         'job_title' => 'required',
    //     ]);
    //     dd($request->all());
    //     $employee = Employee::findOrFail($request->employee_id);
    //     $employee->update($request->all());
    //     $employee->skills()->sync($request->skill_id);

    //     return redirect('admin/employees');
    // }

    // public function destroy(Request $request)
    // {
    //     $employee = Employee::findOrFail($request->employee_id);
    //     $employee->delete();
    //     $employee->skills()->detach();

    //     return back();
    // }

    public function pending($id)
    {
        $employee = Employee::find($id);
        $employee->status = 'pending';
        $employee->save();

        return redirect()->back();
    }

    public function in_progress($id)
    {
        $employee = Employee::find($id);
        $employee->status = 'in_progress';
        $employee->save();

        return redirect()->back();
    }

    public function completed($id)
    {
        $employee = Employee::find($id);
        $employee->status = 'completed';
        $employee->save();

        return redirect()->back();
    }

    public function inactive($id)
    {
        $employee = Employee::find($id);
        $employee->status = 'inactive';
        $employee->save();

        return redirect()->back();
    }

    public function leave($id)
    {
        $employee = Employee::find($id);
        $employee->status = 'leave';
        $employee->save();

        return redirect()->back();
    }
}

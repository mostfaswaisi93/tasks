<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::with(['department', 'skills'])->get();

        if (request()->ajax()) {
            return datatables()->of($employees)
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
        return view('admin.employee.employees')
            ->with('departments', Department::get(['id', 'name']))
            ->with('skills', Skill::get(['id', 'name']));
    }

    public function store(Request $request)
    {
        $rules = array(
            'fullName'              => 'required',
            'email'                 => 'required|email',
            'phone'                 => 'required|min:8|numeric',
            'address'               => 'required',
            'jobTitle'              => 'required',
            'department_id'         => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'fullName'              =>  $request->fullName,
            'email'                 =>  $request->email,
            'phone'                 =>  $request->phone,
            'address'               =>  $request->address,
            'jobTitle'              =>  $request->jobTitle,
            'department_id'         =>  $request->department_id,
            'user_id'               =>  Auth::id()
        );

        Employee::create($form_data)->skills()->attach($request->skill_id);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function show($id)
    {
        if (request()->ajax()) {
            $data = Employee::with(['skills', 'department'])->findOrFail($id);
            $data->department->name;
            return response()->json(['data' => $data]);
        }
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Employee::with(['skills'])->findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'fullName'              => 'required',
            'email'                 => 'required|email',
            'phone'                 => 'required|min:8|numeric',
            'address'               => 'required',
            'jobTitle'              => 'required',
            'department_id'         => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'fullName'              =>  $request->fullName,
            'email'                 =>  $request->email,
            'phone'                 =>  $request->phone,
            'address'               =>  $request->address,
            'jobTitle'              =>  $request->jobTitle,
            'department_id'         =>  $request->department_id,
            'user_id'               =>  Auth::id()
        );

        $employee = Employee::findOrFail($request->hidden_id);
        $employee->update($form_data);
        $employee->skills()->sync($request->skill_id);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = Employee::findOrFail($id);
        $data->delete();
        $data->skills()->detach();
    }

    public function updateStatus(Request $request, $id)
    {
        $employee   = Employee::find($id);
        $status     = $request->get('status');
        $employee->status = $status;
        $employee   = $employee->save();

        if ($employee) {
            return response(['success' => TRUE, "message" => 'Done']);
        }
    }
}

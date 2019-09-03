<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Job;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
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
        return view('admin.employee.employees')
            ->with('employees', Employee::paginate(3));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.createEmployee')
            ->with('departments', Department::get(['id', 'name']))
            ->with('jobs', Job::get(['id', 'title']))
            ->with('tags', Tag::get(['id', 'name']));
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
            'full_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $employee = new Employee();
        $employee->full_name = $request->full_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->department_id = $request->department_id;
        $employee->job_id = $request->job_id;
        $employee->user_id = Auth::id();
        // $employee->status =  $request->status;
        $employee->save();
        $employee->tags()->attach($request->tag_id);

        return redirect('admin/employees');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('admin.employee.editEmployee')
            ->with('employee', $employee)
            ->with('departments', Department::get(['id', 'name']))
            ->with('jobs', Job::get(['id', 'title']))
            ->with('tags', Tag::get(['id', 'name']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $employee->full_name = $request->full_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->department_id = $request->department_id;
        $employee->job_id = $request->job_id;
        // $employee->status =  $request->status;
        $employee->save();
        $employee->tags()->sync($request->tag_id);

        return redirect('admin/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        $employee->tags()->detach();
        return redirect('admin/employees');
    }

    public function active($id)
    {
        $employee = Employee::find($id);
        $employee->status = 'active';
        $employee->save();

        return redirect()->back();
    }

    public function pending($id)
    {
        $employee = Employee::find($id);
        $employee->status = 'pending';
        $employee->save();

        return redirect()->back();
    }

    public function deactive($id)
    {
        $employee = Employee::find($id);
        $employee->status = 'deactive';
        $employee->save();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function tags()
    {
        return view('admin.tag.tags');
    }

    public function departments()
    {
        return view('admin.department.departments');
    }

    public function projects()
    {
        return view('admin.project.projects');
    }

    public function jobs()
    {
        return view('admin.job.jobs');
    }

    public function employees()
    {
        $employees = DB::table('employees')->paginate(1);
        return view('admin.employee.employees')->with('employees', $employees);
    }

    public function tasks()
    {
        return view('admin.task.tasks');
    }
}

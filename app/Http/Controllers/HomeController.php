<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home')->with('tasks', Task::simplePaginate(3));
        // return view('home');
    }

    public function show(){
        return view('task');
    }
}

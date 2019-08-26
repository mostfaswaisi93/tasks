@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        {{$employee->full_name}}
                        <small>{{$employee->job_name}}</small>
                        <a href="/admin/employees" class="btn btn-default pull-right">Go Back</a>
                    </h2>
                </div>
                <div class="panel-body">
                    <p><strong>Job Title: </strong>{{$employee->job_title}}</p>
                    <p><strong>Email: </strong>{{$employee->email}}</p>
                    <p><strong>Phone: </strong>{{$employee->phone}}</p>
                    <p><strong>Address: </strong>{{$employee->address}}</p>
                    <p><strong>Department: </strong>{{$employee->department->name}}</p>
                    <p><strong>Tags: </strong></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

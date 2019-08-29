@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        {{$task->title}}
                        <a href="/admin/tasks" class="btn btn-default pull-right">Go Back</a>
                    </h2>
                </div>
                <div class="panel-body">
                    <p><strong>Description: </strong>{{$task->description}}</p>
                    <p><strong>Employee: </strong>{{$task->employee->full_name}}</p>
                    <p><strong>Project: </strong>{{$task->project->title}}</p>
                    <p><strong>Start Time: </strong>{{$task->start}}</p>
                    <p><strong>End Time: </strong>{{$task->end}}</p>
                    <p><strong>Notes: </strong>{{$task->notes}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

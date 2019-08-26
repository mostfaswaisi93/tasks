@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        {{$project->title}}
                        <a href="/admin/projects" class="btn btn-default pull-right">Go Back</a>
                    </h2>
                </div>
                <div class="panel-body">
                    <p>{{$project->description}}</p>
                    <p>{{$project->description}}</p>
                    <p><strong>Department: </strong>{{$project->department->name}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

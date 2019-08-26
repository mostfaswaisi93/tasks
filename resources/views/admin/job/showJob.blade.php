@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        {{$job->title}}
                        <a href="/admin/jobs" class="btn btn-default pull-right">Go Back</a>
                    </h2>
                </div>
                <div class="panel-body">
                    <p>
                        {{$job->description}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

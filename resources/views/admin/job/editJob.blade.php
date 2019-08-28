@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Edit Job
                        <a href="/admin/jobs" class="btn btn-default pull-right">Go Back</a>
                    </h2>
                </div>
                <div class="panel-body">
                    @include('admin._errors')
                    <form method="POST" action="/admin/jobs/{{$job->id}}" accept-charset="UTF-8" class="form-horizontal"
                        role="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title" class="col-md-2 control-label">Title</label>
                            <div class="col-md-8">
                                <input class="form-control" autofocus="autofocus" name="title" type="text" id="title"
                                    value="{{$job->title}}" />
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-2 control-label">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="description" cols="50" rows="10"
                                    id="description">{{$job->description}}</textarea>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

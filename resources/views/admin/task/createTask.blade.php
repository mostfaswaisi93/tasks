@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Add Task
                        <a href="/admin/tasks" class="btn btn-default pull-right">Go Back</a>
                    </h2>
                </div>
                <div class="panel-body">
                        @include('admin._errors')
                    <form method="POST" action="/admin/tasks" accept-charset="UTF-8" class="form-horizontal"
                        role="form">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="col-md-2 control-label">Title</label>
                            <div class="col-md-8">
                                <input class="form-control" autofocus="autofocus" name="title"
                                    type="text" id="title" />
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-2 control-label">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="description" cols="50"
                                    rows="10" id="description"></textarea>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="employee_id" class="col-md-2 control-label">Employee</label>
                            <div class="col-md-8">
                                <select class="form-control" required="required" id="employee_id" name="employee_id">
                                    @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->full_name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="project_id" class="col-md-2 control-label">Project</label>
                            <div class="col-md-8">
                                <select class="form-control" required="required" id="project_id" name="project_id">
                                    @foreach ($projects as $project)
                                    <option value="{{$project->id}}">{{$project->title}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start" class="col-md-2 control-label">Start Time</label>
                            <div class="col-md-8">
                                <input class="form-control" autofocus="autofocus" name="start"
                                    type="text" id="start" />
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end" class="col-md-2 control-label">End Time</label>
                            <div class="col-md-8">
                                <input class="form-control" autofocus="autofocus" name="end"
                                    type="text" id="end" />
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="col-md-2 control-label">Notes</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="notes" cols="50"
                                    rows="10" id="notes"></textarea>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Create
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

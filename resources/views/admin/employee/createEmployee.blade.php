@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Add Employee
                        <a href="/admin/employees" class="btn btn-default pull-right">Go Back</a>
                    </h2>
                </div>
                <div class="panel-body">
                    <form method="POST" action="/admin/employees" accept-charset="UTF-8" class="form-horizontal"
                        role="form">
                        @csrf
                        <div class="form-group">
                            <label for="full_name" class="col-md-2 control-label">Full Name</label>
                            <div class="col-md-8">
                                <input class="form-control" required="required" autofocus="autofocus" name="full_name"
                                    type="text" id="full_name" />
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-2 control-label">Email</label>
                            <div class="col-md-8">
                                <input class="form-control" required="required" autofocus="autofocus" name="email"
                                    type="text" id="email" />
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-2 control-label">Phone</label>
                            <div class="col-md-8">
                                <input class="form-control" required="required" autofocus="autofocus" name="phone"
                                    type="text" id="phone" />
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-md-2 control-label">Address</label>
                            <div class="col-md-8">
                                <input class="form-control" required="required" autofocus="autofocus" name="address"
                                    type="text" id="address" />
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="department_id" class="col-md-2 control-label">Department</label>
                            <div class="col-md-8">
                                <select class="form-control" required="required" id="department_id"
                                    name="department_id">
                                    @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job_id" class="col-md-2 control-label">Jobe Title</label>
                            <div class="col-md-8">
                                <select class="form-control" required="required" id="job_id" name="job_id">
                                    @foreach ($jobs as $job)
                                    <option value="{{$job->id}}">{{$job->title}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tag_id" class="col-md-2 control-label">Skills - Tags</label>
                            <div class="col-md-8">
                                <select class="form-control" required="required" id="tag_id" name="tag_id[]" multiple>
                                    @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
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

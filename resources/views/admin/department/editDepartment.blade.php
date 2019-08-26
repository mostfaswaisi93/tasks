@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Edit Department
                        <a href="/admin/departments" class="btn btn-default pull-right">Go Back</a>
                    </h2>
                </div>
                <div class="panel-body">
                    <form method="POST" action="/admin/departments/{{$department->id}}" accept-charset="UTF-8"
                        class="form-horizontal" role="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">Department Name</label>
                            <div class="col-md-8">
                                <input class="form-control" required="required" autofocus="autofocus" name="name"
                                    type="text" id="name" value="{{$department->name}}" />
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-2 control-label">Department Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" required="required" name="description" cols="50"
                                    rows="10" id="description">{{$department->description}}</textarea>
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

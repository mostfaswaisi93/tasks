@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Departments</h3>
            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addModal"><i
                    class="fa fa-plus" aria-hidden="true"></i> Add New</button>
        </div>
        <div class="box-body">
            <table id="datatable" class="table table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                        <td>
                            <button class="btn btn-primary" data-myname="{{$item->name}}"
                                data-mydes="{{$item->description}}" data-depid="{{$item->id}}" data-toggle="modal"
                                data-target="#edit"><i class="far fa-edit"></i>
                                </button>
                            <button class="btn btn-danger" data-depid={{$item->id}} data-toggle="modal"
                                data-target="#delete"> <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addModalLabel">Add Department</h4>
            </div>
            @include('admin._errors')
            <form method="POST" action="{{ action('DepartmentController@store')}}" accept-charset="UTF-8"
                class="form-horizontal" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="name" type="text" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="description" type="text" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editModalLabel">Edit Department</h4>
            </div>
            @include('admin._errors')
            <form method="POST" action="{{route('departments.update','test')}}" accept-charset="UTF-8"
                class="form-horizontal" role="form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="dep_id" id="dep_id" value="">
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="name" type="text" id="name" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="description" type="text"
                                id="description" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <form action="{{route('departments.destroy','test')}}" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p class="text-center">
                        Are you sure you want to delete this?
                    </p>
                    <input type="hidden" name="dep_id" id="dep_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                    <button type="submit" class="btn btn-warning">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Projects</h3>
            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addModal"><i
                    class="fa fa-plus" aria-hidden="true"></i> Add New</button>
        </div>
        <div class="box-body">
            <table id="datatable" class="table table-responsive">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Select Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{$item->department->name}}</td>
                        @if ($item->status == 'pending')
                        <td><button class="btn btn-info" style="width: 107px;"><i class="fas fa-clock"></i>
                                Pending</button>@include('admin._select')</td>
                        @elseif ($item->status == 'in_progress')
                        <td><button class="btn btn-primary" style="width: 107px;"><i class="fas fa-spinner"></i>
                                In Progress</button>@include('admin._select')</td>
                        @elseif ($item->status == 'done')
                        <td><button class="btn btn-success" style="width: 107px;"><i class="fas fa-check"></i>
                                Done</button>@include('admin._select')</td>
                        @elseif ($item->status == 'completed')
                        <td><button class="btn btn-success" style="width: 107px;"><i class="fas fa-check-circle"></i>
                                Completed</button>@include('admin._select')</td>
                        @elseif ($item->status == 'cancel')
                        <td><button class="btn btn-danger" style="width: 107px;"><i class="fas fa-window-close"></i>
                                Cancel</button>@include('admin._select')</td>
                        @else
                        <td><button class="btn btn-warning" style="width: 107px;"><i class="fas fa-cog"></i>
                                Late</button>@include('admin._select')</td>
                        @endif
                        <td>
                            <button class="btn btn-info" data-mytitle="{{$item->title}}"
                                data-mydes="{{$item->description}}" data-projectid="{{$item->id}}" data-toggle="modal"
                                data-target="#show"><i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-primary" data-mytitle="{{$item->title}}"
                                data-mydes="{{$item->description}}" data-projectid="{{$item->id}}"
                                data-mydepartment="{{$item->department_id}}" data-toggle="modal" data-target="#edit"><i
                                    class="far fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" data-projectid={{$item->id}} data-toggle="modal"
                                data-target="#delete"> <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addModalLabel">Add Project</h4>
            </div>
            @include('admin._errors')
            <form method="POST" action="{{ action('ProjectController@store')}}" accept-charset="UTF-8"
                class="form-horizontal" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="col-md-2 control-label">Title</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="title" type="text" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department_id" class="col-md-2 control-label">Department</label>
                        <div class="col-md-9">
                            <select class="form-control" name="department_id">
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
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description" cols="50" rows="10"></textarea>
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
                <h4 class="modal-title" id="editModalLabel">Edit Project</h4>
            </div>
            @include('admin._errors')
            <form method="POST" action="{{route('projects.update','test')}}" accept-charset="UTF-8"
                class="form-horizontal" role="form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="project_id" id="project_id" value="">
                    <div class="form-group">
                        <label for="title" class="col-md-2 control-label">Title</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="title" type="text" id="title" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department_id" class="col-md-2 control-label">Department</label>
                        <div class="col-md-9">
                            <select class="form-control" id="department_id" name="department_id" id="department_id">
                                {{-- @foreach ($departments as $department)
                                    <option value="{{$department->id}}" @if($department->id == $project->department_id)
                                selected @endif>{{$department->name}}</option>
                                @endforeach --}}
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
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description" cols="50" rows="10"
                                id="description"></textarea>
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

<!-- Show Modal -->
<div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="showModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="showModalLabel">Show Project</h4>
            </div>
            @include('admin._errors')
            <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" role="form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="project_id" id="project_id" value="">
                    <div class="form-group">
                        <label for="title" class="col-md-2 control-label">Title</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="title" type="text" id="title"
                                disabled />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department_id" class="col-md-2 control-label">Department</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="department_id" type="text"
                                id="department_id" disabled />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description" cols="50" rows="10" id="description"
                                disabled></textarea>
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
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
            <form action="{{route('projects.destroy','test')}}" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p class="text-center">
                        Are you sure you want to delete this?
                    </p>
                    <input type="hidden" name="project_id" id="project_id" value="">
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

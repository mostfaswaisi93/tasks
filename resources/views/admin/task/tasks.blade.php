@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Tasks</h3>
            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addModal"><i
                    class="fa fa-plus" aria-hidden="true"></i> Add New</button>
        </div>
        <div class="box-body">
            <table id="datatable" class="table table-responsive">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Employee</th>
                        <th>Project</th>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td></td>
                        {{-- <td>{{$item->employee->full_name}}</td> --}}
                        <td>{{$item->project->title}}</td>
                        <td>{{$item->start->format('H:i')}}</td>
                        <td>{{$item->end->format('H:i')}}</td>
                        @if ($item->status == 'pending')
                        <td><button class="btn btn-info" style="width: 107px;"><i class="fas fa-clock"></i>
                                Pending</button>@include('admin.task._select')</td>
                        @elseif ($item->status == 'in_progress')
                        <td><button class="btn btn-primary" style="width: 107px;"><i class="fas fa-spinner"></i>
                                In Progress</button>@include('admin.task._select')</td>
                        @elseif ($item->status == 'done')
                        <td><button class="btn btn-success" style="width: 107px;"><i class="fas fa-check"></i>
                                Done</button>@include('admin.task._select')</td>
                        @elseif ($item->status == 'completed')
                        <td><button class="btn btn-success" style="width: 107px;"><i class="fas fa-check-circle"></i>
                                Completed</button>@include('admin.task._select')</td>
                        @elseif ($item->status == 'cancel')
                        <td><button class="btn btn-danger" style="width: 107px;"><i class="fas fa-window-close"></i>
                                Cancel</button>@include('admin.task._select')</td>
                        @else
                        <td><button class="btn btn-warning" style="width: 107px;"><i class="fas fa-cog"></i>
                                Late</button>@include('admin.task._select')</td>
                        @endif
                        <td>
                            <button class="btn btn-info" data-myfull_name="{{$item->full_name}}"
                                data-myemail="{{$item->email}}" data-taskid="{{$item->id}}" data-toggle="modal"
                                data-target="#show"><i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-primary" data-myfull_name="{{$item->full_name}}"
                                data-myemail="{{$item->email}}" data-taskid="{{$item->id}}"
                                data-myphone="{{$item->phone}}" data-myaddress="{{$item->address}}"
                                data-myjob_title="{{$item->job_title}}" data-mytag="{{$item->tag_id}}"
                                data-mydepartment="{{$item->department_id}}" data-toggle="modal" data-target="#edit"><i
                                    class="far fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" data-taskid={{$item->id}} data-toggle="modal"
                                data-target="#delete"> <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="text-center">
                {{$tasks->render()}}
        </div> --}}
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
                <h4 class="modal-title" id="addModalLabel">Add Task</h4>
            </div>
            @include('admin._errors')
            <form method="POST" action="{{ action('TaskController@store')}}" accept-charset="UTF-8"
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
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description" cols="50" rows="10"></textarea>
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="employee_id" class="col-md-2 control-label">Employee</label>
                            <div class="col-md-9">
                                <select class="form-control" name="employee_id[]" multiple>
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
                        <div class="col-md-9">
                            <select class="form-control" name="project_id">
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
                        <div class="col-md-9">
                            <input class="timepickerStart form-control" autofocus="autofocus" name="start" type="text">
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end" class="col-md-2 control-label">End Time</label>
                        <div class="col-md-9">
                            <input class="timepickerEnd form-control" autofocus="autofocus" name="end" type="text">
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-md-2 control-label">Notes</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="notes" cols="50" rows="10"></textarea>
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
{{-- <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editModalLabel">Edit Task</h4>
            </div>
            @include('admin._errors')
            <form method="POST" action="{{route('tasks.update','test')}}" accept-charset="UTF-8" class="form-horizontal"
                role="form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="task_id" id="task_id" value="">
                    <div class="form-group">
                        <label for="full_name" class="col-md-2 control-label">Full Name</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="full_name" type="text"
                                id="full_name" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">Email</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="email" type="text" id="email" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-md-2 control-label">Phone</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="phone" type="text" id="phone" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="address" type="text" id="address" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="job_title" class="col-md-2 control-label">Job Title</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="job_title" type="text"
                                id="job_title" />
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
</div> --}}

<!-- Show Modal -->
{{-- <div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="showModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="showModalLabel">Show Task</h4>
            </div>
            @include('admin._errors')
            <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" role="form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="task_id" id="task_id" value="">
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
</div> --}}

<!-- Delete Modal -->
{{-- <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <form action="{{route('tasks.destroy','test')}}" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p class="text-center">
                        Are you sure you want to delete this?
                    </p>
                    <input type="hidden" name="task_id" id="task_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                    <button type="submit" class="btn btn-warning">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

@endsection

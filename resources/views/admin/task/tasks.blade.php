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
                        <th>Description</th>
                        <th>Employee</th>
                        <th>Project</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Notes</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->employee->full_name}}</td>
                        <td>{{$item->project->title}}</td>
                        <td>{{$item->start->format('d/m/Y')}}</td>
                        <td>{{$item->start->format('H:i')}}</td>
                        <td>{{$item->end->format('H:i')}}</td>
                        <td>{{$item->notes}}</td>
                        @if ($item->status == 'active')
                        <td><button class="btn btn-xs btn-primary">Active</button></td>
                        @elseif ($item->status == 'pending')
                        <td><button class="btn btn-xs btn-success">Pending</button></td>
                        @else
                        <td><button class="btn btn-xs btn-warning">Deactive</button></td>
                        @endif
                        <td>
                            <a href="/admin/tasks/active/{{$item->id}}" class="btn btn-xs btn-primary">A</a>
                            <a href="/admin/tasks/pending/{{$item->id}}" class="btn btn-xs btn-success">P</a>
                            <a href="/admin/tasks/deactive/{{$item->id}}" class="btn btn-xs btn-warning">D</a>
                            <a href="/admin/tasks/{{$item->id}}/edit" class="btn btn-xs btn-info">Edit</a>
                            <form action="/admin/tasks/{{$item->id}}" method="post" style="display: inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="text-center">
                {{$employees->render()}}
            </div> --}}
        </div>
    </div>
</div>

<!-- Modal -->
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
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="description" type="text" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department_id" class="col-md-2 control-label">Department</label>
                        <div class="col-md-9">
                            <select class="form-control" name="department_id">
                                {{-- @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach --}}
                            </select>
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

<!-- Modal -->
{{-- <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
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
        <label for="description" class="col-md-2 control-label">Description</label>
        <div class="col-md-9">
            <input class="form-control" autofocus="autofocus" name="description" type="text" id="description" />
            <span class="help-block">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="department_id" class="col-md-2 control-label">Department</label>
        <div class="col-md-8">
            <select class="form-control" id="department_id" name="department_id">
                @foreach ($departments as $department)
                <option value="{{$department->id}}" @if($department->id == $project->department_id)
                    selected @endif>{{$department->name}}</option>
                @endforeach
            </select>
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

<!-- Modal -->
{{-- <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
</div> --}}

{{-- <script type="text/javascript">
    $(document).ready(function(){
            $('#datatable').DataTable({
                "paging": false
            });

            // Start Edit

            $('#edit').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var name = button.data('myname')
                var description = button.data('mydes')
                var project_id = button.data('projectid')
                var modal = $(this)

                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #description').val(description);
                modal.find('.modal-body #project_id').val(project_id);

            })

            // Start Delete

            $('#delete').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var dep_id = button.data('depid')
                var modal = $(this)
                modal.find('.modal-body #dep_id').val(dep_id);
            })
        })

</script> --}}


@endsection

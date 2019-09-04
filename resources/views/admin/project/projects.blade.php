@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Projects
                        <a href="/admin/projects/create" class="btn btn-default pull-right">Add New</a>
                    </h2>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td>{{$item->description}}</td>
                                {{-- <td>{{$item->department->name}}</td> --}}
                                @if ($item->status == 'active')
                                <td><button class="btn btn-xs btn-primary">Active</button></td>
                                @elseif ($item->status == 'pending')
                                <td><button class="btn btn-xs btn-success">Pending</button></td>
                                @else
                                <td><button class="btn btn-xs btn-warning">Deactive</button></td>
                                @endif
                                <td>
                                    <a href="/admin/projects/active/{{$item->id}}" class="btn btn-xs btn-primary">A</a>
                                    <a href="/admin/projects/pending/{{$item->id}}" class="btn btn-xs btn-success">P</a>
                                    <a href="/admin/projects/deactive/{{$item->id}}"
                                        class="btn btn-xs btn-warning">D</a>
                                    <a href="/admin/projects/{{$item->id}}/edit" class="btn btn-xs btn-info">Edit</a>
                                    <form action="/admin/projects/{{$item->id}}" method="post" style="display: inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$projects->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Projects
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal"
                            data-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>
                    </h2>
                </div>
                <div class="panel-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->description}}</td>
                                <td>
                                    <button class="btn btn-xs btn-info" data-myname="{{$item->name}}"
                                        data-mydes="{{$item->description}}" data-depid="{{$item->id}}"
                                        data-toggle="modal" data-target="#edit"><i class="far fa-edit"></i>
                                        Edit</button>
                                    <button class="btn btn-xs btn-danger" data-depid={{$item->id}} data-toggle="modal"
                                        data-target="#delete"> <i class="fa fa-trash" aria-hidden="true"></i>
                                        Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$projects->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.project._createProject')
@include('admin.project._editProject')
@include('admin.project._deleteProject')

<script type="text/javascript">
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

</script>
@endsection

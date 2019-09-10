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
                                Pending</button>@include('admin.project._select')</td>
                        @elseif ($item->status == 'in_progress')
                        <td><button class="btn btn-primary" style="width: 107px;"><i class="fas fa-spinner"></i>
                                In Progress</button>@include('admin.project._select')</td>
                        @elseif ($item->status == 'done')
                        <td><button class="btn btn-success" style="width: 107px;"><i class="fas fa-check"></i>
                                Done</button>@include('admin.project._select')</td>
                        @elseif ($item->status == 'completed')
                        <td><button class="btn btn-success" style="width: 107px;"><i class="fas fa-check-circle"></i>
                                Completed</button>@include('admin.project._select')</td>
                        @elseif ($item->status == 'cancel')
                        <td><button class="btn btn-danger" style="width: 107px;"><i class="fas fa-window-close"></i>
                                Cancel</button>@include('admin.project._select')</td>
                        @else
                        <td><button class="btn btn-warning" style="width: 107px;"><i class="fas fa-cog"></i>
                                Late</button>@include('admin.project._select')</td>
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
            <div class="text-center">
                {{$projects->render()}}
            </div>
        </div>
    </div>
</div>

@include('admin.project.form')

@endsection

@push('scripts')
<script type="text/javascript">
    $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        // paging : false,
        serverSide: true,
        ajax: "{{ route('projects.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewProject').click(function () {
        $('#saveBtn').val("create-project");
        $('#project_id').val('');
        $('#projectForm').trigger("reset");
        $('#modalHeading').html("Create New Project");
        $('#projectModal').modal('show');
    });

    $('body').on('click', '.editProject', function () {
      var project_id = $(this).data('id');
      $.get("{{ route('projects.index') }}" +'/' + project_id +'/edit', function (data) {
          $('#modalHeading').html("Edit Project");
          $('#saveBtn').val("edit-user");
          $('#projectModal').modal('show');
          $('#project_id').val(data.id);
          $('#name').val(data.name);
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#projectForm').serialize(),
          url: "{{ route('projects.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#projectForm').trigger("reset");
              $('#projectModal').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });

    $('body').on('click', '.deleteProject', function () {

        var project_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('projects.store') }}"+'/'+project_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
  });
</script>
@endpush

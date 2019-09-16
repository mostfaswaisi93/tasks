@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Tasks</h3>
            <button type="button" name="create_task" id="create_task" class="btn btn-success pull-right"><i
                    class="fa fa-plus"></i> Create New Task</button>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Employee</th>
                        <th>Project</th>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                        <th width="120px">Action</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($tasks as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                <td></td>
                <td>{{$item->employee->full_name}}</td>
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
                </tr>
                @endforeach
                </tbody> --}}
            </table>
        </div>
    </div>
</div>

@include('admin.task.form')

@endsection

@push('scripts')

<script>
    $(document).ready(function(){

        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
            url: "{{ route('tasks.index') }}",
            },
            columns:[
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, searchable: false, orderable: false
                },
                {data: 'title', name: 'title'},
                {data: 'employee_id', name: 'employee_id'},
                {data: 'project_id', name: 'project_id'},
                {data: 'date', name: 'date'},
                {data: 'start', name: 'start'},
                {data: 'end', name: 'end'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false}
            ]
        });

        $('#create_task').click(function(){
            $('.modal-title').text("Add New Task");
                $('#action_button').val("Add");
                $('#taskForm').trigger("reset");
                $('#action').val("Add");
                $('#taskModal').modal('show');
        });

        $('#taskForm').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
            $.ajax({
                url:"{{ route('tasks.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                {
                html = '<div class="alert alert-danger">';
                for(var count = 0; count < data.errors.length; count++)
                {
                    html += '<p>' + data.errors[count] + '</p>';
                }
                html += '</div>';
                }
                if(data.success)
                {
                    $('#taskForm')[0].reset();
                    $('#data-table').DataTable().ajax.reload();
                    $('#taskModal').modal('hide');
                }
                    $('#form_result').html(html);
                }
            });
        }
        if($('#action').val() == "Edit")
        {
            $.ajax({
                url:"{{ route('tasks.update') }}",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                var html = '';
                if(data.errors)
                {
                html = '<div class="alert alert-danger">';
                for(var count = 0; count < data.errors.length; count++)
                {
                html += '<p>' + data.errors[count] + '</p>';
                }
                html += '</div>';
                }
                if(data.success)
                {
                $('#taskForm')[0].reset();
                $('#data-table').DataTable().ajax.reload();
                $('#taskModal').modal('hide');
                }
                $('#form_result').html(html);
                }
                });
            }
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"/admin/tasks/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#name').val(html.data.name);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Edit New Task");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                    $('#taskModal').modal('show');
                }
            });
        });

        var task_id;
        $(document).on('click', '.delete', function(){
            task_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"tasks/destroy/"+task_id,
                beforeSend:function(){
                    $('#ok_button').text('Deleting...');
                },
                success: function (data) {
                        $('#confirmModal').modal('hide');
                        $('#data-table').DataTable().ajax.reload();
                        $('#ok_button').html('<i class="fa fa-check" aria-hidden="true"></i> Delete');
                    },
                    error: function (data) {
                        console.log('error:', data);
                        $('#ok_button').html('<i class="fa fa-check" aria-hidden="true"></i> Delete');
                }
            });
        });
    });
</script>

<script type="text/javascript">
    var dateNow = new Date();
    $('#timepickerStart').timepicker({
        format: 'HH:mm',
        defaultDate:dateNow
    });
    $('#timepickerEnd').timepicker({
        format: 'HH:mm',
        defaultDate:dateNow
    });

    $('#start').on('dp.change', function(e){
        // console.log(e.timeStamp);
        var new_time =  moment(e.timeStamp).add(20, 'm').format("HH:mm");
        $('body').find('#end').val(new_time);
     })

</script>

@endpush

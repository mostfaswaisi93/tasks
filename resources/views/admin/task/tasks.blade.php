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
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.task.form')

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>

<script>
    var status  = '';
    var task_id = '';
    $(document).ready(function(){

        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
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
                {data: 'employees', name: 'employees'},
                {data: 'project', name: 'project'},
                {data: 'start', name: 'start'},
                {data: 'end', name: 'end'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false}
            ],
            "columnDefs": [ {
                    "targets": 6,
                    render: function (data, type, row, meta){
                    var $select = $(`<select class='status form-control'
                    id='status' onchange=selectStatus(${row.id})>
                    <option value='pending'>Pending</option>
                    <option value='in_progress'>In Progress</option>
                    <option value='done'>Done</option>
                    <option value='completed'>Completed</option>
                    <option value='cancel'>Cancel</option>
                    <option value='late'>Late</option>
                    </select>`);
                    $select.find('option[value="'+row.status+'"]').attr('selected', 'selected');
                    return $select[0].outerHTML
                }
            } ],
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
                    console.log(html);
                    var employees = html.data.employees;
                    var employee_ids = _.map(employees, 'id');
                    $('#title').val(html.data.title);
                    $('#description').val(html.data.description);
                    $('#project_id').val(html.data.project_id);
                    $('#notes').val(html.data.notes);
                    $('#start').val(html.data.start);
                    $('#end').val(html.data.end);
                    $('#employee_id > option').prop('selected', false);
                    $('#employee_id > option').each(function(){
                        var item = this;
                        if(employee_ids.indexOf(parseInt(item.value)) > -1){
                            console.log('selected',true);
                            $(this).prop('selected', true);
                        }else{
                            console.log('selected',false);
                        }
                    });
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Edit New Task");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                    $('#taskModal').modal('show');
                }
            });
        });

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

        $(document).on('change', '#status', function(e) {
            var status_task = $(this).find("option:selected").val();
            if(status_task == true){
                toastr.error('Status Not changed!', 'Error!')
            }else{
                toastr.success('Status changed!', 'Success!')
            }
            console.log(task_id)
            $.ajax({
                url:"tasks/updateStatus/"+task_id+"?status="+status_task,
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                method:"POST",
                data:{},
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
                        $('#data-table').DataTable().ajax.reload();
                    }
                }
            });
        });

    });

    function selectStatus(id){
        task_id = id;
    }

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
     });

     $('.select2').select2();

</script>

@endpush

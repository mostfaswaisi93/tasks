@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Employees</h3>
            <button type="button" name="create_employee" id="create_employee" class="btn btn-success pull-right"><i
                    class="fa fa-plus"></i> Create New Employee</button>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Full Name</th>
                        <th>Department</th>
                        <th>Job Title</th>
                        <th>Status</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.employee.form')

@endsection

@push('scripts')

<script>
    $(document).ready(function(){

    $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
        url: "{{ route('employees.index') }}",
        },
        columns:[
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }, searchable: false, orderable: false
            },
            {data: 'full_name', name: 'full_name'},
            {data: 'department_id', name: 'department_id'},
            {data: 'job_title', name: 'job_title'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false}
        ]
    });

    $('#create_employee').click(function(){
        $('.modal-title').text("Add New Employee");
            $('#action_button').val("Add");
            $('#employeeForm').trigger("reset");
            $('#action').val("Add");
            $('#employeeModal').modal('show');
    });

    $('#employeeForm').on('submit', function(event){
        event.preventDefault();
        if($('#action').val() == 'Add')
        {
        $.ajax({
            url:"{{ route('employees.store') }}",
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
                $('#employeeForm')[0].reset();
                $('#data-table').DataTable().ajax.reload();
                $('#employeeModal').modal('hide');
            }
                $('#form_result').html(html);
            }
        });
    }
    if($('#action').val() == "Edit")
    {
        $.ajax({
            url:"{{ route('employees.update') }}",
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
            $('#employeeForm')[0].reset();
            $('#data-table').DataTable().ajax.reload();
            $('#employeeModal').modal('hide');
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
            url:"/admin/employees/"+id+"/edit",
            dataType:"json",
            success:function(html){
                $('#full_name').val(html.data.full_name);
                $('#email').val(html.data.email);
                $('#phone').val(html.data.phone);
                $('#address').val(html.data.address);
                $('#job_title').val(html.data.job_title);
                $('#department_id').val(html.data.department_id);
                // $('#skill_id').val(html.data.skill_id);
                $('#hidden_id').val(html.data.id);
                $('.modal-title').text("Edit New Employee");
                $('#action_button').val("Edit");
                $('#action').val("Edit");
                $('#employeeModal').modal('show');
            }
        });
    });

    var employee_id;
    $(document).on('click', '.delete', function(){
        employee_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function(){
        $.ajax({
            url:"employees/destroy/"+employee_id,
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

@endpush

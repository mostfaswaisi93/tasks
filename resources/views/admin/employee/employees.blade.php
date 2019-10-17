@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Employees</h3>
            <button type="button" name="create_employee" id="create_employee" class="btn btn-success pull-right"><i
                    class="fa fa-plus"></i> Create New</button>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Department</th>
                        <th>Job Title</th>
                        <th>Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.employee.form')

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>

<script>
    var status = '';
    var employee_id = '';
    $(document).ready(function(){

    $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax:{
        url: "{{ route('employees.index') }}",
        },
        columns:[
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }, searchable: false, orderable: false
            },
            {data: 'fullName', name: 'fullName'},
            {data: 'department', name: 'department'},
            {data: 'jobTitle', name: 'jobTitle'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false}
        ],
        "columnDefs": [ {
                "targets": 4,
                render: function (data, type, row, meta){
                var $select = $(`<select class='status form-control'
                id='status' onchange=selectStatus(${row.id})>
                <option value='Pending'>Pending</option>
                <option value='InProgress'>In Progress</option>
                <option value='Completed'>Completed</option>
                <option value='InActive'>In Active</option>
                <option value='Leave'>Leave</option>
                </select>`);
                $select.find('option[value="'+row.status+'"]').attr('selected', 'selected');
                return $select[0].outerHTML
            }
        } ],
    });

    $('#create_employee').click(function(){
        $('.modal-title').text("Add New Employee");
            $('#action_button').val("Add");
            $('#employeeForm').trigger("reset");
            $('.select2').val('').trigger('change');

            $('#action').val("Add");
            $('#employeeModal').modal('show');
    });

    $('#employeeForm').on('submit', function(event){
        event.preventDefault();
        if($('#action').val() == 'Add')
        {
            var formData = new FormData(this);
        $.ajax({
            url:"{{ route('employees.store') }}",
            method:"POST",
            data: formData,
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
                toastr.success('Added Done!', 'Success!');
            }
                $('#form_result').html(html);
            }
        });
    }
    if($('#action').val() == "Edit")
    {
        var formData = new FormData(this);
        $.ajax({
            url:"{{ route('employees.update') }}",
            method:"POST",
            data: formData,
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
            toastr.success('Edited Done!', 'Success!');
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
                console.log(html);
                var skills = html.data.skills;
                var skill_ids = _.map(skills, 'id');
                $('#fullName').val(html.data.fullName);
                $('#email').val(html.data.email);
                $('#phone').val(html.data.phone);
                $('#address').val(html.data.address);
                $('#jobTitle').val(html.data.jobTitle);
                $('#department_id').val(html.data.department_id).trigger('change');
                $('#skill_id > option').prop('selected', false);
                $('#skill_id > option').each(function(){
                    var item = this;
                    if(skill_ids.indexOf(parseInt(item.value)) > -1){
                        console.log('selected',true);
                        $(this).prop('selected', true);
                    }else{
                        console.log('selected',false);
                    }
                });
                $('#hidden_id').val(html.data.id);
                $('.modal-title').text("Edit Employee");
                $('#action_button').val("Edit");
                $('#action').val("Edit");
                $('#employeeModal').modal('show');
            }
        });
    });

    $(document).on('click', '.showBtn', function(){
        project_id = $(this).attr('id');
        $.ajax({
            url:"/admin/employees/"+project_id,
            dataType:"json",
            success:function(html){
                console.log(html);
                $('#showFullName').html(html.data.fullName);
                $('#showEmail').html(html.data.email);
                $('#showPhone').html(html.data.phone);
                $('#showAdress').html(html.data.address);
                $('#showJobTitle').html(html.data.jobTitle);
                $('#showDepartment').html(html.data.department.name);
                $('#showSkills').html(html.data.skills.name);
                $('#showStatus').html(html.data.status);
                $('#hidden_id').val(html.data.id);
                $('#showModal').modal('show');
            }
        });
    });

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
                    toastr.success('Deleted Done!', 'Success!');
                },
                error: function (data) {
                    console.log('error:', data);
                    $('#ok_button').html('<i class="fa fa-check" aria-hidden="true"></i> Delete');
            }
        });
    });

    $(document).on('change', '#status', function(e) {
            var status_employee = $(this).find("option:selected").val();
            if(status_employee == true){
                toastr.error('Status Not changed!', 'Error!')
            }else{
                toastr.success('Status changed!', 'Success!')
            }
            $.ajax({
                url:"employees/updateStatus/"+employee_id+"?status="+status_employee,
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
        employee_id = id;
    }

    $('.select2').select2();

</script>

@endpush
@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Projects</h3>
            <button type="button" name="create_project" id="create_project" class="btn btn-success pull-right"><i
                    class="fa fa-plus"></i> Create New</button>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.project.form')

@endsection

@push('scripts')

<script>
    var status = '';
    var project_id = '';
    $(document).ready(function(){

        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax:{
            url: "{{ route('projects.index') }}",
            },
            columns:[
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, searchable: false, orderable: false
                },
                {data: 'title', name: 'title'},
                {data: 'department', name: 'department'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false}
            ],
            "columnDefs": [ {
                    "targets": 3,
                    render: function (data, type, row, meta){
                    var $select = $(`<select class='status form-control'
                    id='status' onchange=selectStatus(${row.id})>
                    <option value='Pending'>Pending</option>
                    <option value='InProgress'>In Progress</option>
                    <option value='Done'>Done</option>
                    <option value='Completed'>Completed</option>
                    <option value='Cancel'>Cancel</option>
                    <option value='Late'>Late</option>
                    </select>`);
                    $select.find('option[value="'+row.status+'"]').attr('selected', 'selected');
                    return $select[0].outerHTML
                }
            } ],
        });

        $('#create_project').click(function(){
            $('.modal-title').text("Add New Project");
                $('#action_button').val("Add");
                $('#projectForm').trigger("reset");
                $('.select2').val('').trigger('change');
                CKEDITOR.instances['description'].setData('');
                $('#action').val("Add");
                $('#projectModal').modal('show');
        });

        $('#projectForm').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
                var formData = new FormData(this);
                var descriptionValue = '';
                descriptionValue = CKEDITOR.instances['description'].getData();
                formData.append('description', descriptionValue);
            $.ajax({
                url:"{{ route('projects.store') }}",
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
                    $('#projectForm')[0].reset();
                    $('#data-table').DataTable().ajax.reload();
                    $('#projectModal').modal('hide');
                    toastr.success('Added Done!', 'Success!');
                }
                    $('#form_result').html(html);
                }
            });
        }
        if($('#action').val() == "Edit")
        {
                var formData = new FormData(this);
                var descriptionValue = '';
                descriptionValue = CKEDITOR.instances['description'].getData();
                formData.append('description', descriptionValue);
            $.ajax({
                url:"{{ route('projects.update') }}",
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
                $('#projectForm')[0].reset();
                $('#data-table').DataTable().ajax.reload();
                $('#projectModal').modal('hide');
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
                url:"/admin/projects/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#title').val(html.data.title);
                    $('#department_id').val(html.data.department_id).trigger('change');
                    CKEDITOR.instances['description'].setData(html.data.description);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Edit Project");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                    $('#projectModal').modal('show');
                }
            });
        });

        $(document).on('click', '.showBtn', function(){
            project_id = $(this).attr('id');
            $.ajax({
                url:"/admin/projects/"+project_id,
                dataType:"json",
                success:function(html){
                    $('#showTitle').html(html.data.title);
                    $('#showDepartment').html(html.data.department.name);
                    $('#showDescription').html(html.data.description);
                    $('#showStatus').html(html.data.status);
                    $('#hidden_id').val(html.data.id);
                    $('#showModal').modal('show');
                }
            });
        });

        $(document).on('click', '.delete', function(){
            project_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"projects/destroy/"+project_id,
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
            var status_project = $(this).find("option:selected").val();
            if(status_project == true){
                toastr.error('Status Not changed!', 'Error!')
            }else{
                toastr.success('Status changed!', 'Success!')
            }
            $.ajax({
                url:"projects/updateStatus/"+project_id+"?status="+status_project,
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
        project_id = id;
    }

    $('.select2').select2();

    CKEDITOR.replace('description', {
      height: 150,
    });

</script>

@endpush
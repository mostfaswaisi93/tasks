@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Departments</h3>
            <button type="button" name="create_department" id="create_department" class="btn btn-success pull-right"><i
                    class="fa fa-plus"></i> Create New Department</button>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.department.form')

@endsection

@push('scripts')

<script>
    $(document).ready(function(){

        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
            url: "{{ route('departments.index') }}",
            },
            columns:[
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, searchable: false, orderable: false
                },
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false}
            ]
        });

        $('#create_department').click(function(){
            $('.modal-title').text("Add New Department");
                $('#action_button').val("Add");
                $('#departmentForm').trigger("reset");
                $('#action').val("Add");
                $('#departmentModal').modal('show');
        });

        $('#departmentForm').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
            $.ajax({
                url:"{{ route('departments.store') }}",
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
                    $('#departmentForm')[0].reset();
                    $('#data-table').DataTable().ajax.reload();
                    $('#departmentModal').modal('hide');
                }
                    $('#form_result').html(html);
                }
            });
        }
        if($('#action').val() == "Edit")
        {
            $.ajax({
                url:"{{ route('departments.update') }}",
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
                $('#departmentForm')[0].reset();
                $('#data-table').DataTable().ajax.reload();
                $('#departmentModal').modal('hide');
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
                url:"/admin/departments/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#name').val(html.data.name);
                    $('#description').val(html.data.description);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Edit New Department");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                    $('#departmentModal').modal('show');
                }
            });
        });

        var department_id;
        $(document).on('click', '.delete', function(){
            department_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"departments/destroy/"+department_id,
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

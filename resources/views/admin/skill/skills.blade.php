@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Skills</h3>
            <button type="button" name="create_skill" id="create_skill" class="btn btn-success pull-right">
                <i class="fa fa-plus"></i> Create New</button>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.skill.form')

@endsection

@push('scripts')

<script>
    var skill_id = '';
    $(document).ready(function(){

    $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax:{
        url: "{{ route('skills.index') }}",
        },
        columns:[
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }, searchable: false, orderable: false
            },
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false}
        ]
    });

    $('#create_skill').click(function(){
        $('.modal-title').text("Add New Skill");
            $('#action_button').val("Add");
            $('#skillForm').trigger("reset");
            $('#action').val("Add");
            $('#skillModal').modal('show');
    });

    $('#skillForm').on('submit', function(event){
        event.preventDefault();
        if($('#action').val() == 'Add')
        {
        $.ajax({
            url:"{{ route('skills.store') }}",
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
                $('#skillForm')[0].reset();
                $('#data-table').DataTable().ajax.reload();
                $('#skillModal').modal('hide');
                toastr.success('Added Done!', 'Success!');
            }
                $('#form_result').html(html);
            }
        });
    }
    if($('#action').val() == "Edit")
    {
        $.ajax({
            url:"{{ route('skills.update') }}",
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
                $('#skillForm')[0].reset();
                $('#data-table').DataTable().ajax.reload();
                $('#skillModal').modal('hide');
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
            url:"/admin/skills/"+id+"/edit",
            dataType:"json",
            success:function(html){
                $('#name').val(html.data.name);
                $('#hidden_id').val(html.data.id);
                $('.modal-title').text("Edit Skill");
                $('#action_button').val("Edit");
                $('#action').val("Edit");
                $('#skillModal').modal('show');
            }
        });
    });

    $(document).on('click', '.delete', function(){
        skill_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function(){
        $.ajax({
            url:"skills/destroy/"+skill_id,
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
});

</script>

@endpush
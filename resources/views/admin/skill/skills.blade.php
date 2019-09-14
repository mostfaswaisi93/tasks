@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Skills</h3>
            <button type="button" class="btn btn-success pull-right" href="javascript:void(0)" id="createNewSkill"><i
                    class="fa fa-plus" aria-hidden="true"></i> Create New Skill</button>
        </div>
        <div class="box-body">
            <table class="table table-responsive data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.skill.form')

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
        serverSide: true,
        ajax: "{{ route('skills.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewSkill').click(function () {
        $('#saveBtn').val("create-skill");
        $('#skill_id').val('');
        $('#skillForm').trigger("reset");
        $('#modalHeading').html("Create New Skill");
        $('#skillModal').modal('show');
    });

    $('body').on('click', '.editSkill', function () {
      var skill_id = $(this).data('id');
      $.get("{{ route('skills.index') }}" +'/' + skill_id +'/edit', function (data) {
          $('#modalHeading').html("Edit Skill");
          $('#saveBtn').val("edit-user");
          $('#skillModal').modal('show');
          $('#skill_id').val(data.id);
          $('#name').val(data.name);
      })
   });

    $('#saveBtn').on('click', function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#skillForm').serialize(),
          url: "{{ route('skills.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#skillForm').trigger("reset");
              $('#skillModal').modal('hide');
              table.draw();
              $('#saveBtn').html('<i class="fas fa-save"></i> Save Changes');
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('<i class="fas fa-save"></i> Save Changes');
          }
      });
    });

    $('body').on('click', '.deleteSkill', function () {
        var skill_id = $(this).data("id");
        $('#confirmModal').modal('show');
        $('#ok_button').on('click', function(){
            $.ajax({
                url: "{{ route('skills.store') }}"+'/'+skill_id,
                type: "DELETE",
                beforeSend:function(){
                    $('#ok_button').text('Deleting...');
                },
                success: function (data) {
                    $('#confirmModal').modal('hide');
                    table.draw();
                    $('#ok_button').html('<i class="fa fa-check" aria-hidden="true"></i> Delete');
                },
                error: function (data) {
                    console.log('error:', data);
                    $('#ok_button').html('<i class="fa fa-check" aria-hidden="true"></i> Delete');
                }
            });
        });
    });
});
</script>
@endpush

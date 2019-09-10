@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Departments</h3>
            <button type="button" class="btn btn-success pull-right" href="javascript:void(0)"
                id="createNewDepartment"><i class="fa fa-plus" aria-hidden="true"></i> Create New Department</button>
        </div>
        <div class="box-body">
            <table class="table table-responsive data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.department.form')

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
        ajax: "{{ route('departments.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewDepartment').click(function () {
        $('#saveBtn').val("create-department");
        $('#department_id').val('');
        $('#departmentForm').trigger("reset");
        $('#modalHeading').html("Create New Department");
        $('#departmentModal').modal('show');
    });

    $('body').on('click', '.editDepartment', function () {
      var department_id = $(this).data('id');
      $.get("{{ route('departments.index') }}" +'/' + department_id +'/edit', function (data) {
          $('#modalHeading').html("Edit Department");
          $('#saveBtn').val("edit-user");
          $('#departmentModal').modal('show');
          $('#department_id').val(data.id);
          $('#name').val(data.name);
          $('#description').val(data.description);
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#departmentForm').serialize(),
          url: "{{ route('departments.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#departmentForm').trigger("reset");
              $('#departmentModal').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });

    $('body').on('click', '.deleteDepartment', function () {

        var department_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('departments.store') }}"+'/'+department_id,
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

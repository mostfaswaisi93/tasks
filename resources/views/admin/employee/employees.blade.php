@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Employees</h3>
            <button type="button" class="btn btn-success pull-right" href="javascript:void(0)" id="createNewEmployee"><i
                    class="fa fa-plus" aria-hidden="true"></i> Create New Employee</button>
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

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Employees</h3>
            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addModal"><i
                    class="fa fa-plus" aria-hidden="true"></i> Add New</button>
        </div>
        <div class="box-body">
            <table id="datatable" class="table table-responsive">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $item)
                    <tr>
                        <td>{{$item->full_name}}</td>
                        <td>{{$item->department->name}}</td>
                        @if ($item->status == 'pending')
                        <td><button class="btn btn-info" style="width: 107px;"><i class="fas fa-clock"></i>
                                Pending</button>@include('admin.employee._select')</td>
                        @elseif ($item->status == 'in_progress')
                        <td><button class="btn btn-primary" style="width: 107px;"><i class="fas fa-spinner"></i>
                                In Progress</button>@include('admin.employee._select')</td>
                        @elseif ($item->status == 'completed')
                        <td><button class="btn btn-success" style="width: 107px;"><i class="fas fa-check-circle"></i>
                                Completed</button>@include('admin.employee._select')</td>
                        @elseif ($item->status == 'inactive')
                        <td><button class="btn btn-danger" style="width: 107px;"><i class="fas fa-window-close"></i>
                                Inactive</button>@include('admin.employee._select')</td>
                        @else
                        <td><button class="btn btn-warning" style="width: 107px;"><i class="fas fa-ban"></i>
                                Leave</button>@include('admin.employee._select')</td>
                        @endif
                        <td>
                            <button class="btn btn-info" data-myfull_name="{{$item->full_name}}"
                                data-myemail="{{$item->email}}" data-employeeid="{{$item->id}}" data-toggle="modal"
                                data-target="#show"><i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-primary" data-myfull_name="{{$item->full_name}}"
                                data-myemail="{{$item->email}}" data-employeeid="{{$item->id}}"
                                data-myphone="{{$item->phone}}" data-myaddress="{{$item->address}}"
                                data-myjob_title="{{$item->job_title}}" data-myskill="{{$item->skill_id}}"
                                data-mydepartment="{{$item->department_id}}" data-toggle="modal" data-target="#edit"><i
                                    class="far fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" data-employeeid={{$item->id}} data-toggle="modal"
                                data-target="#delete"> <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {{$employees->render()}}
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addModalLabel">Add Employee</h4>
            </div>
            @include('admin._errors')
            <form method="POST" action="{{ action('EmployeeController@store')}}" accept-charset="UTF-8"
                class="form-horizontal" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="full_name" class="col-md-2 control-label">Full Name</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="full_name" type="text" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">Email</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="email" type="text" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-md-2 control-label">Phone</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="phone" type="text" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="address" type="text" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="job_title" class="col-md-2 control-label">Job Title</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="job_title" type="text" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department_id" class="col-md-2 control-label">Department</label>
                        <div class="col-md-9">
                            <select class="form-control" required="required" name="department_id">
                                @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="skill_id" class="col-md-2 control-label">Skills</label>
                        <div class="col-md-9">
                            <select class="form-control" id="skill_id" name="skill_id[]" multiple>
                                @foreach ($skills as $skill)
                                <option value="{{$skill->id}}">{{$skill->name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editModalLabel">Edit Employee</h4>
            </div>
            @include('admin._errors')
            <form method="POST" action="{{route('employees.update','test')}}" accept-charset="UTF-8"
                class="form-horizontal" role="form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="employee_id" id="employee_id" value="">
                    <div class="form-group">
                        <label for="full_name" class="col-md-2 control-label">Full Name</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="full_name" type="text"
                                id="full_name" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">Email</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="email" type="text" id="email" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-md-2 control-label">Phone</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="phone" type="text" id="phone" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="address" type="text" id="address" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="job_title" class="col-md-2 control-label">Job Title</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="job_title" type="text"
                                id="job_title" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department_id" class="col-md-2 control-label">Department</label>
                        <div class="col-md-9">
                            <select class="form-control" required="required" id="department_id" name="department_id">
                                {{-- @foreach ($departments as $department)
                                <option value="{{$department->id}}" @if($department->id == $employee->department_id)
                                selected @endif>{{$department->name}}</option>
                                @endforeach --}}
                                @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="skill_id" class="col-md-2 control-label">Skills</label>
                        <div class="col-md-9">
                            <select class="form-control" id="skill_id" name="skill_id[]" multiple>
                                {{-- @foreach ($skills as $skill)
                                <option value="{{$skill->id}}" @foreach ($employee->skills as $skillEmp)
                                {{$skillEmp->id == $skill->id ? "selected" : ""}}
                                @endforeach>{{$skill->name}}</option>
                                @endforeach --}}
                                @foreach ($skills as $skill)
                                <option value="{{$skill->id}}">{{$skill->name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.employee.form')

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
        ajax: "{{ route('employees.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewEmployee').click(function () {
        $('#saveBtn').val("create-employee");
        $('#employee_id').val('');
        $('#employeeForm').trigger("reset");
        $('#modalHeading').html("Create New Employee");
        $('#employeeModal').modal('show');
    });

    $('body').on('click', '.editEmployee', function () {
      var employee_id = $(this).data('id');
      $.get("{{ route('employees.index') }}" +'/' + employee_id +'/edit', function (data) {
          $('#modalHeading').html("Edit Employee");
          $('#saveBtn').val("edit-user");
          $('#employeeModal').modal('show');
          $('#employee_id').val(data.id);
          $('#name').val(data.name);
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#employeeForm').serialize(),
          url: "{{ route('employees.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#employeeForm').trigger("reset");
              $('#employeeModal').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });

    $('body').on('click', '.deleteEmployee', function () {

        var employee_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('employees.store') }}"+'/'+employee_id,
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

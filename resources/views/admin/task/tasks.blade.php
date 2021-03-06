@extends('master')

@section('content')

<div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Tasks</h3>
            <button type="button" name="create_task" id="create_task" class="btn btn-success pull-right"><i
                    class="fa fa-plus"></i> Create New</button>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="project" id="project"
                                    onchange="filtetrProject(this);">
                                    <option value=""> Select Project</option>
                                    @foreach ($projects as $project)
                                    <option value="{{$project->id}}">{{$project->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="filterStatus" id="filterStatus"
                                    onchange="filtetrStatus(this);">
                                    <option value=''>Select Status </option>
                                    <option value='Pending'>Pending</option>
                                    <option value='In Progress'>In Progress</option>
                                    <option value='Done'>Done</option>
                                    <option value='Completed'>Completed</option>
                                    <option value='Cancel'>Cancel</option>
                                    <option value='Late'>Late</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="employee" id="employee"
                                    onchange="filtetrEmployee(this);">
                                    <option value=""> Select Employee</option>
                                    @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->fullName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group date" id="dateFilterSelect" onchange="filtetrDate(this);">
                                    <input type="text" class="form-control pull-right">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>#</th>
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
    var filter_date = '';
    var task_id = '';
    var project_id= '';
    var employee_id= '';
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
                {data: getEmployee, name: 'employees'},
                {data: 'project', name: 'project'},
                {data: 'start', name: 'start'},
                {data: 'end', name: 'end'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false}
            ],
            "columnDefs": [
                {
                    "targets": 6,
                    render: function (data, type, row, meta){
                    var $select = $(`<select class='status form-control'
                    id='status' onchange=selectStatus(${row.id})>
                    <option value='Pending'>Pending</option>
                    <option value='In Progress'>In Progress</option>
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

        function getEmployee(data , type, full, meta){
            var orderType = data.DataType;
            var nameTage = JSON.parse(data.employees.replace(/&quot;/g,'"'));
            var fName = '';
            nameTage.forEach(element => {
                fName+= "<span class='badge badge-primary'>"+element.fullName+"</span> ";
            });
            return fName;
        }

        $('#create_task').click(function(){
            $('.modal-title').text("Add New Task");
                $('#action_button').val("Add");
                $('#taskForm').trigger("reset");
                $('.select2').val('').trigger('change');
                CKEDITOR.instances['description'].setData('');
                CKEDITOR.instances['notes'].setData('');
                $('.selectEmployee').val('').trigger('change');
                $('#action').val("Add");
                $('#taskModal').modal('show');
        });

        $('#taskForm').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
                var formData = new FormData(this);
                var descriptionValue = '';
                descriptionValue = CKEDITOR.instances['description'].getData();
                formData.append('description', descriptionValue);
                var notesValue = '';
                notesValue = CKEDITOR.instances['notes'].getData();
                formData.append('notes', notesValue);
            $.ajax({
                url:"{{ route('tasks.store') }}",
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
                    $('#taskForm')[0].reset();
                    $('#data-table').DataTable().ajax.reload();
                    $('#taskModal').modal('hide');
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
            var notesValue = '';
            notesValue = CKEDITOR.instances['notes'].getData();
            formData.append('notes', notesValue);
            $.ajax({
                url:"{{ route('tasks.update') }}",
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
                $('#taskForm')[0].reset();
                $('#data-table').DataTable().ajax.reload();
                $('#taskModal').modal('hide');
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
                url:"/admin/tasks/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    function startConverter(){
                        var a = new Date(html.data.start);
                        var hour = a.getHours();
                        var min = a.getMinutes();
                        var time = hour + ':' + min;
                        return time;
                    }
                    function endConverter(){
                        var a = new Date(html.data.end);
                        var hour = a.getHours();
                        var min = a.getMinutes();
                        var time = hour + ':' + min;
                        return time;
                    }
                    var employees = html.data.employees;
                    var employee_ids = _.map(employees, 'id');
                    $('#title').val(html.data.title);
                    CKEDITOR.instances['description'].setData(html.data.description);
                    $('#project_id').val(html.data.project_id).trigger('change');
                    CKEDITOR.instances['notes'].setData(html.data.notes);
                    $('#start').val(startConverter(0));
                    $('#end').val(endConverter(0));
                    $('#employee_id > option').prop('selected', false);
                    $('#employee_id > option').each(function(){
                        var item = this;
                        if(employee_ids.indexOf(parseInt(item.value)) > -1){
                            $(this).prop('selected', true).trigger('change');
                        }else{
                            console.log('selected',false);
                        }
                    });
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Edit Task");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                    $('#taskModal').modal('show');
                }
            });
        });

        $(document).on('click', '.showBtn', function(){
            task_id = $(this).attr('id');
            $.ajax({
                url:"/admin/tasks/"+task_id,
                dataType:"json",
                success:function(html){
                    var employees = html.data.employees;
                    var employee_ids = _.map(employees, 'id');
                    $('#showTilte').html(html.data.title);
                    $('#showDescription').html(html.data.description);
                    $('#showEmployees > option').prop('selected', false);
                    $('#showEmployees > option').each(function(){
                        var item = this;
                        if(employee_ids.indexOf(parseInt(item.value)) > -1){
                            $(this).prop('selected', true).trigger('change');
                        }else{
                            console.log('selected',false);
                        }
                    });
                    $('#showProject').html(html.data.project.title);
                    $('#showStart').html(html.data.start);
                    $('#showEnd').html(html.data.end);
                    $('#showNotes').html(html.data.notes);
                    $('#showStatus').html(html.data.status);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Show Task");
                    $('#showModal').modal('show');
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
                        toastr.success('Deleted Done!', 'Success!');
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

    function filtetrProject(id=null){
        project_id= id.value;
        $('#data-table').DataTable().ajax.url("{{ route('tasks.index') }}"+'?project_id='+project_id+'&employee_id='+employee_id+'&status='+status+'&type=filter').load();
    }

    function filtetrEmployee(emp_id=null){
        employee_id= emp_id.value;
        $('#data-table').DataTable().ajax.url("{{ route('tasks.index') }}"+'?project_id='+project_id+'&employee_id='+employee_id+'&status='+status+'&type=filter').load();
    }

    function filtetrStatus(status_f=null){
        status= status_f.value;
        $('#data-table').DataTable().ajax.url("{{ route('tasks.index') }}"+'?project_id='+project_id+'&employee_id='+employee_id+'&status='+status+'&type=filter').load();
    }

    function filtetrDate(filTime=null){
        filter_date= filTime.value;
        $('#data-table').DataTable().ajax.url("{{ route('tasks.index') }}"+'?project_id='+project_id+'&employee_id='+employee_id+'&status='+status+'&type=filter').load();
    }

    var dateNow = new Date();

    $('.timepickerStart').timepicker({
        format: 'HH:mm',
        defaultDate:dateNow,
        showMeridian: false
    });

    $('.timepickerEnd').timepicker({
        format: 'HH:mm',
        defaultDate:dateNow,
        showMeridian: false
    });

    $('#start').on('dp.change', function(e){
        var new_time =  moment(e.timeStamp).add(20, 'm').format("HH:mm");
        $('body').find('#end').val(new_time);
    });

    $('#dateFilterSelect').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    $('.select2').select2({
        placeholder: "Select Project"
    });
    $(".selectEmployee").select2({
        placeholder: "Select Employees",
        allowClear: true
    });
    $(".selectEmployees").select2();
    $('.selectEmployees').prop("disabled", true);

    CKEDITOR.replace('description', {
      height: 150,
    });

    CKEDITOR.replace('notes', {
      height: 150,
    });

</script>

@endpush
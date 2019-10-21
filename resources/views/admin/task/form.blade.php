<!-- Task Modal -->

<div class="modal fade" id="taskModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="taskForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="control-label col-md-2">Title: </label>
                        <div class="col-md-9">
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-2 control-label">Description: </label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description" cols="50" rows="10" id="description"
                                placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="employee_id" class="col-md-2 control-label">Employees: </label>
                        <div class="col-md-9">
                            <select class="form-control selectEmployee" id="employee_id" name="employee_id[]" multiple
                                style="width: 100%;">
                                @foreach ($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->fullName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="project_id" class="col-md-2 control-label">Project: </label>
                        <div class="col-md-9">
                            <select class="form-control select2" id="project_id" name="project_id" style="width: 100%;">
                                @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start" class="control-label col-md-2">Time from: </label>
                        <div class="col-md-4">
                            <input type="text" name="start" id="start" class="form-control timepickerStart"
                                placeholder="Enter Start Time" />
                        </div>
                        <label for="end" class="control-label col-md-1">To: </label>
                        <div class="col-md-4">
                            <input type="text" name="end" id="end" class="form-control timepickerEnd"
                                placeholder="Enter End Time" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-md-2 control-label">Notes: </label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="notes" cols="50" rows="10" id="notes"
                                placeholder="Enter Notes"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button type="submit" class="btn btn-primary" id="action_button" name="action_button"
                            value="Add"><i class="fas fa-save"></i>
                            Save changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Show Task Modal -->

<div class="modal fade" id="showModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Show Task</h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="showTilte" class="control-label col-md-2">Title: </label>
                        <div class="col-md-9">
                            <div id="showTilte" name="title" class="showStyle"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="showDescription" class="control-label col-md-2">Description: </label>
                        <div class="col-md-9">
                            <div id="showDescription" name="description" class="showStyle"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="showEmployees" class="control-label col-md-2">Employees: </label>
                        <div class="col-md-9 selectStyle">
                            <select class="form-control showStyle selectEmployees" id="showEmployees"
                                name="showEmployees[]" multiple="multiple" style="width: 100%;">
                                @foreach ($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->fullName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="showProject" class="control-label col-md-2">Project: </label>
                        <div class="col-md-9">
                            <div id="showProject" name="project" class="showStyle"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="showStart" class="control-label col-md-2">Time from: </label>
                        <div class="col-md-4">
                            <div id="showStart" name="start" class="showStyle"></div>
                        </div>
                        <label for="showEnd" class="control-label col-md-1">To: </label>
                        <div class="col-md-4">
                            <div id="showEnd" name="end" class="showStyle"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="showNotes" class="control-label col-md-2">Notes: </label>
                        <div class="col-md-9">
                            <div id="showNotes" name="notes" class="showStyle"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="showStatus" class="col-md-2 control-label">Status: </label>
                        <div class="col-md-9">
                            <div id="showStatus" name="status" class="showStyle"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-success"><i class="fas fa-thumbs-up"></i>
                            OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Delete -->

<div class="modal fade" id="confirmModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <h4 style="margin: 0;" class="text-center">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" name="ok_button" id="ok_button">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>
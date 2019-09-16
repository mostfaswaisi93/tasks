<!-- Task Modal -->

<div class="modal fade" id="taskModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Task</h4>
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
                        <label for="employee_id" class="col-md-2 control-label">Employee: </label>
                        <div class="col-md-9">
                            <select class="form-control" id="employee_id" name="employee_id[]" multiple>
                                @foreach ($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="project_id" class="col-md-2 control-label">Project: </label>
                        <div class="col-md-9">
                            <select class="form-control" id="project_id" name="project_id">
                                @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start" class="col-md-2 control-label">Start Time</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" class="form-control timepickerStart" name="start" type="text"
                                    id="start" placeholder="Start Time">
                                <div class="input-group-addon">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end" class="col-md-2 control-label">End Time</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" class="form-control timepickerEnd" name="end" type="text" id="end"
                                    placeholder="End Time">
                                <div class="input-group-addon">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Close</button>
                        <button type="submit" class="btn btn-primary" id="action_button" name="action_button"
                            value="Add"><i class="fas fa-save"></i>
                            Save changes</button>
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

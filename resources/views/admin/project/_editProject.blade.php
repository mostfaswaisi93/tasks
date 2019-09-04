<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editModalLabel">Edit Project</h4>
            </div>
            @include('admin._errors')
            <form method="POST" action="{{route('projects.update','test')}}" accept-charset="UTF-8"
                class="form-horizontal" role="form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="project_id" id="project_id" value="">
                    <div class="form-group">
                        <label for="title" class="col-md-2 control-label">Title</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="title" type="text" id="title" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-9">
                            <input class="form-control" autofocus="autofocus" name="description" type="text"
                                id="description" />
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department_id" class="col-md-2 control-label">Department</label>
                        <div class="col-md-8">
                            <select class="form-control" id="department_id" name="department_id">
                                @foreach ($departments as $department)
                                <option value="{{$department->id}}" @if($department->id == $project->department_id)
                                    selected @endif>{{$department->name}}</option>
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

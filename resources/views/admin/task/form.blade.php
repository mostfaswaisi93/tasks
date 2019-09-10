<!-- Modal -->

<div class="modal fade" id="skillModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    @include('admin._errors')
                    <form id="skillForm" name="skillForm" class="form-horizontal">
                        <input type="hidden" name="skill_id" id="skill_id">
                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">Name</label>
                            <div class="col-md-9">
                                <input class="form-control" autofocus="autofocus" name="name" id="name" type="text"
                                    placeholder="Enter Name" value="" maxlength="50" required="" />
                                <span class="help-block">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <i class="fa fa-times" aria-hidden="true"></i>
                                Close</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">
                                <i class="fas fa-save"></i>
                                Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

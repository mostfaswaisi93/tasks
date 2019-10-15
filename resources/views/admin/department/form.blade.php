<!-- Department Modal -->

<div class="modal fade" id="departmentModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Department</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="departmentForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label col-md-2">Name: </label>
                        <div class="col-md-9">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-2 control-label">Description: </label>
                        <div class="col-md-9">
                            <textarea cols="80" id="description" name="description" rows="10"
                                placeholder="Enter Description"></textarea>
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

<!-- Show Department Modal -->

<div class="modal fade" id="showModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Show Department</h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="showName" class="control-label col-md-2">Name: </label>
                        <div class="col-md-9">
                            <div id="showName" name="name" class="showStyle"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="showDescription" class="col-md-2 control-label">Description: </label>
                        <div class="col-md-9">
                            <div id="showDescription" name="description" class="showStyle"></div>
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
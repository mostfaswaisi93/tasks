<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
</footer>

<!-- Control Sidebar -->

<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{url('/design/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('/design/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{url('/design/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/design/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{url('/design/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('/design/adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('/design/adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/design/adminlte/dist/js/demo.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/js/all.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#datatable').DataTable({
            'paging'      : false,
            'searching'   : false,
        });

        // Start Edit

        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var name = button.data('myname')
            var description = button.data('mydes')
            var department = button.data('mydepartment')
            var skill = button.data('myskill')
            var title = button.data('mytitle')
            var full_name = button.data('myfull_name')
            var email = button.data('myemail')
            var phone = button.data('myphone')
            var address = button.data('myaddress')
            var job_title = button.data('myjob_title')
            var employee_id = button.data('employeeid')
            var project_id = button.data('projectid')
            var dep_id = button.data('depid')
            var skill_id = button.data('skillid')
            var modal = $(this)

            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #title').val(title);
            modal.find('.modal-body #full_name').val(full_name);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #phone').val(phone);
            modal.find('.modal-body #address').val(address);
            modal.find('.modal-body #job_title').val(job_title);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #employee_id').val(employee_id);
            modal.find('.modal-body #project_id').val(project_id);
            modal.find('.modal-body #dep_id').val(dep_id);
            modal.find('.modal-body #skill_id').val(skill_id);

        })

        // Start Delete

        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var employee_id = button.data('employeeid')
            var project_id = button.data('projectid')
            var dep_id = button.data('depid')
            var skill_id = button.data('skillid')
            var modal = $(this)
            modal.find('.modal-body #employee_id').val(employee_id);
            modal.find('.modal-body #project_id').val(project_id);
            modal.find('.modal-body #dep_id').val(dep_id);
            modal.find('.modal-body #skill_id').val(skill_id);
        })

        $('#show').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var description = button.data('mydes')
            var department = button.data('mydepartment')
            var title = button.data('mytitle')
            var project_id = button.data('projectid')
            var modal = $(this)

            modal.find('.modal-body #title').val(title);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #project_id').val(project_id);
        })
    })

</script>

</body>

</html>

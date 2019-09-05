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
<!-- jQuery UI 1.11.4 -->
<script src="{{url('/design/adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('/design/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{url('/design/adminlte/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{url('/design/adminlte/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('/design/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{url('/design/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{url('/design/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('/design/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('/design/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{url('/design/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{url('/design/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}">
</script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{url('/design/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{url('/design/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('/design/adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('/design/adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('/design/adminlte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/design/adminlte/dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="{{url('/design/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/design/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/js/all.min.js" type="text/javascript"></script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#datatable').DataTable({
            // 'paging'      : true,
            // 'searching'   : true,
        });

        // Start Edit

        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var name = button.data('myname')
            var description = button.data('mydes')
            var department = button.data('mydepartment')
            var title = button.data('mytitle')
            var project_id = button.data('projectid')
            var dep_id = button.data('depid')
            var tag_id = button.data('tagid')
            var modal = $(this)

            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #title').val(title);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #project_id').val(project_id);
            modal.find('.modal-body #dep_id').val(dep_id);
            modal.find('.modal-body #tag_id').val(tag_id);

        })

        // Start Delete

        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var project_id = button.data('projectid')
            var dep_id = button.data('depid')
            var tag_id = button.data('tagid')
            var modal = $(this)
            modal.find('.modal-body #project_id').val(project_id);
            modal.find('.modal-body #dep_id').val(dep_id);
            modal.find('.modal-body #tag_id').val(tag_id);
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

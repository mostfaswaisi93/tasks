<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="/admin/employees/pending/{{$item->id}}"><b>Pending</b></a></li>
        <li><a href="/admin/employees/in_progress/{{$item->id}}"><b>In Progress</b></a></li>
        <li><a href="/admin/employees/completed/{{$item->id}}"><b>Completed</b></a></li>
        <li><a href="/admin/employees/inactive/{{$item->id}}"><b>Inactive</b></a></li>
        <li><a href="/admin/employees/leave/{{$item->id}}"><b>Leave</b></a></li>
    </ul>
</div>

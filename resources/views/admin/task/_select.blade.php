<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="/admin/tasks/pending/{{$item->id}}"><b>Pending</b></a></li>
        <li><a href="/admin/tasks/in_progress/{{$item->id}}"><b>In Progress</b></a></li>
        <li><a href="/admin/tasks/done/{{$item->id}}"><b>Done</b></a></li>
        <li><a href="/admin/tasks/completed/{{$item->id}}"><b>Completed</b></a></li>
        <li><a href="/admin/tasks/cancel/{{$item->id}}"><b>Cancel</b></a></li>
        <li><a href="/admin/tasks/late/{{$item->id}}"><b>Late</b></a></li>
    </ul>
</div>

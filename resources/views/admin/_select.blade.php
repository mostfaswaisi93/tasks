<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="/admin/projects/pending/{{$item->id}}"><b>Pending</b></a></li>
        <li><a href="/admin/projects/in_progress/{{$item->id}}"><b>In Progress</b></a></li>
        <li><a href="/admin/projects/done/{{$item->id}}"><b>Done</b></a></li>
        <li><a href="/admin/projects/completed/{{$item->id}}"><b>Completed</b></a></li>
        <li><a href="/admin/projects/cancel/{{$item->id}}"><b>Cancel</b></a></li>
        <li><a href="/admin/projects/late/{{$item->id}}"><b>Late</b></a></li>
    </ul>
</div>

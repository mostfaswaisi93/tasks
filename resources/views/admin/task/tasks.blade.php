@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Tasks
                        <a href="/admin/tasks/create" class="btn btn-default pull-right">Add New</a>
                    </h2>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Employee</th>
                                <th>Project</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Notes</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->employee->full_name}}</td>
                                <td>{{$item->project->title}}</td>
                                <td>{{$item->start->format('d/m/Y')}}</td>
                                <td>{{$item->start->format('H:i')}}</td>
                                <td>{{$item->end->format('H:i')}}</td>
                                <td>{{$item->notes}}</td>
                                @if ($item->status == 'active')
                                <td><button class="btn btn-xs btn-primary">Active</button></td>
                                @elseif ($item->status == 'pending')
                                <td><button class="btn btn-xs btn-success">Pending</button></td>
                                @else
                                <td><button class="btn btn-xs btn-warning">Deactive</button></td>
                                @endif
                                <td>
                                    <a href="/admin/tasks/active/{{$item->id}}" class="btn btn-xs btn-primary">A</a>
                                    <a href="/admin/tasks/pending/{{$item->id}}" class="btn btn-xs btn-success">P</a>
                                    <a href="/admin/tasks/deactive/{{$item->id}}" class="btn btn-xs btn-warning">D</a>
                                    <a href="/admin/tasks/{{$item->id}}/edit" class="btn btn-xs btn-info">Edit</a>
                                    <form action="/admin/tasks/{{$item->id}}" method="post" style="display: inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$tasks->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

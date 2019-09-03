@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Projects
                        <a href="/admin/projects/create" class="btn btn-default pull-right">Add New</a>
                    </h2>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->department->name}}</td>
                                @if ($item->status == 'active')
                                <td><button class="btn btn-xs btn-primary">Active</button></td>
                                @elseif ($item->status == 'pending')
                                <td><button class="btn btn-xs btn-success">Pending</button></td>
                                @else
                                <td><button class="btn btn-xs btn-warning">Deactive</button></td>
                                @endif
                                <td>
                                    <a href="/admin/projects/active/{{$item->id}}" class="btn btn-xs btn-primary">A</a>
                                    <a href="/admin/projects/pending/{{$item->id}}" class="btn btn-xs btn-success">P</a>
                                    <a href="/admin/projects/deactive/{{$item->id}}"
                                        class="btn btn-xs btn-warning">D</a>
                                    <a href="/admin/projects/{{$item->id}}/edit" class="btn btn-xs btn-info">Edit</a>
                                    <form action="/admin/projects/{{$item->id}}" method="post" style="display: inline;">
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
                        {{$projects->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Employees
                        <a href="/admin/employees/create" class="btn btn-default pull-right">Add New</a>
                    </h2>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Department</th>
                                <th>Job Title</th>
                                <th>Skills - Tags</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $item)
                            <tr>
                                <td>{{$item->full_name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->department->name}}</td>
                                <td>{{$item->job->title}}</td>
                                <td>
                                    @foreach ($item->tags as $tag)
                                    {{$tag->name}}
                                    <br>
                                    @endforeach
                                </td>
                                @if ($item->status == 'active')
                                <td><button class="btn btn-xs btn-primary">Active</button></td>
                                @elseif ($item->status == 'pending')
                                <td><button class="btn btn-xs btn-success">Pending</button></td>
                                @else
                                <td><button class="btn btn-xs btn-warning">Deactive</button></td>
                                @endif
                                <td>
                                    <a href="/admin/employees/active/{{$item->id}}" class="btn btn-xs btn-primary">A</a>
                                    <a href="/admin/employees/pending/{{$item->id}}" class="btn btn-xs btn-success">P</a>
                                    <a href="/admin/employees/deactive/{{$item->id}}"
                                        class="btn btn-xs btn-warning">D</a>
                                    <a href="/admin/employees/{{$item->id}}/edit" class="btn btn-xs btn-info">Edit</a>
                                    <form action="/admin/employees/{{$item->id}}" method="post"
                                        style="display: inline;">
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
                        {{$employees->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

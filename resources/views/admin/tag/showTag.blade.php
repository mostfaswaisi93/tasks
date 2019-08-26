@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        {{$tag->name}}
                        <a href="/admin/tags" class="btn btn-default pull-right">Go Back</a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

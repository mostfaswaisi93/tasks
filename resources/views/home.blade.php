@extends('layout')

@section('content')

<div class="container">

    {{-- <div class="row form-search">
        <form method="GET" action="" accept-charset="UTF-8" role="form">
            <div class="col-md-10">
                <input class="form-control" placeholder="Search..." name="search" type="text">
            </div>
            <div class="col-md-2">
                <input class="btn btn-block btn-default" type="submit" value="Sumbit">
            </div>
        </form>
    </div> --}}

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>

                <div class="panel-body">
                    <p></p>
                    <p></p>
                    <p>
                        Skills:
                        <span class="label label-danger">No tag found.</span>
                    </p>
                    <p>
                        <span class="btn btn-sm btn-success">1</span>
                        <span class="btn btn-sm btn-info">2 <span class="badge"></span></span>
                        <a href="" class="btn btn-sm btn-primary">See more</a>
                    </p>
                </div>
            </div>
            <div class="center">
            </div>
        </div>
    </div>
</div>

@endsection

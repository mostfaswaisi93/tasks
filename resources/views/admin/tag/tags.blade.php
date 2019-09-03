@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Skills
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal"
                            data-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>
                    </h2>
                </div>
                <div class="panel-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    <button class="btn btn-xs btn-info" data-myname="{{$item->name}}"
                                        data-tagid="{{$item->id}}" data-toggle="modal" data-target="#edit"><i
                                            class="far fa-edit"></i>
                                        Edit</button>
                                    <button class="btn btn-xs btn-danger" data-tagid={{$item->id}} data-toggle="modal"
                                        data-target="#delete"> <i class="fa fa-trash" aria-hidden="true"></i>
                                        Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$tags->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.tag._createTag')
@include('admin.tag._editTag')
@include('admin.tag._deleteTag')

<script type="text/javascript">
    $(document).ready(function(){
        $('#datatable').DataTable({
            "paging": false
        });

        // Start Edit

        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var name = button.data('myname')
            var tag_id = button.data('tagid')
            var modal = $(this)

            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #tag_id').val(tag_id);

        })

        // Start Delete

        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var tag_id = button.data('tagid')
            var modal = $(this)
            modal.find('.modal-body #tag_id').val(tag_id);
        })
    })

</script>

@endsection

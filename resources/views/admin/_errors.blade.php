@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <h4>{{$error}}</h4>
    @endforeach
</div>
@endif

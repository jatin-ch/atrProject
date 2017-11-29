@extends('layouts.admin')
@section('title') | Roles | Create @endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                 Create New Role
                </div>

                <div class="panel-body">

                  <form action="{{route('roles.store')}}" method="POST">
                    {{ csrf_field() }}

                    <h2 class="title">Role Details:</h2>

                      <label for="display_name">Name (Human Readable)</label>
                      <input type="text" class="form-control" name="display_name" value="{{old('display_name')}}" id="display_name">
                      <br>

                      <label for="name">Slug (Can not be edited)</label>
                      <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name">
                      <br>

                      <label for="description">Description</label>
                      <input type="text" class="form-control" id="description" name="description" value="{{old('description')}}">
                      <br>

                     <h2 class="title">Permissions:</h1>
                     @foreach ($permissions as $permission)
                      <input type="checkbox" name="permissions[]" value="{{$permission->id}}"> {{$permission->display_name}} <br>
                     @endforeach
                     <br>

                      <button type="submit" class="btn btn-primary">Save Changes to Role</button>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

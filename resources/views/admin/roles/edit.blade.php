@extends('layouts.admin')
@section('title') | Role | {{$role->display_name}} @endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Edit {{$role->display_name}}
                </div>

                <div class="panel-body">

                  <form action="{{route('roles.update', $role->id)}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <h2 class="title">Role Details:</h2>

                      <label for="display_name">Name (Human Readable)</label>
                      <input type="text" class="form-control" name="display_name" value="{{$role->display_name}}" id="display_name">
                      <br>

                      <label for="name">Slug (Can not be edited)</label>
                      <input type="text" class="form-control" name="name" value="{{$role->name}}" disabled id="name">
                      <br>

                      <label for="description">Description</label>
                      <input type="text" class="form-control" value="{{$role->description}}" id="description" name="description">
                      <br>

                     <h2 class="title">Permissions:</h1>
                     @foreach ($permissions as $permission)
                      <input type="checkbox" name="permissions[]" value="{{$permission->id}}" {{in_array($permission->id, $perms ) ? 'checked' :'' }}> {{$permission->display_name}} <br>
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

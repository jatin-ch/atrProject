@extends('layouts.admin')
@section('title') | Permission | {{$permission->display_name}} @endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Edit Permission Details
                </div>

                <div class="panel-body">

                  <form action="{{route('permissions.update', $permission->id)}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('PUT')}}

                    <label for="display_name">Name (Display Name)</label>
                    <input type="text" class="form-control" name="display_name" id="display_name" value="{{$permission->display_name}}">
                    <br>

                    <label for="name">Slug <small>(Cannot be changed)</small></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$permission->name}}" disabled>
                    <br>

                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Describe what this permission does" value="{{$permission->description}}">
                    <br>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

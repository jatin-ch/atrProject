@extends('layouts.admin')
@section('title') | Permission | {{$permission->display_name}} @endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  View Permission Details
                  <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-primary btn-sm pull-right">Edit Permission</a>
                </div>

                <div class="panel-body">

                  <p>
                  <strong>{{$permission->display_name}}</strong> <small>{{$permission->name}}</small>
                  <br>
                  {{$permission->description}}
                </p>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

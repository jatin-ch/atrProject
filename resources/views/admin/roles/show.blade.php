@extends('layouts.admin')
@section('title') | Role | {{$role->display_name}} @endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  View Role Details
                  <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary btn-sm pull-right"> Edit this Role</a>
                </div>

                <div class="panel-body">

                  <h1 class="title">{{$role->display_name}}<small><em>({{$role->name}})</em></small></h1>
                   <h5>{{$role->description}}</h5>

                  <h2 class="title">Permissions:</h2>
                <ul>
                  @foreach ($role->permissions as $r)
                    <li>{{$r->display_name}}  <span style="margin-left:10px">({{$r->description}})</span></li>
                  @endforeach
                </ul>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

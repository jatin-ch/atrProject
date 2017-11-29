@extends('layouts.admin')
@section('title') | Roles @endsection
@section('content')
<section class="content-header">
      <h1>
        Roles
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Role Description</a></li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
<div class="container">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <!--Manage Roles-->
                  <!--<a href="{{route('roles.create')}}" class="btn btn-primary btn-sm pull-right">Create New Role</a>-->
                  <label>Manage Roles</label>
          <button class="btn btn-success btn-sm pull-right">
              <a href="{{route('roles.create')}}" style="color:white">Create New Role</a>
              </button>
                </div>

                <div class="panel-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Description</th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($roles as $role)
                        <tr>
                          <th>{{$role->display_name}}</th>
                          <td>{{$role->name}}</td>
                          <td>{{$role->description}}</td>
                          <td><a class="btn btn-primary btn-sm" href="{{route('roles.show', $role->id)}}">View</a>&nbsp;&nbsp;<a class="btn btn-success btn-sm" href="{{route('roles.edit', $role->id)}}">Edit</a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection

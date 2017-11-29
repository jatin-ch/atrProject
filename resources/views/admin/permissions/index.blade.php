@extends('layouts.admin')
@section('title') | Permissions @endsection
@section('content')
<section class="content-header">
      <h1>
        Permission
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Permission Manage</a></li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
<div class="container">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <!--Manage Permissions-->
                  <!--<a href="{{route('permissions.create')}}" class="btn btn-primary btn-sm pull-right">Create New Permission</a>-->
                  <label>Manage Permissions</label>
          <button class="btn btn-success btn-sm pull-right">
              <a href="{{route('permissions.create')}}" style="color:white">Create New Permission</a>
          </button>
                </div>

                <div class="panel-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($permissions as $permission)
                        <tr>
                          <th>{{$permission->display_name}}</th>
                          <td>{{$permission->name}}</td>
                          <td>{{$permission->description}}</td>
                          <td><a class="btn btn-default btn-sm" href="{{route('permissions.show', $permission->id)}}">View</a><a class="btn btn-default btn-sm" href="{{route('permissions.edit', $permission->id)}}">Edit</a></td>
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

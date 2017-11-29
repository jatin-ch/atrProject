@extends('layouts.admin')
@section('title') | Users @endsection
@section('content')
<section class="content-header">
      <h1>
        Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">All</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                <label>  Manage Users</label>
                  <a href="{{route('users.create')}}" class="btn btn-success btn-sm pull-right">Create New User</a>
                </div>

                <div class="panel-body">
                  <div class="table-responsive">
                  <table class="table ">
                              <thead>
                                <tr>
                                  <th>id</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Date Created</th>
                                  <th>View</th>
                                  <th>Edit</th>
                                  <th><th>
                                </tr>
                              </thead>

                              <tbody>
                                @foreach ($users as $user)
                                  <tr>
                                    <th>{{$user->id}}</th>
                                    <td>
                                      @if(!empty($user->basicDetail->image))
                                      <img src="{{ asset('images/' .$user->basicDetail->image) }}" style="width:30px">
                                      @else
                                      <img src="{{ asset('images/user.png') }}" style="width:30px">
                                      @endif
                                    {{$user->name}}
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at->toFormattedDateString()}}</td>
                                    <td><a class="btn btn-default btn-sm" href="{{route('users.show', $user->id)}}">View</a>
                                        </td>
                                         <td><a class="btn btn-default btn-sm" href="{{route('users.edit', $user->id)}}">Edit</a></td>
                                    </tr>
                                @endforeach
                              </tbody>
                            </table>
                            </div>
                          <center>  {{$users->links()}} </center>
                </div>
            </div>
        </div>
    </div>
</div>
 </section>

@endsection

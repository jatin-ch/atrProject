@extends('layouts.admin')
@section('title') | User | {{$user->name}} @endsection
@section('content')
<section class="content-header">
      <h1>
        Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-info">
          <div class="panel-heading">
            <a href="{{route('users.edit', $user->id)}}" style="margin-top: -6px;" class="btn btn-warning btn-sm pull-right">Edit User</a>
            <h3 class="panel-title"> View User Details</h3>
          </div>
          <div class="panel-body">
            <div class="row">
            <div class="col-lg-offset-1 col-md-7 col-lg-7 ">
                <table class="table table-user-information">
                  <tbody>
                    <tr>
                      <td class="headlines">NAME:</td>
                      <td> {{$user->name}}</td>
                    </tr>
                     <tr>
                      <td class="headlines">EMAIL:</td>
                      <td> {{$user->email}}</td>
                    </tr>
                    <tr>
                      <td class="headlines">LEVEL:</td>
                      <td> {{ $user->level }}</td>
                    </tr>
                     <tr>
                      <td class="headlines">ROLES:</td>
                      <td>

                   <!--  {{$user->roles->count() == 0 ? 'This user has not been assigned any roles yet' : 'Roles'}} -->
                    @foreach ($user->roles as $role)
                      <p>{{$role->display_name}} ({{$role->description}})</p>
                    @endforeach

                      </td>
                    </tr>
                    <tr>
                      <td class="headlines">APPROVED:</td>
                      <td>
                        @if($user->approved == true)
                    Yes
                    @else
                    No
                    @endif</td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
        </div>
    </div>
</div>
</section>

@endsection

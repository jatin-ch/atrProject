@extends('layouts.admin')
@section('title') | Users | Create @endsection
@section('content')

<section class="content-header">
      <h1>
        Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                 <label> Create New User</label>
                </div>

                <div class="panel-body">

                  <form action="{{route('users.store')}}" method="POST">
                    {{csrf_field()}}
                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="name">Name</label>
                           <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>
                   <div class="col-md-6">
                        <div class="form-group">
                              <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" id="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="mobile">Mobile:</label>
                    <input type="text" class="form-control" name="mobile" id="mobile">
                        </div>
                    </div>

                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password"  placeholder="Manually give a password to this user">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Generate Password</label><br>
                     <input type="checkbox" name="auto_generate" value=true> Auto Generate Password<br>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                    <label for="level">Level:</label><br>
                    <select name="level" class="form-control">
                    @foreach ($roles as $role)
                    <option value="{{$role->name}}">{{$role->name}} </option>
                    @endforeach
                    </select>
                        </div>
                    </div>

                      <div class="col-md-12">
                        <div class="form-group">
                       <label for="roles">Roles:</label><br>
                    @foreach ($roles as $role)
                   <label style="margin-right: 5px;"> <input type="checkbox" name="roles[]" value="{{$role->id}}"> {{$role->display_name}}</label>
                    @endforeach
                        </div>
                    </div>

                 <div class="col-md-12 text-center">
                        <div class="form-group">
                       <button type="submit" class="btn btn-primary">Create New User</button>
                        </div>
                    </div>


                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

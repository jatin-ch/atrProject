@extends('layouts.admin')
@section('title') | Profile @endsection
@section('content')


<style type="text/css">
  .panel-info {
    border-color: #00a65a!important;
}

.panel-info>.panel-heading {
    color: #ffffff;
    background-color: #00a65a;
    border-color: #00a65a;
}
</style>
<section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">Basic</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-offset-1 col-lg-10">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title"> {{Auth::user()->basicDetail->firstname}}</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-3 col-lg-3 " align="center"> <div class="box box-primary">
              <div class="box-body box-profile">
                  @if(isset(Auth::user()->basicDetail->image))
                  <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" class="profile-user-img img-responsive img-circle">
                  @elseif(isset(Auth::user()->basicDetail))
                     @if(Auth::user()->basicDetail->gender == 'M')
                       <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsRXflGToQBiuslDfqpbRGQYbXOKS_ukUzAeoMImyCtGdpQ8Ra" class="profile-user-img img-responsive img-circle">
                     @else
                       <img src="https://cdn2.hercampus.com/jane%20doe.jpg" class="profile-user-img img-responsive img-circle">
                     @endif
                  @else
                  <img src="{{ asset('images/user.png') }}" class="profile-user-img img-responsive img-circle">
                  @endif
                  <h3 class="profile-username text-center">
                      {{Auth::user()->basicDetail->firstname}} {{Auth::user()->basicDetail->lastname}}
                  </h3>
              </div>
            </div>    </div>

              <div class="col-lg-offset-1 col-md-7 col-lg-7 ">
                <table class="table table-user-information">
                  <tbody>
                    <tr>
                      <td class="headlines">FIRST NAME:</td>
                      <td> {{Auth::user()->basicDetail->firstname}}</td>
                    </tr>
                    <tr>
                      <td class="headlines">LAST NAME:</td>
                      <td>{{Auth::user()->basicDetail->lastname}}</td>
                    </tr>
                    <tr>
                      <td class="headlines">GENDER:</td>
                      <td>
                        @if(Auth::user()->basicDetail->gender == 'M')
                        Male
                        @else
                        Female
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td class="headlines">DATE OF BIRTH:</td>
                      <td>{{date('j M Y', strtotime(Auth::user()->basicDetail->dob))}}</td>
                    </tr>
                    <tr>
                      <td class="headlines">MOBILE NUMBER:</td>
                      <td>{{Auth::user()->basicDetail->mobile}}</td>
                    </tr>
                    <tr>
                      <td class="headlines">EMAIL:</td>
                      <td><a href="mailto:info@support.com">{{Auth::user()->basicDetail->email}}</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="panel-footer">
             <a href="" data-toggle="modal" data-target="#addpop1" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>

             <div class="modal fade" id="addpop1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Profile</h4>Update your basic details
                </div>

                <div class="modal-body">
             {!! Form::model(Auth::user()->basicDetail, ['route' => ['admin.profile.update', Auth::user()->id], 'method' => 'PUT']) !!}

              <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                 {{ Form::label('firstname', 'First name') }}
                     {{ Form::text('firstname', null, ['class' => 'form-control']) }}
                              </div>
                            </div>
                             <div class="col-lg-6">
                              <div class="form-group">
                                  {{ Form::label('lastname', 'Last Name') }}
                     {{ Form::text('lastname', null, ['class' => 'form-control']) }}
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                 {{ Form::label('gender', 'Gender') }}<br>
                   <input type="radio" name="gender"  value="M" {{ Auth::user()->basicDetail->gender == 'M' ? 'checked' : '' }}>  Male
                   <input type="radio" name="gender"  value="F" {{ Auth::user()->basicDetail->gender == 'F' ? 'checked' : '' }}>  Female
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                {{ Form::label('dob', 'Date Of Birth') }}
                   {{ Form::date('dob', null, ['class' => 'form-control']) }}
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                {{ Form::label('mobile', 'Mobile') }}
                   {{ Form::text('mobile', null, ['class' => 'form-control']) }}
                              </div>
                            </div>
                             <div class="col-lg-6">
                              <div class="form-group">
                                {{ Form::label('email', 'Email Id') }}
                 {{ Form::email('email', null, ['class' => 'form-control']) }}
                              </div>
                            </div>
                            <div class="col-lg-12 text-center">
                              <div class="form-group">
                                 {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                              </div>
                            </div>
                          </div>
              </div>
             {!! Form::close() !!}
             </div>
             </div>
             </div>
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection

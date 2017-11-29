@extends('layouts.user')
@section('title') | Basic-details @endsection
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
        <li class="active">Basic Details</li>
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
                  @else
                   @if(Auth::user()->basicDetail->gender == 'M')
                     <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsRXflGToQBiuslDfqpbRGQYbXOKS_ukUzAeoMImyCtGdpQ8Ra" class="profile-user-img img-responsive img-circle">
                   @else
                     <img src="https://cdn2.hercampus.com/jane%20doe.jpg" class="profile-user-img img-responsive img-circle">
                   @endif
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
                    <tr>
                      <td class="headlines">ADDRESS:</td>
                      <td>{{Auth::user()->basicDetail->userBasic->address}}</td>
                    </tr>
                    <tr>
                      <td class="headlines">LOCALITY:</td>
                      <td style="text-transform:capitalize">{{Auth::user()->basicDetail->userBasic->locality}}</td>
                    </tr>
                    <tr>
                      <td class="headlines">COUNTRY:</td>
                      <td style="text-transform:capitalize">{{Auth::user()->basicDetail->userBasic->country}}</td>
                    </tr>
                    <tr>
                      <td class="headlines">STATE:</td>
                      <td>{{Auth::user()->basicDetail->userBasic->state}}</td>
                    </tr>
                    <tr>
                      <td class="headlines">CITY:</td>
                      <td>{{Auth::user()->basicDetail->userBasic->city}}</td>
                    </tr>
                    <tr>
                      <td class="headlines">PINCODE:</td>
                      <td>{{Auth::user()->basicDetail->userBasic->pin}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="panel-footer">
             <a href="" data-toggle="modal" data-target="#addpop1" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
             <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
             <div class="modal-dialog modal-lg">
             <div class="modal-content">
             <div class="modal-header">
             <button class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Edit</h4>
             </div>
             <div class="modal-body">
             {!! Form::model(Auth::user()->basicDetail, ['route' => ['user.basicDetails.update', Auth::user()->id], 'method' => 'PUT']) !!}
             <div class="form-group">
               <table class="table">
                 <tbody>
                   <tr>
                   <td style="border:none">
                     {{ Form::label('firstname', 'First name') }}
                     {{ Form::text('firstname', null, ['class' => 'form-control']) }}
                   </td>
                   <td style="border:none">
                     {{ Form::label('lastname', 'Last Name') }}
                     {{ Form::text('lastname', null, ['class' => 'form-control']) }}
                   </td>
                 </tr>
                 <tr>
                 <td style="border:none">
                   {{ Form::label('gender', 'Gender') }}
                   <input type="radio" name="gender"  value="M" {{ Auth::user()->basicDetail->gender == 'M' ? 'checked' : '' }}> Male
                   <input type="radio" name="gender"  value="F" {{ Auth::user()->basicDetail->gender == 'F' ? 'checked' : '' }}> Female
                 </td>
                 <td style="border:none">
                   {{ Form::label('dob', 'Date Of Birth') }}
                   {{ Form::date('dob', null, ['class' => 'form-control']) }}
                 </td>
               </tr>
                 <tr>
                 <td style="border:none">
                   {{ Form::label('mobile', 'Mobile') }}
                   {{ Form::text('mobile', null, ['class' => 'form-control']) }}
                 </td>
                 <td style="border:none">
                   {{ Form::label('email', 'Email Id') }}
                   {{ Form::email('email', null, ['class' => 'form-control']) }}
                 </td>
               </tr>
               <tr>
                 <td style="border:none">
                   {{ Form::label('address', 'ADDRESS *') }}
                   {{ Form::text('address', Auth::user()->basicdetail->userBasic->address, ['class' => 'form-control']) }}
                 </td>
                 <td style="border:none">
                   {{ Form::label('locality', 'LOCALITY') }}
                   {{ Form::text('locality', Auth::user()->basicdetail->userBasic->locality, ['class' => 'form-control']) }}
                 </td>
                </tr>
                <tr>
                  <td style="border:none">
                    {{ Form::label('country', 'COUNTRY *') }}
                    {{ Form::text('country', Auth::user()->basicdetail->userBasic->country, ['class' => 'form-control']) }}
                  </td>
                  <td style="border:none">
                    {{ Form::label('state', 'STATE *') }}
                    {{ Form::text('state', Auth::user()->basicdetail->userBasic->state, ['class' => 'form-control']) }}
                  </td>
                 </tr>
                 <tr>
                   <td style="border:none">
                     {{ Form::label('city', 'CITY *') }}
                     {{ Form::text('city', Auth::user()->basicdetail->userBasic->city, ['class' => 'form-control']) }}
                   </td>
                   <td style="border:none">
                     {{ Form::label('pin', 'PINCODE *') }}
                     {{ Form::text('pin', Auth::user()->basicdetail->userBasic->pin, ['class' => 'form-control']) }}
                   </td>
                  </tr>
                 </tbody>
               </table>

             </div>
             <div class="form-group">
               {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
              <br>
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



<script type="text/ng-template" id="EditUser.html">

<style>
.header-color{
    background-color: #00a65a!important;
}
.md-datepicker-input-container {
    width: 250px;
    margin-top:10px;
}
 .fnt18 {
        font-size: 14px !important;
    }

    .md-dialog-container {
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
    position: absolute;
    top: 0;
    left: 0!important;
    /* width: 100%; */
    height: 100%;
    z-index: 1000!important;
    overflow: hidden;
  }
  body{
    top: 0!important;
  }
</style>
<md-dialog  aria-label=''>
    <form name='userForm' id='chatform' ng-cloak novalidate>

      <md-toolbar class="header-color">
        <div class='md-toolbar-tools'>
          <h2>Update Details</h2>
          <span flex></span>
          <md-button class='md-icon-button' ng-click='cancel()'>
                        <i class='fa fa-times closeIcon'></i>
         </md-button>
        </div>
      </md-toolbar>
      <md-dialog-content>
      <section class="content">
    <form >
        <div class="row basicdetail">
            <div class="col-lg-offset-2 col-lg-8">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="lblfn">FIRST NAME </label>
                    <input type="text" ng-model="Auth::user()->basicdetail->firstname" class="form-control" placeholder="Type your first name" id="txtfn" required>
                  </div>
               </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                     <label for="lblln">LAST NAME</label>
                     <input type="text" ng-model="Auth::user()->basicdetail->lastname" class="form-control" placeholder="Type your last name" id="txtln" required>
                   </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                     <label for="lblbgender" class="mt20">GENDER</label>
                     <select ng-model="Auth::user()->basicdetail->gender" placeholder="Choose your gender" id="txtgender" class="form-control" name="locality" required>
                        <option value="" selected disabled>Choose your gender</option>
                        <option selected="{{Auth::user()->basicdetail->gender == 'M'}}" value="Male">MALE</option>
                        <option selected="{{Auth::user()->basicdetail->gender == 'F'}}" value="Female">FEMALE</option>
                     </select>
                   </div>
                 </div>
                 <div class="col-lg-6">
                  <div class="form-group">
                    <label for="lbldob" class="mt20">DATE OF BIRTH</label>
                     <md-datepicker ng-model="Auth::user()->basicdetail->dob" md-placeholder="Enter date" md-open-on-focus required></md-datepicker>
                  </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                    <label for="lblmobile" class="mt20">MOBILE NUMBER</label>
                    <input type="text" ng-model="Auth::user()->basicdetail->mobile" class="form-control" placeholder="Choose your mobile number" id="txtmobile" required>
                  </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                    <label for="lbllnumber" class="mt20">LANDLINE NUMBER</label>
                    <input type="text" ng-model="Auth::user()->basicdetail->address" class="form-control" placeholder="Type your number" id="txtlnumber">
                   </div>
                 </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                      <label for="lblemail" class="mt20">EMAIL ID </label>
                      <input type="text" ng-model="Auth::user()->basicdetail->email" class="form-control" placeholder="Type your email ID" id="txtemail" required>
                    </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                    <label for="lbllang" class="mt20">LANGUAGE SPOKEN</label>
                      <select ng-model="Auth::user()->basicdetail->locality" placeholder="Choose your spoken languages" id="txtlang" class="form-control" name="locality" required>
                        <option value="" selected disabled>Choose your spoken languages</option>
                        <option selected="{{Auth::user()->basicdetail->locality == 'English'}}" value="English">ENGLISH</option>
                        <option selected="{{Auth::user()->basicdetail->locality == 'Hindi'}}" value="Hindi">HINDI</option>
                        <option selected="{{Auth::user()->basicdetail->locality == 'Arabic'}}" value="Arabic">ARABIC</option>
                      </select>
                   </div>
                 </div>
                 <hr>
                 <div class="col-lg-6">
                    <div class="form-group">
                      <label for="lblwebsite " class="mt20">COUNTRY </label>
                      <input ng-model="Auth::user()->basicdetail->country" type="text" class="form-control" placeholder="Paste your websites url" id="txtwebsite">
                    </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                     <label for="lblfb" class="mt20">STATE</label>
                     <input type="text" ng-model="Auth::user()->basicdetail->state" class="form-control" placeholder="Paste your state url" id="txtfb">
                   </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                     <label for="lbllinkedin" class="mt20">LINKEDIN </label>
                     <input type="text" ng-model="Auth::user()->basicdetail->city" class="form-control" placeholder="Paste your city url" id="txtlinkedin">
                   </div>
                 </div>
                 <div class="col-lg-6 mt20">
                   <div class="form-group ">
                        <label>UPLOAD CV(upload only pdf & word file):</label>
                        <input class="form-control" type="file" name="file" upload-files ng-model="Auth::user()->basicdetail->myFile"/>
                   </div>
                 </div>
                 <div class="col-lg-12 mt20">
                   <div class="form-group text-center">
                        <button type="submit" ng-click="UpdateBasic(Auth::user()->basicdetail->Auth::user()->basicdetail->id)"  class="btn btn-success btnsuccess">Save & Next</button>
                   </div>
                 </div>
            </div>
        </div>
      </form>
</section>
       </md-dialog-content>
    </form>
  </md-dialog>
</script>

@endsection

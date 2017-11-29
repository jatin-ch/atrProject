@extends('layouts.user')
@section('title') | Basic-details @endsection
@section('content')
<section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">Basic Detail</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;margin-bottom: 0px;">
<section class="content">
    {!! Form::open(['route' => ['user.basicDetails.store'], 'method' => 'POST']) !!}
        <div class="row basicdetail">

            <div class="col-lg-offset-2 col-lg-8">
                <div class="col-lg-6">
                  <div class="form-group">
                    {{ Form::label('firstname', 'FIRST NAME') }}
                    {{ Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Type your first name', 'required' => '']) }}
                  </div>
               </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                     {{ Form::label('lastname', 'LAST NAME') }}
                     {{ Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Type your first name', 'required' => '']) }}
                    </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                     {{ Form::label('gender', 'GENDER', ['class' => 'mt20']) }}
                     <select name="gender" placeholder="Choose your gender" class="form-control">
                        <option value="M">MALE</option>
                        <option value="F">FEMALE</option>
                     </select>
                   </div>
                 </div>
                 <div class="col-lg-6">
                  <div class="form-group">
                    {{ Form::label('dob', 'DATE OF BIRTH', ['class' => 'mt20']) }}
                    {{ Form::date('dob', null, ['class' => 'form-control']) }}
                  </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                    {{ Form::label('mobile', 'MOBILE NUMBER', ['class' => 'mt20']) }}
                    {{ Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => '+91', 'required' => '']) }}
                  </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                     {{ Form::label('email', 'EMAIL ID', ['class' => 'mt20']) }}
                     {{ Form::email('email', Auth::user()->email, ['class' => 'form-control', 'placeholder' => 'Type your email ID', 'required' => '']) }}
                   </div>
                 </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                      {{ Form::label('address', 'ADDRESS *') }}
                      {{ Form::text('address', null, ['class' => 'form-control']) }}
                    </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                     {{ Form::label('locality', 'LOCALITY / LANDMARK *') }}
                     {{ Form::text('locality', null, ['class' => 'form-control']) }}
                   </div>
                 </div>
                 <hr>
                 <div class="col-lg-6">
                    <div class="form-group">
                      {{ Form::label('country', 'COUNTRY *') }}
                      {{ Form::text('country', null, ['class' => 'form-control']) }}
                    </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                     {{ Form::label('state', 'STATE *') }}
                     {{ Form::text('state', null, ['class' => 'form-control']) }}
                   </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group">
                     {{ Form::label('city', 'CITY *') }}
                     {{ Form::text('city', null, ['class' => 'form-control']) }}
                   </div>
                 </div>
                 <div class="col-lg-6">
                   <div class="form-group ">
                     {{ Form::label('pin', 'PINCODE *') }}
                     {{ Form::text('pin', null, ['class' => 'form-control']) }}
                   </div>
                 </div>
                 <div class="col-lg-12 mt20">
                   <div class="form-group text-center">
                        {{ Form::submit('Save & Next', ['class' => 'btn btn-success btnsuccess']) }}
                   </div>
                 </div>
            </div>
        </div>
      {!! Form::close() !!}
</section>

@endsection

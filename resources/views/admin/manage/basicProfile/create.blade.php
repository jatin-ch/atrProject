@extends('layouts.admin')
@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
          Manage Basic Profile for <strong>{{$user->name}}</strong>
        </div>

        <div class="panel-body">
          {!! Form::open(['route' => ['basicProfile.store'], 'method' => 'POST', 'files' => true, 'id' => 'createnew']) !!}
           {{ Form::hidden('user_id', $user->id) }}
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
                        {{ Form::label('landline', 'LANDLINE NUMBER', ['class' => 'mt20']) }}
                        {{ Form::text('landline', null, ['class' => 'form-control', 'placeholder' => 'Your landline number']) }}
                      </div>
                    </div>
                    <div class="col-lg-6">
                       <div class="form-group">
                         {{ Form::label('email', 'EMAIL ID') }}
                         {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Type your email ID', 'required' => '']) }}
                       </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                       {{ Form::label('language', 'LANGUAGE SPOKEN') }}
                         <select name="language" placeholder="Choose your spoken languages" class="form-control">
                           <option value="english">ENGLISH</option>
                           <option value="hindi">HINDI</option>
                         </select>
                      </div>
                    </div>
                    <hr>
                    <div class="col-lg-6">
                       <div class="form-group">
                         {{ Form::label('website', 'WEBSITE', ['class' => 'mt20']) }}
                         {{ Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Paste your websites url']) }}
                       </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        {{ Form::label('facebook', 'FACEBOOK', ['class' => 'mt20']) }}
                        {{ Form::text('facebook', null, ['class' => 'form-control', 'placeholder' => 'aste your facebook url']) }}
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        {{ Form::label('linkedin', 'LINKEDIN', ['class' => 'mt20']) }}
                        {{ Form::text('linkedin', null, ['class' => 'form-control', 'placeholder' => 'Paste your linkedin url']) }}
                      </div>
                    </div>
                    <div class="col-lg-6 mt20">
                      <div class="form-group ">
                           {{ Form::label('image', 'UPLOAD CV(upload only pdf & word file)') }}
                           {{ Form::file('image', null, ['class' => 'form-control']) }}
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
        </div>
    </div>
</div>


@endsection

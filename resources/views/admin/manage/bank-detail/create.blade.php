@extends('layouts.admin')
@section('content')
<section class="content-header">
      <h1>
         Bank Details({{$user->name}})
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Bank Details</a></li>
        <li class="active">Adviser</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                 <label> Manage Bank Details :-</label> <strong>{{$user->name}}</strong>
                </div>

                <div class="panel-body">
                  {!! Form::open(['route' => ['bank-detail.store'], 'method' => 'POST', 'id' => 'createnew']) !!}
                   {{ Form::hidden('user_id', $user->id) }}
                   <div class="row">
                     <div class="col-md-6">
                       <div class="form-group">
                          {{ Form::label('pan_number', 'Pan Number') }}
                          {{ Form::text('pan_number', null, ['class' => 'form-control']) }}
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                           {{ Form::label('gstn_number', 'GSTN Number') }}
                          {{ Form::text('gstn_number', null, ['class' => 'form-control']) }}
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                         {{ Form::label('account_holder', 'Account Holder') }}
                        {{ Form::text('account_holder', null, ['class' => 'form-control']) }}
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                           {{ Form::label('account_number', 'Account Number') }}
                        {{ Form::text('account_number', null, ['class' => 'form-control']) }}
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                         {{ Form::label('ifsc_code', 'IFSC Code') }}
                        {{ Form::text('ifsc_code', null, ['class' => 'form-control']) }}
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                         {{ Form::label('bank_name', 'Bank Name') }}
                        {{ Form::text('bank_name', null, ['class' => 'form-control']) }}
                       </div>
                     </div>
                     <div class="col-md-12">
                       <div class="form-group">
                         <label> <input type="checkbox" name="agree" value="1"> I agree with terms & conditions</label>
                       </div>
                     </div>
                      <div class="col-md-12 text-center">
                       <div class="form-group">
                         <button class="btn btn-success " onclick="document.getElementById(createnew).submit();">Submit</button>
                       </div>
                     </div>
                   </div>
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
</section>


@endsection

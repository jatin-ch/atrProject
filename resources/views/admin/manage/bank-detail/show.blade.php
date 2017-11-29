@extends('layouts.admin')
@section('content')
<section class="content-header">
      <h1>
        Bank Details({{$user->name}})
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>  Bank Details</a></li>
        <li class="active">Adviser</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <label> Manage Bank Details:-</label>  <strong>{{$user->name}}</strong>
                  <button class="btn btn-primary btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Edit</button>
                   <div class="modal fade" id="addpop1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit</h4>Edit Bank Details
                </div>
                  <div class="modal-body">
                  {!! Form::model($user->payment, ['route' => ['bank-detail.update', $user->id], 'method' => 'PUT', 'id' => 'addnew']) !!}
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
                          <button class="btn btn-success" onclick="document.getElementById(addnew).submit();">Submit</button>
                      </div>
                    </div>
                  </div>
                      {!! Form::close() !!}
                  </div>
                  </div>
                  </div>
                  </div>
                </div>

                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      <img src="{{ asset('images/' .$user->basicDetail->image) }}" style="width:150px">
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                      <label>Pan Number</label>
                      <p>{{ $user->payment['pan_number'] }}</p>
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label>Account Holder</label>
                      <p>{{ $user->payment['account_holder'] }}</p>
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="form-group">
                         <label>GSTN Number</label>
                      <p>{{ $user->payment['gstn_number'] }}</p>
                      </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                      <label>Account Number</label>
                      <p>{{ $user->payment['account_number'] }}</p>
                    </div>
                    </div>
                     <div class="col-md-6">
                       <div class="form-group">
                      <label>IFSC Code</label>
                      <p>{{ $user->payment['ifsc_code'] }}</p>
                    </div>
                    </div>
                     <div class="col-md-6">
                       <div class="form-group">
                      <label>Bank Name</label>
                      <p>{{ $user->payment['bank_name'] }}</p>
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

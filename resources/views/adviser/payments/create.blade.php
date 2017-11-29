@extends('layouts.adviser')
@section('title') | Bank-details @endsection
@section('content')



<script>
 $('input').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
</script>
<section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">Payment Detail</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
    {!! Form::open(['route' => ['adviser.payments.store'], 'method' => 'POST']) !!}
        <div class="row basicdetail">
            <div class="col-lg-offset-2 col-lg-8">
                <div class="col-lg-6">
                  <div class="form-group">
                    {{ Form::label('pan_number', 'PAN NUMBER') }}
                    {{ Form::text('pan_number', null, ['class' => 'form-control', 'placeholder' => 'Type your pan number']) }}
                  </div>
               </div>

               <div class="col-lg-6">
                 <div class="form-group">
                   {{ Form::label('gstn_number', 'GSTN NUMBER') }}
                   {{ Form::number('gstn_number', null, ['class' => 'form-control', 'placeholder' => 'Type your gstn number']) }}
                </div>
               </div>

               <div class="col-lg-6">
                 <div class="form-group ">
                   {{ Form::label('account_holder', 'BANK ACCOUNT HOLDER\'S NAME') }}
                   {{ Form::text('account_holder', null, ['class' => 'form-control', 'placeholder' => 'Type your name']) }}
                </div>
               </div>

               <div class="col-lg-6">
                 <div class="form-group">
                   {{ Form::label('account_number', 'BANK ACCOUNT NUMBER/IBAN') }}
                   {{ Form::number('account_number', null, ['class' => 'form-control', 'placeholder' => 'Type your account number']) }}
                </div>
               </div>



               <div class="col-lg-6">
                  <div class="form-group">
                    {{ Form::label('ifsc_code', 'SWIFT/IFSC CODE') }}
                    {{ Form::text('ifsc_code', null, ['class' => 'form-control', 'placeholder' => 'Type your bank IFSC code']) }}
                </div>
               </div>

               <div class="col-lg-6">
                 <div class="form-group">
                   {{ Form::label('bank_name', 'BANK NAME IN FULL') }}
                   {{ Form::text('bank_name', null, ['class' => 'form-control', 'placeholder' => 'Type your bank name']) }}
                </div>
               </div>

                <div class="col-lg-12 checkbox" style="padding-left: 0px!important">
                <label class="checkbox-inline"><input type="checkbox" name="agree" value="1"> I confirm that bank account detail provided is right & adviceli can send me money in this account</label>
                 </div>
           <div class="col-lg-12 mb10 text-center">
             {{ Form::submit('Save & Next', ['class' => 'btn btn-success btnsuccess']) }}
          </div>
            </div>
        </div>
    {{ Form::close() }}
</section>


@endsection

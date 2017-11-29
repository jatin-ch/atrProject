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
  <div class="row">
   <div class="col-lg-offset-1 col-lg-10">
        <div class="panel panel-info">
          <div class="panel-heading" style="padding: 15px">
            <h3 class="panel-title"> Payment Details</h3>
            <a href="" style="margin-top: -22px;" title="Edit" data-toggle="modal" data-target="#addpop1" type="button" class="btn pull-right btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-offset-1 col-md-7 col-lg-7 ">
                <table class="table table-user-information">
                  <tbody>
                    <tr>
                      <td class="headlines">PAN NUMBER:</td>
                      <td> {{ Auth::user()->payment['gstn_number'] }}</td>
                    </tr>
                    <tr>
                      <td class="headlines">Account Holder:</td>
                      <td>{{ Auth::user()->payment['account_holder'] }}</td>
                    </tr>
                    <tr>
                      <td class="headlines">GSTN NUMBER:</td>
                      <td>
                       {{ Auth::user()->payment['gstn_number'] }}
                      </td>
                    </tr>
                    <tr>
                      <td class="headlines">BANK ACCOUNT NUMBER/IBAN:</td>
                      <td>{{ Auth::user()->payment['account_number'] }}</td>
                    </tr>
                    <tr>
                      <td class="headlines">SWIFT/IFSC CODE:</td>
                      <td>{{ Auth::user()->payment['ifsc_code'] }}</td>
                    </tr>
                    <tr>
                      <td class="headlines">BANK FULL NAME:</td>
                      <td>{{ Auth::user()->payment['bank_name'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>







    <div class="col-md-2 col-md-offset-5">
      <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
      <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-header">
      <button class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Edit Bank Details</h4>
      </div>
      <div class="modal-body">
        {!! Form::model(Auth::user()->payment, ['route' => ['adviser.payments.update', Auth::user()->id], 'method' => 'PUT']) !!}
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
               <div class="col-lg-12 mb10 text-center">
                 {{ Form::submit('Save', ['class' => 'btn btn-success btnsuccess']) }}
              </div>
                </div>
            </div>
        {{ Form::close() }}
      </div>
      </div>
      </div>
      </div>
    </div>
  </div>
</section>


@endsection

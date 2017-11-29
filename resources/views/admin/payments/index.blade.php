@extends('layouts.app')
@section('content')

<!-- <div class="container">
    <div class="row"> -->
        <div class="col-md-11">
          @if(isset(Auth::user()->payment))
            <div class="panel panel-default">
                <div class="panel-heading">
                  Manage Bank Details for <strong>{{Auth::user()->name}}</strong>
                  <button class="btn btn-primary btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Edit</button>
                  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  <div class="modal-header">
                  <button class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit</h4>
                  </div>
                  <div class="modal-body">
                  {!! Form::model(Auth::user()->payment, ['route' => ['payments.update', Auth::user()->id], 'method' => 'PUT', 'id' => 'addnew']) !!}
                  <div class="form-group">
                    <table class="table">
                      <tbody>
                        <tr>
                        <td style="border:none">
                          {{ Form::label('pan_number', 'Pan Number') }}
                          {{ Form::text('pan_number', null, ['class' => 'form-control']) }}
                        </td>
                        <td style="border:none">
                          {{ Form::label('gstn_number', 'GSTN Number') }}
                          {{ Form::text('gstn_number', null, ['class' => 'form-control']) }}
                        </td>
                      </tr>
                      <tr>
                      <td style="border:none">
                        {{ Form::label('account_holder', 'Account Holder') }}
                        {{ Form::text('account_holder', null, ['class' => 'form-control']) }}
                      </td>
                      <td style="border:none">
                        {{ Form::label('account_number', 'Account Number') }}
                        {{ Form::text('account_number', null, ['class' => 'form-control']) }}
                      </td>
                    </tr>
                      <tr>
                      <td style="border:none">
                        {{ Form::label('ifsc_code', 'IFSC Code') }}
                        {{ Form::text('ifsc_code', null, ['class' => 'form-control']) }}
                      </td>
                      <td style="border:none">
                        {{ Form::label('bank_name', 'Bank Name') }}
                        {{ Form::text('bank_name', null, ['class' => 'form-control']) }}
                      </td>
                       </tr>
                      </tbody>
                     </table>
                      <button class="btn btn-primary btn-sm" onclick="document.getElementById(addnew).submit();">Submit</button>
                     </div>
                      {!! Form::close() !!}
                  </div>
                  </div>
                  </div>
                  </div>
                </div>

                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-2">
                      @if(isset(Auth::user()->basicDetail->image))
                      <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" style="width:130px">
                      @else
                       @if(Auth::user()->basicDetail->gender == 'M')
                         <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsRXflGToQBiuslDfqpbRGQYbXOKS_ukUzAeoMImyCtGdpQ8Ra" style="width:130px">
                       @else
                         <img src="https://cdn2.hercampus.com/jane%20doe.jpg" style="width:130px">
                       @endif
                      @endif
                    </div>
                    <div class="col-md-2">
                      <small>Pan Number</small>
                      <p><strong>{{ Auth::user()->payment['pan_number'] }}</strong></p>
                      <small>Account Holder</small>
                      <p><strong>{{ Auth::user()->payment['account_holder'] }}</strong></p>
                    </div>
                    <div class="col-md-2">
                      <small>GSTN Number</small>
                      <p><strong>{{ Auth::user()->payment['gstn_number'] }}</strong></p>
                      <small>Account Number</small>
                      <p><strong>{{ Auth::user()->payment['account_number'] }}</strong></p>  <small></small>
                    </div>
                    <div class="col-md-2">
                      <small>IFSC Code</small>
                      <p><strong>{{ Auth::user()->payment['ifsc_code'] }}</strong></p>
                      <small>Bank Name</small>
                      <p><strong>{{ Auth::user()->payment['bank_name'] }}</strong></p>
                    </div>
                    <div class="col-md-2">

                    </div>
                  </div>
                </div>
            </div>

            @else
            <div class="panel panel-default">
                <div class="panel-heading">
                  Add Bank Details for <strong>{{Auth::user()->name}}</strong>
                </div>

                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                      <button class="btn btn-primary btn-sm pull-right" data-target="#addpop2" data-toggle="modal">Create</button>
                      <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop2" tabindex="-1">
                      <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                      <div class="modal-header">
                      <button class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Create here</h4>
                      </div>
                      <div class="modal-body">
                      {!! Form::open(['route' => ['payments.store'], 'method' => 'POST', 'id' => 'createnew']) !!}
                      <div class="form-group">
                        <table class="table">
                          <tbody>
                            <tr>
                            <td style="border:none">
                              {{ Form::label('pan_number', 'Pan Number') }}
                              {{ Form::text('pan_number', null, ['class' => 'form-control']) }}
                            </td>
                            <td style="border:none">
                              {{ Form::label('gstn_number', 'GSTN Number') }}
                              {{ Form::text('gstn_number', null, ['class' => 'form-control']) }}
                            </td>
                          </tr>
                          <tr>
                          <td style="border:none">
                            {{ Form::label('account_holder', 'Account Holder') }}
                            {{ Form::text('account_holder', null, ['class' => 'form-control']) }}
                          </td>
                          <td style="border:none">
                            {{ Form::label('account_number', 'Account Number') }}
                            {{ Form::text('account_number', null, ['class' => 'form-control']) }}
                          </td>
                        </tr>
                          <tr>
                          <td style="border:none">
                            {{ Form::label('ifsc_code', 'IFSC Code') }}
                            {{ Form::text('ifsc_code', null, ['class' => 'form-control']) }}
                          </td>
                          <td style="border:none">
                            {{ Form::label('bank_name', 'Bank Name') }}
                            {{ Form::text('bank_name', null, ['class' => 'form-control']) }}
                          </td>
                           </tr>
                          </tbody>
                        </table>
                        <input type="checkbox" name="agree" value="1"> I agree with terms & conditions
                        <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(createnew).submit();">Submit</button>
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
            @endif
        </div>
    <!-- </div>
</div> -->

@endsection

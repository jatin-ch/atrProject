@extends('layouts.app')
@section('content')

<!-- <div class="container">
    <div class="row"> -->
        <div class="col-md-11">
          @if(isset(Auth::user()->verification))
            <div class="panel panel-default">
                <div class="panel-heading">
                  Verification Details
                  <button class="btn btn-primary btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Edit</button>
                  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  <div class="modal-header">
                  <button class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit</h4>
                  </div>
                  <div class="modal-body">
                  {!! Form::model(Auth::user()->verification, ['route' => ['payments.update', Auth::user()->id], 'method' => 'PUT', 'files' => 'true', 'id' => 'addnew']) !!}
                  <div class="form-group">
                    <table class="table">
                      <tbody>
                        <tr>
                        <td style="border:none">

                        </td>
                        <td style="border:none">

                        </td>
                      </tr>
                      <tr>
                      <td style="border:none">

                      </td>
                      <td style="border:none">

                      </td>
                    </tr>
                      <tr>
                      <td style="border:none">

                      </td>
                      <td style="border:none">

                      </td>
                       </tr>
                      </tbody>
                     </table>
                      <!-- <button class="btn btn-primary btn-sm" onclick="document.getElementById(addnew).submit();">Submit</button> -->
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
                      <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" style="width:150px">
                    </div>
                    <div class="col-md-2">
                      <small>Qualification Letter</small>
                      <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->qualification) }}">Download</a></strong></p>
                      <small>College Degree</small>
                      <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->degree) }}">Download</a></strong></p>
                    </div>
                    <div class="col-md-2">
                      <small>Govt. Auth. Letter</small>
                      <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->govt_auth_letter) }}">Download</a></strong></p>
                      <small>Award Certificate</small>
                      <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->award_certi) }}">Download</a></strong></p>
                    </div>
                    <div class="col-md-2">
                      <small>Experience Letter</small>
                      <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->exp_letter) }}">Download</a></strong></p>
                      <small>Id Proof</small>
                      <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->id_proof) }}">Download</a></strong></p>
                    </div>
                    <div class="col-md-2">
                      <small>Aadhar Card</small>
                      <p><strong><a href="{{ asset('uploads/'. Auth::user()->verification->aadhar_card) }}">Download</a></strong></p>
                    </div>
                  </div>
                </div>
            </div>

            @else
            <div class="panel panel-default">
                <div class="panel-heading">
                  Add Your Verification Documents
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
                      <h4 class="modal-title">Upload here</h4>
                      </div>
                      <div class="modal-body">
                    {!! Form::open(['route' => ['verifications.store'], 'method' => 'POST', 'files' => true]) !!}
                      <div class="form-group">
                        <table class="table">
                          <tbody>
                            <tr>
                            <td style="border:none">
                              {{ Form::label('qualification', 'QUALIFICATION CERTIFICATE (Only pdf) *', ['style' => 'margin-top:20px']) }}
                              {{ Form::file('qualification') }}
                            </td>
                            <td style="border:none">
                              {{ Form::label('degree', 'COLLEGE DEGREE (Only pdf) *', ['style' => 'margin-top:20px']) }}
                              {{ Form::file('degree') }}
                            </td>
                          </tr>
                          <tr>
                          <td style="border:none">
                            {{ Form::label('govt_auth_letter', 'GOVT. AUTHEORIZE LETTER (Only pdf) *', ['style' => 'margin-top:20px']) }}
                            {{ Form::file('govt_auth_letter') }}
                          </td>
                          <td style="border:none">
                            {{ Form::label('award_certi', 'AWARD CERTIFICATE (Only pdf)', ['style' => 'margin-top:20px']) }}
                            {{ Form::file('award_certi') }}
                          </td>
                        </tr>
                          <tr>
                          <td style="border:none">
                            {{ Form::label('exp_letter', 'EXPERIENCE LETTER (Only pdf)', ['style' => 'margin-top:20px']) }}
                            {{ Form::file('exp_letter') }}
                          </td>
                          <td style="border:none">
                            {{ Form::label('id_proof', 'ID PROOF (Only jpeg) *', ['style' => 'margin-top:20px']) }}
                            {{ Form::file('id_proof') }}
                          </td>
                           </tr>
                           <tr>
                           <td style="border:none">
                             {{ Form::label('aadhar_card', 'AADHAR CARD (Only jpeg) *', ['style' => 'margin-top:20px']) }}
                             {{ Form::file('aadhar_card') }}
                           </td>
                           <td style="border:none">

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

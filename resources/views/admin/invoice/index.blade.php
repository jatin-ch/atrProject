@extends('layouts.app')
@section('content')

<!-- <div class="container">
    <div class="row"> -->
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">
                  All service
                </div>

                <div class="panel-body">
                  <div class="row">
                    @foreach($services as $service)
                    <div class="col-md-4">
                      <div class="panel panel-primary">
                          <div class="panel-heading" style="text-transform:uppercase">
                            {{ $service->name }}
                          </div>
                          <div class="panel-body" style="height:260px;overflow-y:scroll">
                            <strong>Benifits / Packages of the Service</strong>
                            <ul>
                              @foreach($service->benifits as $benifit)
                              <li>{{$benifit->benifit}}</li>
                              @endforeach
                            </ul>

                            <strong>Package / Service Includes</strong>
                            <ul>
                              @foreach($service->packages as $include)
                              <li>{{$include->include}}</li>
                              @endforeach
                            </ul>
                            <p><strong>Service Time / duration</strong> : {{$service->duration}} min</p>
                            <p><strong>Frequency</strong> : {{ $service->frequency }}, <strong>Validity</strong> : {{ $service->validity }} days</p>

                            <p><strong>Price</strong> :
                              @if($service->commision)
                              <span style='text-decoration:line-through'>INR {{ $service->payout }}/-</span> INR {{ $service->payout }}/-
                              @else
                              INR {{ $service->payout }}/-
                              @endif
                            </p>

                          </div>
                          <div class="panel-footer">
                            <button class="btn btn-default btn-sm" data-target="#sl1{{$service->id}}" data-toggle="modal">Edit</button>
                           <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl1{{$service->id}}" tabindex="-1">
                           <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                           <div class="modal-header">
                           <button class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">Edit Location</h4>
                           </div>
                           <div class="modal-body">
                            {!! Form::model($service, ['route' => ['services.update', $service->id], 'method' => 'PUT', 'files' => 'true', 'id' => 'sf1'.$service->id]) !!}
                            <div class="form-group">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td style="border:none">
                                      {{ Form::label('name', 'Name of the Service') }}
                                      {{ Form::text('name', null, ['class' => 'form-control']) }}
                                    </td>
                                    <td>
                                        <label>Timeline *:</label>
                                         Active: <input type="radio" class="flat" name="timeline" value="1" {{ $service->timeline == '1' ? "checked" : "" }}>
                                         Inactive: <input type="radio" class="flat" name="timeline" value="0" {{ $service->timeline == '0' ? "checked" : "" }}>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td style="border:none">
                                      {{ Form::label('duration', 'Duration') }}
                                      <select name="duration" class="form-control">
                                        <option value="15" {{$service->duration=='15'?'selected':''}}>15 min</option> <option value="30" {{$service->duration=='30'?'selected':''}}>30 min</option>
                                        <option value="45" {{$service->duration=='45'?'selected':''}}>45 min</option> <option value="60" {{$service->duration=='60'?'selected':''}}>60 min</option>
                                      </select>
                                    </td>
                                    <td style="border:none">
                                      {{ Form::label('validity', 'Validity') }}
                                      <select name="validity" class="form-control">
                                        <option value="15" {{$service->validity=='15'?'selected':''}}>15 days</option> <option value="30" {{$service->validity=='30'?'selected':''}}>30 days</option>
                                        <option value="45" {{$service->validity=='45'?'selected':''}}>45 days</option> <option value="60" {{$service->validity=='60'?'selected':''}}>60 days</option>
                                      </select>
                                    </td>
                                    <td style="border:none">
                                      {{ Form::label('frequency', 'Frequency') }}
                                      <select name="frequency" class="form-control">
                                        <option value="1" {{$service->frequency=='1'?'selected':''}}>1</option> <option value="2" {{$service->frequency=='2'?'selected':''}}>2</option>
                                        <option value="3" {{$service->frequency=='3'?'selected':''}}>3</option> <option value="4" {{$service->frequency=='4'?'selected':''}}>4</option>
                                      </select>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="border:none">
                                      {{ Form::label('price', 'Price') }}
                                      {{ Form::text('price', null, ['class' => 'form-control', 'id' => 'field1']) }}
                                    </td>
                                    <td style="border:none">
                                      {{ Form::label('commision', 'Commision') }}
                                      {{ Form::text('commision', null, ['class' => 'form-control', 'id' => 'field2']) }}
                                    </td>
                                    <td style="border:none">
                                      {{ Form::label('payout', 'Total Payout') }}
                                      {{ Form::text('payout', null, ['class' => 'form-control', 'id' => 'field3', 'readonly' => '']) }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="border:none"></td>
                                    <td style="border:none"></td>
                                  </tr>
                                </tbody>
                              </table>

                              {{ Form::label('details', 'Details (optional)') }}
                              {{ Form::textarea('details', null, ['class' => 'form-control', 'rows' => '3']) }}

                              {{ Form::label('consultations', 'Select Consultation Type', ['style' => 'margin-top:20px']) }}
                              @foreach($consultations as $consultation)
                              <input type="checkbox" name="consultations[]" value="{{$consultation->id}}"> {{$consultation->mode}}
                              @endforeach
                              <br>

                              <label style="margin-top:20px">Is physical visit of client is Mandatory ? </label>
                              <input type="radio" class="flat" name="presence" value="1" checked="" required /> Yes
                              <input type="radio" class="flat" name="presence"  value="0" /> No
                              <br>

                              {{ Form::label('image', 'Cover Picture', ['style' => 'margin-top:20px']) }}
                              {{ Form::file('image') }}

                              <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(sf1{{ $service->id }}).submit();">Submit</button>
                             <br>
                            </div>
                           {!! Form::close() !!}
                           </div>
                           </div>
                           </div>
                           </div>

                           <div class="pull-right">
                           {!! Form::open(['route' => ['services.destroy', $service->id], 'method' => 'DELETE', 'id' => 'dl'.$service->id]) !!}
                            {{ Form::submit('Delete', ['class' => 'btn btn-default btn-sm', 'style' => 'color:#a00;cursor:pointer']) }}
                           {!! Form::close() !!}
                         </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                    </div>
                  </div>
            </div>
        </div>
    <!-- </div>
</div> -->

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {

    $("#field1").keyup(function(){
          $("#field3").val($("#field1").val() - $("#field2").val());
    });
    $("#field2").keyup(function(){
          $("#field3").val($("#field1").val() - $("#field2").val());
    });


});
</script

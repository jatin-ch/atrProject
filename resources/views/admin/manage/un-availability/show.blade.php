@extends('layouts.admin')
@section('content')
<section class="content-header">
      <h1>
         Un-Availabilities({{$user->name}})
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Un-Availabilities</a></li>
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
                <label> Manage Un-Availabilities:-</label>  <strong>{{$user->name}}</strong>
                  <button class="btn btn-success btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Add New</button>
                <div class="modal fade" id="addpop1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Un-Availabilities</h4>Add New Un-Availabilities
                </div>
                 <div class="modal-body">
                  {!! Form::open(['route' => ['un-availability.store'], 'method' => 'POST', 'id' => 'addnew']) !!}
                  {{ Form::hidden('user_id', $user->id) }}

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        {{ Form::label('from_date', 'From Date') }}
                            {{ Form::date('from_date', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        {{ Form::label('from_time', 'From Time') }}
                            {{ Form::time('from_time', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         {{ Form::label('to_date', 'To Date') }}
                            {{ Form::date('to_date', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         {{ Form::label('to_time', 'To Time') }}
                            {{ Form::time('to_time', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label >Un-availability for </label><br>
                       <label><input type="radio" name="service" value="service" checked="" required /> Service</label>
                      <label> <input type="radio" name="service" value="consultation" required /> Consultation</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label >Consultation Mode</label><br>
                    @foreach($consultations as $consultation)
                     <label><input type="checkbox" name="consultations[]" value="{{ $consultation->id }}"> {{ $consultation->mode }}</label>
                    @endforeach
                    
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                         <label><input type="checkbox" name="off_all" value="1"  /> OFF FOR ALL BOOKINGS</label>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
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
                  <div class="table-responsive">
                  <table class="table">
                              <thead>
                                <tr>
                                 <!--  <th>id</th> -->
                                  <th>From</th>
                                  <th>To</th>
                                  <th>Day</th>
                                  <th>Un-Available for</th>
                                  <th>Mode</th>
                                  <th></th>
                                  <th></th>
                                </tr>
                              </thead>

                              <tbody>
                                @foreach ($user->unavailabilities as $unavailability)
                                  <tr>
                                    <!-- <th>{{ $unavailability->id }}</th> -->
                                    <td>{{ date('D, jS M Y', strtotime($unavailability->from_date)) }}, {{ date('h:i A', strtotime($unavailability->from_time)) }}</td>
                                    <td>{{ date('D, jS M Y', strtotime($unavailability->to_date)) }}, {{ date('h:i:s A', strtotime($unavailability->to_time)) }}</td>
                                    <td>{{ $unavailability->days }}</td>
                                    <td>{{ $unavailability->service }}</td>
                                    <td>
                                      @if($unavailability->off_all == '1')
                                      All
                                      @endif
                                      @foreach($unavailability->consultations as $consultation)
                                      {{ $consultation->mode }},
                                      @endforeach
                                    </td>
                                    <td>
                                     <button class="btn btn-success btn-sm" data-target="#sl2{{$unavailability->id}}" data-toggle="modal">View</button>
                                    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl2{{$unavailability->id}}" tabindex="-1">
                                    <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <button class="close" data-dismiss="modal">&times;</button>
                                    <p class="modal-title">Un-Availability for : <strong>{{ $unavailability->service }}</strong></p>
                                    </div>
                                    <div class="modal-body">
                                    <p>From : <strong>{{ date('D, jS M Y', strtotime($unavailability->from_date)) }}, {{ date('h:i A', strtotime($unavailability->from_time)) }}</strong></p>
                                    <p>To : <strong>{{ date('D, jS M Y', strtotime($unavailability->to_date)) }}, {{ date('h:i A', strtotime($unavailability->to_time)) }}</strong></p>
                                    <p>Un-Available for (day/days) : <strong>{{ $unavailability->days }}</strong></p>
                                    <p>Un-Availability Mode :
                                      <strong>
                                      @if($unavailability->off_all == '1')
                                      All
                                      @endif
                                      @foreach($unavailability->consultations as $consultation)
                                      {{ $consultation->mode }} |
                                      @endforeach
                                    </strong>
                                    </p>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                     <button class="btn btn-warning btn-sm" data-target="#sl1{{$unavailability->id}}" data-toggle="modal">Edit</button>
                                     <div class="modal fade" id="sl1{{$unavailability->id}}" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Un-Availabilities</h4>
                </div>
                                    <div class="modal-body">
                                     {!! Form::model($unavailability, ['route' => ['un-availability.update', $unavailability->id], 'method' => 'PUT', 'id' => 'sf1'.$unavailability->id]) !!}
                                     <div class="row">
                                       <div class="col-md-6">
                                         <div class="form-group">
                                            {{ Form::label('from_date', 'From Date') }}
                                               {{ Form::date('from_date', null, ['class' => 'form-control']) }}
                                         </div>
                                       </div>
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             {{ Form::label('from_time', 'From Time') }}
                                               {{ Form::time('from_time', null, ['class' => 'form-control']) }}
                                         </div>
                                       </div>
                                       <div class="col-md-6">
                                         <div class="form-group">
                                             {{ Form::label('to_date', 'To Date') }}
                                               {{ Form::date('to_date', null, ['class' => 'form-control']) }}
                                         </div>
                                       </div>
                                       <div class="col-md-6">
                                         <div class="form-group">
                                            {{ Form::label('to_time', 'To Time') }}
                                               {{ Form::time('to_time', null, ['class' => 'form-control']) }}
                                         </div>
                                       </div>
                                       <div class="col-md-6">
                                         <div class="form-group">
                                             <label >Un-Availability For </label><br>
                                         <label>  <input type="radio" name="service" value="service" {{$unavailability->service == 'service' ? 'checked' : ''}} required /> Service </label>
                                           <label><input type="radio" name="service" value="consultation" {{$unavailability->service == 'consultation' ? 'checked' : ''}}> Consultation </label>
                                         </div>
                                       </div>
                                       <div class="col-md-6">
                                         <div class="form-group">
                                            <label >Consultation Mode</label><br>
                                       @foreach($consultations as $consultation)
                                        <label> <input type="checkbox" name="consultations[]" value="{{ $consultation->id }}">  {{ $consultation->mode }}</label>
                                       @endforeach
                                         </div>
                                       </div>
                                       <div class="col-md-12">
                                         <div class="form-group">
                                           <label> <input type="checkbox" name="off_all" value="1"  {{$unavailability->off_all == '1' ? 'checked' : ''}}>  OFF FOR ALL BOOKINGS</label>
                                         </div>
                                       </div>
                                       <div class="col-md-12">
                                         <div class="col-md-12">
                                            <button class="btn btn-success btn-sm pull-right" onclick="document.getElementById(sf1{{ $unavailability->id }}).submit();">Save</button>
                                         </div>
                                       </div>
                                     </div>
                                    {!! Form::close() !!}
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                       {!! Form::open(['route' => ['un-availability.destroy', $unavailability->id], 'method' => 'DELETE', 'id' => 'dl'.$unavailability->id]) !!}
                                       {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'style' => 'cursor:pointer']) }}
                                       {!! Form::close() !!}
                                     </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection

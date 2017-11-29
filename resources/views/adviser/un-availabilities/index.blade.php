@extends('layouts.adviser')
@section('title') | Un-availability @endsection
@section('content')
<section class="content-header">
    <h1>
        Un-Availability
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Un-Availability</a></li>
       <!--  <li class="active"></li> -->
    </ol>
</section>
<hr>
<section class="content">
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
         <label>Manage Un-Availabilities</label>
          <button class="btn btn-primary btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Add New</button>

          <!-- Add Modal -->

      <div class="modal fade" id="addpop1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Un-Availabilty</h4>
                </div>
                <div class="modal-body">
                 {!! Form::open(['route' => ['un-availabilities.store'], 'method' => 'POST', 'id' => 'addnew']) !!}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                 {{ Form::label('from_date', 'From Date') }}
                                 {{ Form::date('from_date', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                 {{ Form::label('from_time', 'From Time') }}
                                 {{ Form::time('from_time', null, ['class' => 'form-control']) }}
                                </div>
                            </div>

                             <div class="col-lg-6">
                                <div class="form-group">
                                  {{ Form::label('to_date', 'To Date') }}
                                  {{ Form::date('to_date', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  {{ Form::label('to_time', 'To Time') }}
                                  {{ Form::time('to_time', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                               <div class="form-group">
                                    <label >Un-availability For :</label><br />
                                   <label> <input type="radio" name="service" value="service" checked="" required />  Service</label>
                    <label><input type="radio" name="service" value="consultation" required />  Consultation</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label>Consultation Mode </label><br>
                              @foreach($consultations as $consultation)
                               <label><input type="checkbox" name="consultations[]" value="{{ $consultation->id }}">  {{ $consultation->mode }}</label>
                               @endforeach
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label></label>
                               <label> <input type="checkbox" name="off_all" value="1" />  OFF FOR ALL BOOKINGS</label>
                              </div>
                            </div>
                              <div class="col-lg-12">
                                <div class="text-center">
                                  <button class="btn btn-success btn-sm" onclick="document.getElementById(addnew).submit();">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

               <!-- Add Modal end -->


         <!-- <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
         <div class="modal-dialog modal-lg">
         <div class="modal-content">
         <div class="modal-header">
         <button class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Add New Un-availability</h4>
         </div>
         <div class="modal-body">
          {!! Form::open(['route' => ['un-availabilities.store'], 'method' => 'POST', 'id' => 'addnew']) !!}
          <div class="form-group">
            <table class="table">
              <tbody>
                <tr>
                  <td style="border:none">
                    {{ Form::label('from_date', 'From Date') }}
                    {{ Form::date('from_date', null, ['class' => 'form-control']) }}
                  </td>
                  <td style="border:none">
                    {{ Form::label('from_time', 'From Time') }}
                    {{ Form::time('from_time', null, ['class' => 'form-control']) }}
                  </td>
                </tr>
                <tr>
                  <td style="border:none">
                    {{ Form::label('to_date', 'To Date') }}
                    {{ Form::date('to_date', null, ['class' => 'form-control']) }}
                  </td>
                  <td style="border:none">
                    {{ Form::label('to_time', 'To Time') }}
                    {{ Form::time('to_time', null, ['class' => 'form-control']) }}
                  </td>
                </tr>
              </tbody>
            </table>

            <label style="margin-top:20px">Un-availability for </label>
               <input type="radio" name="service" value="service" checked="" required />Service
               <input type="radio" name="service" value="consultation" required />Consultation
               <br>

            <label style="margin-top:20px">Consultation Mode</label>
            @foreach($consultations as $consultation)
              <input type="checkbox" name="consultations[]" value="{{ $consultation->id }}"> {{ $consultation->mode }}
            @endforeach
            <br>
            <input type="checkbox" name="off_all" value="1" style="margin-top:20px" />OFF FOR ALL BOOKINGS
            <br>
            </div>
         <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(addnew).submit();">Submit</button>
         <br>
         {!! Form::close() !!}
         </div>
         </div>
         </div>
         </div> -->


        </div>

        <div class="panel-body">
          <table class="table">
                      <thead>
                        <tr>
                          <th>From</th>
                          <th>To</th>
                          <th>Day</th>
                          <th>Un-available for</th>
                          <th>Mode</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach ($unavailabilities as $unavailability)
                          <tr>
                            <td>{{ date('D, jS M Y', strtotime($unavailability->from_date)) }}, {{ date('h:i A', strtotime($unavailability->from_time)) }}</td>
                            <td>{{ date('D, jS M Y', strtotime($unavailability->to_date)) }}, {{ date('h:i A', strtotime($unavailability->to_time)) }}</td>
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
                             <button class="btn btn-default btn-sm" data-target="#sl2{{$unavailability->id}}" data-toggle="modal">View</button>
                            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl2{{$unavailability->id}}" tabindex="-1">
                            <div class="modal-dialog modal-md">
                            <div class="modal-content">
                            <div class="modal-header">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <p class="modal-title">Un-availability for : <strong>{{ $unavailability->service }}</strong></p>
                            </div>
                            <div class="modal-body">
                            <p>From : <strong>{{ date('D, jS M Y', strtotime($unavailability->from_date)) }}, {{ date('h:i A', strtotime($unavailability->from_time)) }}</strong></p>
                            <p>To : <strong>{{ date('D, jS M Y', strtotime($unavailability->to_date)) }}, {{ date('h:i A', strtotime($unavailability->to_time)) }}</strong></p>
                            <p>Un-available for (day/days) : <strong>{{ $unavailability->days }}</strong></p>
                            <p>Un-availability Mode :
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
                             <button class="btn btn-default btn-sm" data-target="#sl1{{$unavailability->id}}" data-toggle="modal"><i class="fa fa-edit"></i></button>

                               <!-- Add Modal -->

      <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl1{{$unavailability->id}}"  role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Un-Availabilty</h4>
                </div>
                <div class="modal-body">
                {!! Form::model($unavailability, ['route' => ['un-availabilities.update', $unavailability->id], 'method' => 'PUT', 'id' => 'sf1'.$unavailability->id]) !!}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                {{ Form::label('from_date', 'From Date') }}
                                       {{ Form::date('from_date', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  {{ Form::label('from_time', 'From Time') }}
                                       {{ Form::time('from_time', null, ['class' => 'form-control']) }}
                                </div>
                            </div>

                             <div class="col-lg-6">
                                <div class="form-group">
                                  {{ Form::label('to_date', 'To Date') }}
                                       {{ Form::date('to_date', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                   {{ Form::label('to_time', 'To Time') }}
                                       {{ Form::time('to_time', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                               <div class="form-group">
                                    <label >Un-availability For :</label><br />
                                   <label> <input type="radio" name="service" value="service" {{$unavailability->service == 'service' ? 'checked' : ''}} required />  Service</label>
                    <label><input type="radio" name="service" value="consultation" {{$unavailability->service == 'consultation' ? 'checked' : ''}}>  Consultation</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label>Consultation Mode </label><br>
                              @foreach($consultations as $consultation)
                               <label> <input type="checkbox" name="consultations[]" value="{{ $consultation->id }}"> {{ $consultation->mode }}</label>
                               @endforeach
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label></label>
                               <label>  <input type="checkbox" name="off_all" value="1" style="margin-top:20px" {{$unavailability->off_all == '1' ? 'checked' : ''}}> OFF FOR ALL BOOKINGS</label>
                              </div>
                            </div>
                              <div class="col-lg-12">
                                <div class="text-center">
                                  <button class="btn btn-success btn-sm" onclick="document.getElementById(sf1{{ $unavailability->id }}).submit();">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

               <!-- Edit Modal end -->




<!--
                            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl1{{$unavailability->id}}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Un-availability</h4>
                            </div>
                            <div class="modal-body">
                             {!! Form::model($unavailability, ['route' => ['un-availabilities.update', $unavailability->id], 'method' => 'PUT', 'id' => 'sf1'.$unavailability->id]) !!}
                             <div class="form-group">
                               <table class="table">
                                 <tbody>
                                   <tr>
                                     <td style="border:none">
                                       {{ Form::label('from_date', 'From Date') }}
                                       {{ Form::date('from_date', null, ['class' => 'form-control']) }}
                                     </td>
                                     <td style="border:none">
                                       {{ Form::label('from_time', 'From Time') }}
                                       {{ Form::time('from_time', null, ['class' => 'form-control']) }}
                                     </td>
                                   </tr>
                                   <tr>
                                     <td style="border:none">
                                       {{ Form::label('to_date', 'To Date') }}
                                       {{ Form::date('to_date', null, ['class' => 'form-control']) }}
                                     </td>
                                     <td style="border:none">
                                       {{ Form::label('to_time', 'To Time') }}
                                       {{ Form::time('to_time', null, ['class' => 'form-control']) }}
                                     </td>
                                   </tr>
                                 </tbody>
                               </table>

                               <label style="margin-top:20px">Un-availability for </label>
                                  <input type="radio" name="service" value="service" {{$unavailability->service == 'service' ? 'checked' : ''}} required />Service
                                  <input type="radio" name="service" value="consultation" {{$unavailability->service == 'consultation' ? 'checked' : ''}}>Consultation
                                  <br>

                               <label style="margin-top:20px">Consultation Mode</label>
                               @foreach($consultations as $consultation)
                                 <input type="checkbox" name="consultations[]" value="{{ $consultation->id }}"> {{ $consultation->mode }}
                               @endforeach
                               <br>
                               <input type="checkbox" name="off_all" value="1" style="margin-top:20px" {{$unavailability->off_all == '1' ? 'checked' : ''}}>OFF FOR ALL BOOKINGS
                               <br>
                               <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(sf1{{ $unavailability->id }}).submit();">Save</button>
                               <br>
                               </div>
                            {!! Form::close() !!}
                            </div>
                            </div>
                            </div>
                            </div> -->


                            </td>
                            <td>
                               {!! Form::open(['route' => ['un-availabilities.destroy', $unavailability->id], 'method' => 'DELETE', 'id' => $unavailability->id]) !!}
                               {!! Form::close() !!}
                               <a onclick="
                                  if(confirm('Are you sure, You Want to delete this?'))
                                      {
                                        event.preventDefault();
                                        document.getElementById({{ $unavailability->id }}).submit();
                                      }
                                      else{
                                        event.preventDefault();
                                      }" class="btn btn-default btn-sm">
                                  <i class="fa fa-trash" style="cursor:pointer;color:#a94442"></i>
                               </a>
                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
        </div>
    </div>
</div>
</section>

@endsection

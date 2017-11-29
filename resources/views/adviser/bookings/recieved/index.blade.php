@extends('layouts.adviser')
@section('title') | Appointments Recieved @endsection
@section('content')

<section class="content-header">
     <h1>
       Appointment
     </h1>
     <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Appointment</a></li>
       <li class="active">Provided</li>
     </ol>
   </section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
           <div class="row">
               <div class="col-lg-offset-1 col-lg-2">
             <div class="bootstrap-timepicker">
               <div class="form-group">
                 <div class="input-group">
                 <div class="input-group-addon">
                    <span>From</span>
                   </div>
                   <input type="text" style="width: 100%" class="form-control timepicker">
                 </div>
               </div>
             </div>
               </div>
               <div class="col-lg-2">
                   <div class="bootstrap-timepicker">
               <div class="form-group">
                 <div class="input-group">

                   <div class="input-group-addon">
                      <span>To</span>
                   </div>
                   <input type="text"  class="form-control timepicker">

                 </div>
                 <!-- /.input group -->
               </div>
               <!-- /.form group -->
             </div>
               </div>
               <div class="col-lg-2">
                   <button class="btn btn-black" style="width:150px" type="button">Submit</button>
               </div>
               <div class="col-lg-1">
                   <button class="btn btntransparent btn-default">
                       <img src="/images/cloud-storage-download.png"  />
                  </button>
               </div>
               <div class="col-lg-3">
                   <div class="input-group" >
                       <input type="text" class="form-control" placeholder="Search">
                       <div class="input-group-btn">
                           <button class="btn btn-default" style="height:34px;" type="submit">
                               <i class="glyphicon glyphicon-search"></i>
                           </button>
                       </div>
                   </div>
               </div>
           </div>



           <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <strong style="font-size:18px">Manage offline Bookings</strong>
                      <button class="btn btn-primary pull-right" data-target="#addpop1" data-toggle="modal">Add New Appointment</button>
                      <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
                      <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                      <div class="modal-header">
                      <button class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">New Appointment</h4>
                      </div>
                      <div class="modal-body">
                      {!! Form::open(['route' => ['bookings.offline.store'], 'method' => 'POST']) !!}
                      <div class="form-group">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td style="border:none">
                                {{ Form::label('type', 'Consultation For') }}
                                <select class="form-control" name="type">
                                  <option value="consultation">Consultation</option>
                                  <option value="service">Service</option>
                                </select>
                              </td>
                            <td style="border:none">
                              {{ Form::label('date', 'Appointment Date') }}
                              {{ Form::date('date', null, ['class' => 'form-control']) }}
                            </td>
                            <td style="border:none">
                              {{ Form::label('time', 'Appointment Time') }}
                              {{ Form::time('time', null, ['class' => 'form-control']) }}
                            </td>
                          </tr>
                          <tr>
                          <td style="border:none">
                            {{ Form::label('availability_id', 'Consultation Mode') }}
                            <select class="form-control" name="availability_id">
                              <option value="">-- Consultation Mode --</option>
                              @foreach(Auth::user()->availabilities as $availability)
                              <option value="{{ $availability->id }}">{{ $availability->consultation_mode }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td style="border:none">
                            {{ Form::label('service_id', 'Select Service') }}
                            <select class="form-control" name="service_id">
                              <option value="">-- Select Service --</option>
                              @foreach(Auth::user()->services as $service)
                              <option value="{{ $service->id }}">{{ $service->name }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td style="border:none">
                            {{ Form::label('location_id', 'Location') }}
                            <select class="form-control" name="location_id">
                              @foreach(Auth::user()->locations as $location)
                              <option value="{{ $location->id }}">{{ $location->address }}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                          <tr>
                          <td style="border:none">
                            {{ Form::label('name', 'Client Name') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '']) }}
                          </td>
                          <td style="border:none">
                            {{ Form::label('email', 'Email ID') }}
                            {{ Form::email('email', null, ['class' => 'form-control', 'required' => '']) }}
                          </td>
                          <td style="border:none">
                            {{ Form::label('mobile', 'Mobile Number') }}
                            {{ Form::text('mobile', null, ['class' => 'form-control', 'required' => '']) }}
                          </td>
                           </tr>
                          </tbody>
                         </table>
                          {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
                         </div>
                          {!! Form::close() !!}
                      </div>
                      </div>
                      </div>
                      </div>
                    </div>

                    <div class="panel-body">
                    </div>
                </div>
              </div>
          </div>

   </section>


@endsection

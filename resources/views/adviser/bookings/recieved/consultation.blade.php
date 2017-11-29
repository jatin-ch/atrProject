@extends('layouts.adviser')
@section('title') | Appointments Recieved | Consultations @endsection
@section('content')


<section class="content-header">
    <h1>
      Appointment
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Appointment</a></li>
      <li class="active">Recieved</li>
    </ol>
  </section>
  <hr style="border: 1px solid #00a65a;">




<section class="content">
<div class="row">
<div class="col-lg-12">






<!-- Open Consultation Box Starts -->
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">OPEN</div>
        <div class="panel-body">

        @foreach($consultations as $consultation)
        @if($consultation->status == 'open')
          <div class="row">
              <div class="col-md-12">
                  <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-4">

                          <p><small>Name : </small>
                          <strong>
                          @if($consultation->user->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $consultation->user->basicDetail->firstname }} {{ $consultation->user->basicDetail->lastname }}
                        </strong></p>

                          @if($consultation->date != NULL)
                          <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}</p>
                          <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($consultation->date)) }}</p>
                          @endif

                        </div>
                        <div class="col-md-4">

                          <p><small>Consultation Fees : </small> <strong>INR {{ $consultation->total_pay }}/-</strong></p>

                          <p><strong>Mode</strong> : {{ $consultation->availability->consultation_mode }}</p>

                          @if(isset($consultation->location))
                          <p><strong>Location</strong> : {{ $consultation->location->address }}</p>
                          @endif

                        </div>
                        <div class="col-md-4">

                          <p><small>Booking Id : </small> <strong>{{ $consultation->id }}</strong></p>
                           <p>Confirmation Awaited</p>

                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc1{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcc1{{$consultation->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Cancel Consultation for {{ $consultation->availability->consultation_mode }}</h4>
                          </div>
                          <div class="modal-body">
                           {!! Form::open(['route' => ['bookings.recieved.consultation.cancel', $consultation->id], 'method' => 'POST', 'id' => 'cc1'.$consultation->id]) !!}
                           <div class="form-group">
                             {{ Form::label('reason', 'Reason to cancel Consultation') }}
                             <select name="reason" class="form-control">
                               <option>Not available on scheduled time.</option>
                               <option>Adviser is not available on scheduled time & requested a new time.</option>
                               <option>Want to book appointment with other adviser.</option>
                               <option>Took advice from somewhere else.</option>
                               <option>Price is high compare to other portal/offline.</option>
                               <option>My reason is not listed.</option>
                             </select>
                           </div>
                          <div class="form-group">
                          <button class="btn btn-primary btn-sm" onclick="document.getElementById(cc1{{ $consultation->id }}).submit();">Submit</button>
                           </div>
                          {!! Form::close() !!}
                          </div>
                          </div>
                          </div>
                          </div>

                        </div>

                        @if($consultation->user->ExpertDetail->type == 'individual')
                        @if( $consultation->BookingDates->where('suggest_by', 'adviser')->count() > 0 )
                        <div class="col-md-12">
                          {!! Form::open(['route' => ['bookings.recieved.consultation.confirm', $consultation->id], 'method' => 'POST', 'id' => 'cmdt'.$consultation->id]) !!}
                          <table class="table">
                            <tbody>
                              <td style="border:none">Adviser Suggest New Dates for the Appointment</td>
                              @foreach($consultation->BookingDates as $date)
                              @if($date->suggest_by == 'adviser')
                              <td style="border:none">
                                <input type="radio" name="date" value="{{ $date->date }}" required>{{ date('jS M Y, H:i A' ,strtotime($date->date)) }}
                              </td>
                              @endif
                              @endforeach
                              <td style="border:none">
                                <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cmdt{{ $consultation->id }}).submit();">Confirm Consultation</button>
                              </td>
                            </tbody>
                          </table>

                          {!! Form::close() !!}
                        </div>
                        @endif
                        @endif


                      </div>
                  </div>
              </div>
          </div>
          @endif
          @endforeach

        </div>
    </div>
</div>
<!-- Open Consultation Box Ends -->








<!-- Upcoming Consultation Box Starts -->
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">UPCOMING</div>
        <div class="panel-body">

        @foreach($consultations as $consultation)
          @if($consultation->status == 'upcoming')
          <div class="row">
              <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <p style="color:#a00">{{ Carbon\Carbon::parse($consultation->date)->diffInDays(Carbon\Carbon::now()) }} days to Go!</p>
                    </div>

                      <div class="panel-body">
                        <div class="col-md-4">

                          <p><small>Name : </small>
                          <strong>
                          @if($consultation->user->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $consultation->user->basicDetail->firstname }} {{ $consultation->user->basicDetail->lastname }}
                        </strong></p>

                          @if($consultation->date != NULL)
                          <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}</p>
                          <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($consultation->date)) }}</p>
                          @endif


                            @foreach($consultation->Documents as $document)
                            @if($document->sender == 'user')
                            <p><button class="btn btn-default btn-sm btn-block">
                            <i class="badge badge-default">{{ $consultation->Documents->where('sender', 'user')->count() }}</i> Sent Document
                            </button></p>
                            @else
                            <p><button class="btn btn-default btn-sm btn-block">
                            <i class="badge badge-default">{{ $consultation->Documents->where('sender', 'adviser')->count() }}</i> Document Received
                            </button></p>
                            @endif
                            @endforeach


                        </div>
                        <div class="col-md-4">

                          <p><small>Consultation Fees : </small> <strong>INR {{ $consultation->total_pay }}/-</strong></p>

                          <p><strong>Mode</strong> : {{ $consultation->availability->consultation_mode }}</p>

                          @if(isset($consultation->location))
                          <p><strong>Location</strong> : {{ $consultation->location->address }}</p>
                          @endif

                        </div>
                        <div class="col-md-4">

                          <p><small>Booking Id : </small> <strong>{{ $consultation->id }}</strong></p>

                          @if($consultation->confirm == 1)

                          <p><button class="btn btn-default btn-sm btn-block" data-target="#rsb1{{$consultation->id}}" data-toggle="modal">Reschedule Appointment</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="rsb1{{$consultation->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Reschedule Appointment</h4>
                          </div>
                          <div class="modal-body">
                          {!! Form::open(['route' => ['bookings.recieved.reschedule', $consultation->id], 'method' => 'POST', 'id' => 'rs1'.$consultation->id, 'class' => 'form-inline']) !!}
                           <div class="form-group">
                             {{ Form::label('date', 'Date') }}
                             {{ Form::date('date', null, ['class' => 'form-control', 'required' => '']) }}
                             {{ Form::label('time', 'Time') }}
                             {{ Form::time('time', null, ['class' => 'form-control', 'required' => '']) }}
                           </div>
                          <div class="form-group">
                          <button class="btn btn-primary btn-sm" onclick="document.getElementById(rs1{{ $consultation->id }}).submit();">Submit</button>
                           </div>
                          {!! Form::close() !!}
                          </div>
                          </div>
                          </div>
                          </div>

                          {!! Form::open(['route' => ['bookings.recieved.consultation.document', $consultation->id], 'method' => 'POST', 'files' => true, 'id' =>'cbd'.$consultation->id]) !!}
                          <input type="file" name="doc" id="selectedFile1" style="display:none" onchange='this.form.submit();' required>
                          <p><button class="btn btn-default btn-sm btn-block" onclick="document.getElementById('selectedFile1').click();">Send Document</button></p>
                          {!! Form::close() !!}

                          <p><button class="btn btn-default btn-sm btn-block">View Detail</button></p>
                          @else
                           Confirmation Awaited
                          @endif

                          @if($consultation->availability->consultation_mode == 'phone_call')
                          @if(Carbon\Carbon::parse($consultation->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>
                          @endif
                          @endif

                          @if($consultation->availability->consultation_mode == 'video_call')
                          @if(Carbon\Carbon::parse($consultation->date)->diffInMinutes(Carbon\Carbon::now()) >= 30)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>
                          @endif
                          @endif

                          @if($consultation->availability->consultation_mode == 'personal_meeting')
                          @if(Carbon\Carbon::parse($consultation->date)->diffInMinutes(Carbon\Carbon::now()) >= 60)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>
                          @endif
                          @endif

                          @if($consultation->availability->consultation_mode == 'chat')
                          @if(Carbon\Carbon::parse($consultation->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>
                          @endif
                          @endif

                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcc2{{$consultation->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Cancel Consultation for {{ $consultation->availability->consultation_mode }}</h4>
                          </div>
                          <div class="modal-body">
                           {!! Form::open(['route' => ['bookings.recieved.consultation.cancel', $consultation->id], 'method' => 'POST', 'id' => 'cc2'.$consultation->id]) !!}
                           <div class="form-group">
                             {{ Form::label('reason', 'Reason to cancel Consultation') }}
                             <select name="reason" class="form-control">
                               <option>Not available on scheduled time.</option>
                               <option>Adviser is not available on scheduled time & requested a new time.</option>
                               <option>Want to book appointment with other adviser.</option>
                               <option>Took advice from somewhere else.</option>
                               <option>Price is high compare to other portal/offline.</option>
                               <option>My reason is not listed.</option>
                             </select>
                           </div>
                          <div class="form-group">
                          <button class="btn btn-primary btn-sm" onclick="document.getElementById(cc2{{ $consultation->id }}).submit();">Submit</button>
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
          </div>
          @endif
          @endforeach

        </div>
    </div>
</div>
<!-- Upcoming Consultation Box Ends -->








<!-- Done Consultation Box Starts -->
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">DONE</div>
        <div class="panel-body">

        @foreach($consultations as $consultation)
        @if($consultation->status =='done')
          <div class="row">
              <div class="col-md-12">
                  <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-4">

                          <p><small>Name : </small>
                          <strong>
                          @if($consultation->user->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $consultation->user->basicDetail->firstname }} {{ $consultation->user->basicDetail->lastname }}
                        </strong></p>

                          @if($consultation->date != NULL)
                          <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}</p>
                          <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($consultation->date)) }}</p>
                          @endif

                        </div>
                        <div class="col-md-4">

                          <p><small>Consultation Fees : </small> <strong>INR {{ $consultation->total_pay }}/-</strong></p>

                          <p><strong>Mode</strong> : {{ $consultation->availability->consultation_mode }}</p>

                          @if(isset($consultation->location))
                          <p><strong>Location</strong> : {{ $consultation->location->address }}</p>
                          @endif

                        </div>
                        <div class="col-md-4">

                          <p><small>Booking Id : </small> <strong>{{ $consultation->id }}</strong></p>
                          @if(Carbon\Carbon::now()->diffInHours(Carbon\Carbon::parse($consultation->date)) <= 48)
                          <p><button class="btn btn-default btn-sm btn-block">Chat</button></p>
                          @endif
                          <p><button class="btn btn-default btn-sm btn-block"><i class="badge badge-default">3</i> View Documents</button></p>

                        </div>

                      </div>
                  </div>
              </div>
          </div>
          @endif
          @endforeach

        </div>
    </div>
</div>
<!-- Done Consultation Box Ends -->








<!-- Cancelled Consultation Box Starts -->
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">CANCELLED</div>
        <div class="panel-body">

        @foreach($consultations as $consultation)
        @if($consultation->status =='canceled')
          <div class="row">
              <div class="col-md-12">
                  <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-4">

                          <p><small>Name : </small>
                          <strong>
                          @if($consultation->user->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $consultation->user->basicDetail->firstname }} {{ $consultation->user->basicDetail->lastname }}
                        </strong></p>

                          @if($consultation->date != NULL)
                          <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}, {{ date('g:i A' ,strtotime($consultation->date)) }}</p>
                          @endif
                          <p><strong>Booking Date</strong> : {{ date('jS M Y' ,strtotime($consultation->created_at)) }}, {{ date('g:i A' ,strtotime($consultation->created_at)) }}</p>
                          <p><strong>Cancelled On</strong> : {{ date('jS M Y' ,strtotime($consultation->updated_at)) }}, {{ date('g:i A' ,strtotime($consultation->updated_at)) }}</p>
                          <p style="text-transform:capitalize"><strong>Cancel By</strong> : {{$consultation->BookingCancel['cancel_by']}}</p>

                        </div>
                        <div class="col-md-4">

                          <p><small>Consultation Fees : </small> <strong>INR {{ $consultation->total_pay }}/-</strong></p>
                          <p><strong>Mode</strong> : {{ $consultation->availability->consultation_mode }}</p>

                        </div>
                        <div class="col-md-4">

                          <p><small>Booking Id : </small> <strong>{{ $consultation->id }}</strong></p>
                          <p><strong>Cancellation Reason</strong> : {{ $consultation->BookingCancel['reason'] }}</p>
                          <p><button class="btn btn-default btn-sm btn-block">Payment Status</button></p>

                        </div>

                      </div>
                  </div>
              </div>
          </div>
          @endif
          @endforeach

        </div>
    </div>
</div>
<!-- Cancelled Consultation Box Ends -->







</div>
</div>
</section>


@endsection

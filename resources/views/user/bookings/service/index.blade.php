@extends('layouts.user')
@section('title') | Appointments | Services @endsection
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







<!-- Open Service Box Starts -->
<div class="col-md-12">
  <div class="panel panel-default">
      <div class="panel-heading">OPEN</div>
      <div class="panel-body">

      @foreach($services as $service)
      @if($service->status == 'open')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="col-md-3">

                        <p><small>Name : </small>
                        <strong>
                        @if($service->user->basicDetail->gender == 'M')
                        Mr.
                        @else
                        Ms.
                        @endif
                        {{ $service->user->basicDetail->firstname }} {{ $service->user->basicDetail->lastname }}
                      </strong></p>

                        @if($service->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>
                        @endif

                        @if(isset($service->location))
                        <p><strong>Location</strong> : {{ $service->location->address }}</p>
                        @endif

                      </div>
                      <div class="col-md-3">

                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>

                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>
                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>

                      </div>
                      <div class="col-md-3">

                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>

                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>
                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>

                      </div>
                      <div class="col-md-3">

                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>
                         <p>Confirmation Awaited</p>

                        <button class="btn btn-default btn-sm btn-block" data-target="#pcs1{{$service->id}}" data-toggle="modal">Cancel Appointment</button>
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcs1{{$service->id}}" tabindex="-1">
                        <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cancellation for {{ $service->service->name }}</h4>
                        </div>
                        <div class="modal-body">
                         {!! Form::open(['route' => ['user.bookings.service.cancel', $service->id], 'method' => 'POST', 'id' => 'cs1'.$service->id]) !!}
                         <div class="form-group">
                           {{ Form::label('reason', 'Reason to cancel service') }}
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
                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cs1{{ $service->id }}).submit();">Submit</button>
                         </div>
                        {!! Form::close() !!}
                        </div>
                        </div>
                        </div>
                        </div>

                      </div>

                      @if($service->user->ExpertDetail->type == 'individual')
                      @if( $service->BookingDates->where('suggest_by', 'user')->count() > 0 )
                      <div class="col-md-12">
                        {!! Form::open(['route' => ['user.bookings.service.confirm', $service->id], 'method' => 'POST', 'id' => 'cmdt'.$service->id]) !!}
                        <table class="table">
                          <tbody>
                            <td style="border:none">Adviser Suggest New Dates for the Appointment</td>
                            @foreach($service->BookingDates as $date)
                            @if($date->suggest_by == 'adviser')
                            <td style="border:none">
                              <input type="radio" name="date" value="{{ $date->date }}" required>{{ date('jS M Y, H:i A' ,strtotime($date->date)) }}
                            </td>
                            @endif
                            @endforeach
                            <td style="border:none">
                              <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cmdt{{ $service->id }}).submit();">Confirm Service</button>
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
<!-- Open Service Box Ends -->








<!-- Upcoming Service Box Starts -->
<div class="col-md-12">
  <div class="panel panel-default">
      <div class="panel-heading">UPCOMING</div>
      <div class="panel-body">

      @foreach($services as $service)
        @if($service->status == 'upcoming')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <p style="color:#a00">{{ Carbon\Carbon::parse($service->date)->diffInDays(Carbon\Carbon::now()) }} days to Go!</p>
                  </div>
                    <div class="panel-body">
                      <div class="col-md-3">

                        <p><small>Name : </small>
                        <strong>
                        @if($service->user->basicDetail->gender == 'M')
                        Mr.
                        @else
                        Ms.
                        @endif
                        {{ $service->user->basicDetail->firstname }} {{ $service->user->basicDetail->lastname }}
                      </strong></p>

                        @if($service->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>
                        @endif

                        @if(isset($service->location))
                        <p><strong>Location</strong> : {{ $service->location->address }}</p>
                        @endif

                        @foreach($service->Documents as $document)
                        @if($document->sender == 'user')
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $service->Documents->where('sender', 'user')->count() }}</i> Sent Document
                        </button></p>
                        @else
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $service->Documents->where('sender', 'adviser')->count() }}</i> Document Received
                        </button></p>
                        @endif
                        @endforeach

                      </div>
                      <div class="col-md-3">

                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>

                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>
                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>

                      </div>
                      <div class="col-md-3">

                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>

                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>
                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>

                      </div>

                      <div class="col-md-3">

                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>

                        @if($service->confirm == 1)

                        <p><button class="btn btn-default btn-sm btn-block" data-target="#rsb1{{$service->id}}" data-toggle="modal">Reschedule Appointment</button></p>
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="rsb1{{$service->id}}" tabindex="-1">
                        <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Reschedule Appointment</h4>
                        </div>
                        <div class="modal-body">
                        {!! Form::open(['route' => ['user.bookings.reschedule', $service->id], 'method' => 'POST', 'id' => 'rs1'.$service->id, 'class' => 'form-inline']) !!}
                         <div class="form-group">
                           {{ Form::label('date', 'Date') }}
                           {{ Form::date('date', null, ['class' => 'form-control', 'required' => '']) }}
                           {{ Form::label('time', 'Time') }}
                           {{ Form::time('time', null, ['class' => 'form-control', 'required' => '']) }}
                         </div>
                        <div class="form-group">
                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(rs1{{ $service->id }}).submit();">Submit</button>
                         </div>
                        {!! Form::close() !!}
                        </div>
                        </div>
                        </div>
                        </div>

                        {!! Form::open(['route' => ['user.bookings.service.document', $service->id], 'method' => 'POST', 'files' => true, 'id' =>'cbd'.$service->id]) !!}
                        <input type="file" name="doc" id="selectedFile1" style="display:none" onchange='this.form.submit();' required>
                        <p><button class="btn btn-default btn-sm btn-block" onclick="document.getElementById('selectedFile1').click();">Send Document</button></p>
                        {!! Form::close() !!}

                        <p><button class="btn btn-default btn-sm btn-block">View Detail</button></p>
                        @else
                         Confirmation Awaited
                        @endif

                        @if($service->availability->consultation_mode == 'phone_call')
                        @if(Carbon\Carbon::parse($service->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcs2{{$service->id}}" data-toggle="modal">Cancel Appointment</button>
                        @endif
                        @endif

                        @if($service->availability->consultation_mode == 'video_call')
                        @if(Carbon\Carbon::parse($service->date)->diffInMinutes(Carbon\Carbon::now()) >= 30)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcs2{{$service->id}}" data-toggle="modal">Cancel Appointment</button>
                        @endif
                        @endif

                        @if($service->availability->consultation_mode == 'personal_meeting')
                        @if(Carbon\Carbon::parse($service->date)->diffInMinutes(Carbon\Carbon::now()) >= 60)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcs2{{$service->id}}" data-toggle="modal">Cancel Appointment</button>
                        @endif
                        @endif

                        @if($service->availability->consultation_mode == 'chat')
                        @if(Carbon\Carbon::parse($service->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcs2{{$service->id}}" data-toggle="modal">Cancel Appointment</button>
                        @endif
                        @endif

                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcs2{{$service->id}}" tabindex="-1">
                        <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cancellation for {{ $service->service->name }}</h4>
                        </div>
                        <div class="modal-body">
                         {!! Form::open(['route' => ['user.bookings.service.cancel', $service->id], 'method' => 'POST', 'id' => 'cs2'.$service->id]) !!}
                         <div class="form-group">
                           {{ Form::label('reason', 'Reason to cancel service') }}
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
                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cs2{{ $service->id }}).submit();">Submit</button>
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
<!-- Upcoming Service Box Ends -->








<!-- In-Process Service Box Starts -->
<div class="col-md-12">
  <div class="panel panel-default">
      <div class="panel-heading">IN-PROCESS</div>
      <div class="panel-body">

      @foreach($services as $service)
        @if($service->status == 'inprocess')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="col-md-3">

                        <p><small>Name : </small>
                        <strong>
                        @if($service->user->basicDetail->gender == 'M')
                        Mr.
                        @else
                        Ms.
                        @endif
                        {{ $service->user->basicDetail->firstname }} {{ $service->user->basicDetail->lastname }}
                      </strong></p>

                        @if($service->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>
                        @endif

                        @foreach($service->Documents as $document)
                        @if($document->sender == 'user')
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $service->Documents->where('sender', 'user')->count() }}</i> Sent Document
                        </button></p>
                        @else
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $service->Documents->where('sender', 'adviser')->count() }}</i> Document Received
                        </button></p>
                        @endif
                        @endforeach

                      </div>
                      <div class="col-md-3">

                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>

                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>
                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>

                        @if(isset($service->location))
                        <p><strong>Location</strong> : {{ $service->location->address }}</p>
                        @endif

                      </div>
                      <div class="col-md-3">

                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>

                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>
                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>

                        <button class="btn btn-default btn-sm btn-block" data-target="#prd1{{$service->id}}" data-toggle="modal">Raise Dispute</button>
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="prd1{{$service->id}}" tabindex="-1">
                        <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Raise Dispute for {{ $service->service->name }}</h4>
                        </div>
                        <div class="modal-body">
                         {!! Form::open(['route' => ['user.bookings.service.dispute', $service->id], 'method' => 'POST', 'id' => 'rd1'.$service->id]) !!}
                         <div class="form-group">
                           {{ Form::label('reason', 'Reason for raising Dsipute') }}
                           <select name="reason" class="form-control">
                             <option>Service not provided/delivered as committed</option>
                             <option>Delay in service delivery</option>
                             <option>Adviser asked for extra money</option>
                           </select>
                         </div>
                        <div class="form-group">
                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(rd1{{ $service->id }}).submit();">Raise Dispute</button>
                         </div>
                        {!! Form::close() !!}
                        </div>
                        </div>
                        </div>
                        </div>

                      </div>

                      <div class="col-md-3">

                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>

                        <p><button class="btn btn-default btn-sm btn-block">Chat</button></p>

                        @if($service->confirm == 1)

                        {!! Form::open(['route' => ['user.bookings.service.document', $service->id], 'method' => 'POST', 'files' => true, 'id' =>'cbd'.$service->id]) !!}
                        <input type="file" name="doc" id="selectedFile2" style="display:none" onchange='this.form.submit();' required>
                        <p><button class="btn btn-default btn-sm btn-block" onclick="document.getElementById('selectedFile2').click();">Send Document</button></p>
                        {!! Form::close() !!}

                        @endif

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
<!-- In-Process Service Box Ends -->









<!-- Done Service Box Starts -->
<div class="col-md-12">
  <div class="panel panel-default">
      <div class="panel-heading">DONE</div>
      <div class="panel-body">

      @foreach($services as $service)
      @if($service->status =='done')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="col-md-3">

                        <p><small>Name : </small>
                        <strong>
                        @if($service->user->basicDetail->gender == 'M')
                        Mr.
                        @else
                        Ms.
                        @endif
                        {{ $service->user->basicDetail->firstname }} {{ $service->user->basicDetail->lastname }}
                      </strong></p>

                        @if($service->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>
                        @endif

                        @if(isset($service->location))
                        <p><strong>Location</strong> : {{ $service->location->address }}</p>
                        @endif

                      </div>
                      <div class="col-md-3">

                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>

                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>
                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>
                        <p><button class="btn btn-default btn-sm btn-block">
                          <i class="badge badge-default">{{ $service->Documents->count() }}</i> View Documents
                        </button></p>

                      </div>
                      <div class="col-md-3">

                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>

                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>
                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>
                        <button class="btn btn-default btn-sm btn-block" data-target="#prd2{{$service->id}}" data-toggle="modal">Raise Dispute</button>
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="prd2{{$service->id}}" tabindex="-1">
                        <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Raise Dispute for {{ $service->service->name }}</h4>
                        </div>
                        <div class="modal-body">
                         {!! Form::open(['route' => ['user.bookings.service.dispute', $service->id], 'method' => 'POST', 'id' => 'rd2'.$service->id]) !!}
                         <div class="form-group">
                           {{ Form::label('reason', 'Reason for raising Dsipute') }}
                           <select name="reason" class="form-control">
                             <option>Service not provided/delivered as committed</option>
                             <option>Delay in service delivery</option>
                             <option>Adviser asked for extra money</option>
                           </select>
                         </div>
                        <div class="form-group">
                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(rd2{{ $service->id }}).submit();">Raise Dispute</button>
                         </div>
                        {!! Form::close() !!}
                        </div>
                        </div>
                        </div>
                        </div>

                      </div>
                      <div class="col-md-3">

                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>
                        <p>Rating</p>
                        <p><button class="btn btn-default btn-sm btn-block">Chat</button></p>

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
<!-- Done Service Box Ends -->









<!-- Cancelled Service Box Starts -->
<div class="col-md-12">
  <div class="panel panel-default">
      <div class="panel-heading">CANCELLED</div>
      <div class="panel-body">

      @foreach($services as $service)
      @if($service->status =='canceled')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="col-md-3">

                        <p><small>Name : </small>
                        <strong>
                        @if($service->user->basicDetail->gender == 'M')
                        Mr.
                        @else
                        Ms.
                        @endif
                        {{ $service->user->basicDetail->firstname }} {{ $service->user->basicDetail->lastname }}
                      </strong></p>

                        @if($service->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>
                        @endif

                        <p style="text-transform:capitalize"><strong>Cancel By</strong> : {{$service->BookingCancel['cancel_by']}}</p>

                      </div>
                      <div class="col-md-3">

                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>

                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>
                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>
                        <p><strong>Booking Date</strong> : {{ date('jS M Y' ,strtotime($service->created_at)) }}, {{ date('g:i A' ,strtotime($service->created_at)) }}</p>

                      </div>
                      <div class="col-md-3">

                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>

                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>
                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>
                        <p><strong>Cancelled On</strong> : {{ date('jS M Y' ,strtotime($service->updated_at)) }}, {{ date('g:i A' ,strtotime($service->updated_at)) }}</p>

                      </div>
                      <div class="col-md-3">

                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>
                        <p><strong>Cancellation Reason</strong> : {{ $service->BookingCancel['reason'] }}</p>
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
<!-- Cancelled Service Box Ends -->









<!-- Dispute Service Box Starts -->
<div class="col-md-12">
  <div class="panel panel-default">
      <div class="panel-heading">DISPUTE</div>
      <div class="panel-body">

      @foreach($services as $service)
      @if($service->status =='dispute')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="col-md-3">

                        <p><small>Name : </small>
                        <strong>
                        @if($service->user->basicDetail->gender == 'M')
                        Mr.
                        @else
                        Ms.
                        @endif
                        {{ $service->user->basicDetail->firstname }} {{ $service->user->basicDetail->lastname }}
                      </strong></p>

                        @if($service->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>
                        @endif

                        <p><strong>Raised By</strong> : User </p>

                          <p><strong>Raised On</strong> : {{ date('jS M Y' ,strtotime($service->updated_at)) }}, {{ date('g:i A' ,strtotime($service->updated_at)) }}</p>


                      </div>
                      <div class="col-md-3">

                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>

                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>
                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>

                      </div>
                      <div class="col-md-3">

                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>

                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>
                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>

                      </div>
                      <div class="col-md-3">

                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>
                        <p><strong>Dispute Status</strong> : {{ $service->dispute->status }}</p>
                        <p><strong>Dispute Reason</strong> : {{ $service->dispute->reason }}</p>

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
<!-- Dispute Service Box Ends -->






</div>
</div>
</section>
@endsection

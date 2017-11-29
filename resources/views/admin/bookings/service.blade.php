@extends('layouts.admin')
@section('title') | Appointments | Services @endsection
@section('content')

<style type="text/css">
  .nav-tabs { border-bottom: 2px solid #DDD!important;
    background: #f5f5f5; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #666; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
        .nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }
.tab-pane { padding: 15px 0; }
.tab-content{padding:20px}

.card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }
</style>
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
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
                 <ul class="nav nav-tabs text-center" role="tablist">
                    <li class="menu" role="presentation" class="active"><a href="#open" aria-controls="open" role="tab" data-toggle="tab">Open</a></li>
                    <li class="menu" role="presentation"><a href="#upcoming" aria-controls="#upcoming" role="tab" data-toggle="tab">Upcoming</a></li>
                    <li class="menu" role="presentation"><a href="#done" aria-controls="#done" role="tab" data-toggle="tab">Done</a></li>
                    <li class="menu" role="presentation"><a href="#inprocess" aria-controls="#inprocess" role="tab" data-toggle="tab">Inprocess</a></li>
                    <li class="menu" role="presentation"><a href="#cancel" aria-controls="#cancel" role="tab" data-toggle="tab">Cancelled</a></li>
                    <li class="menu" role="presentation"><a href="#dispute" aria-controls="#dispute" role="tab" data-toggle="tab">Disputed</a></li>
                 </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="open">
                         @foreach($services as $service)
          @if($service->status == 'open')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-3">

                          <p><small>Name : </small>
                          <strong>
                          @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}
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

                          <p><button class="btn btn-default btn-sm btn-block" data-target="#cad1{{$service->id}}" data-toggle="modal">Change Adviser</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="cad1{{$service->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Change Adviser for {{ $service->availability->consultation_mode }}</h4>
                          </div>
                          <div class="modal-body">
                           {!! Form::open(['route' => ['admin.bookings.changeAdviser', $service->id], 'method' => 'POST', 'id' => 'cd1'.$service->id]) !!}
                           <div class="form-group">
                             {{ Form::label('user_id', 'Select Adviser*') }}
                             <select name="user_id" class="form-control">
                               @foreach($advisers as $adviser)
                               <option value="{{$adviser->id}}">{{$adviser->name}}</option>
                               @endforeach
                             </select>
                           </div>
                          <div class="form-group">
                          <button class="btn btn-primary btn-sm" onclick="document.getElementById(cd1{{ $service->id }}).submit();">submit</button>
                           </div>
                          {!! Form::close() !!}
                          </div>
                          </div>
                          </div>
                          </div>


                          <p> Confirmation Awaited</p>
                          @if($service->user->ExpertDetail->type == 'professional')
                           {!! Form::open(['route' => ['admin.services.confirm', $service->id], 'method' => 'POST', 'id' => 'cm'.$service->id]) !!}
                            <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cm{{ $service->id }}).submit();">Confirm Consultation</button>
                           {!! Form::close() !!}
                           @endif


                          <p><button class="btn btn-default btn-sm btn-block" data-target="#pcs1{{$service->id}}" data-toggle="modal">Cancel Appointment</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcs1{{$service->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Cancellation for {{ $service->service->name }}</h4>
                          </div>
                          <div class="modal-body">
                           {!! Form::open(['route' => ['admin.services.cancel', $service->id], 'method' => 'POST', 'id' => 'cs1'.$service->id]) !!}
                           <div class="form-group">
                             {{ Form::label('reason', 'Reason for cancel Service') }}
                             <select name="reason" class="form-control">
                               <option>Not available on scheduled time.</option>
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
                        @if( $service->BookingDates->where('suggest_by', 'client')->count() > 0 )
                        <div class="col-md-12">
                          {!! Form::open(['route' => ['admin.services.confirm', $service->id], 'method' => 'POST', 'id' => 'cmdt'.$service->id]) !!}
                          <table class="table">
                            <tbody>
                              <td style="border:none">Client choose Dates for the Appointment</td>
                              @foreach($service->BookingDates as $date)
                              @if($date->suggest_by == 'client')
                              <td style="border:none">
                                <input type="radio" name="date" value="{{ $date->date }}" required>{{ date('jS M Y, H:i A' ,strtotime($date->date)) }}
                              </td>
                              @endif
                              @endforeach
                              <td style="border:none">
                                <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cmdt{{ $service->id }}).submit();">Confirm Consultation</button>
                              </td>
                            </tbody>
                          </table>

                          {!! Form::close() !!}
                        </div>
                        <br clear="all">



                        <p><button class="btn btn-default btn-sm btn-block" data-target="#scc1{{$service->id}}" data-toggle="modal">Suggest New Date & Time</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="scc1{{$service->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Suggest New Date & Time for {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}</h4>
                          </div>
                          <div class="modal-body">
                           <table class="table">
                            <form action="{{ route('admin.services.confirm', $service->id) }}" method="POST", id="sdt{{$service->id}}">
                            {{ csrf_field() }}
                            <tbody>
                             <tr>
                               <td><strong>Suggestion1</strong></td>
                              <td>
                                {{ Form::label('sdate', 'Date *') }}
                                {{ Form::date('sdate[]', null, ['class' => 'form-control']) }}
                              </td>
                              <td>
                                {{ Form::label('stime', 'Time Slot *') }}
                                {{ Form::time('stime[]', null, ['class' => 'form-control']) }}
                              </td>
                            </tr>
                            <tr>
                              <td><strong>suggestion2</strong></td>
                             <td>
                               {{ Form::label('sdate', 'Date *') }}
                               {{ Form::date('sdate[]', null, ['class' => 'form-control']) }}
                             </td>
                             <td>
                               {{ Form::label('stime', 'Time Slot *') }}
                               {{ Form::time('stime[]', null, ['class' => 'form-control']) }}
                             </td>
                           </tr>
                           <tr>
                            <td><strong>suggestion3</strong></td>
                            <td>
                              {{ Form::label('sdate', 'Date *') }}
                              {{ Form::date('sdate[]', null, ['class' => 'form-control']) }}
                            </td>
                            <td>
                              {{ Form::label('stime', 'Time Slot *') }}
                              {{ Form::time('stime[]', null, ['class' => 'form-control']) }}
                            </td>
                          </tr>
                          <tr>
                            <td>
                            <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(sdt{{ $service->id }}).submit();">Suggest Date & Time</button>
                          </td>
                          </tr>
                            </tbody>
                            </form>
                          </table>
                          </div>
                          </div>
                          </div>
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
                    <div role="tabpanel" class="tab-pane" id="upcoming">
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
                          @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        @if($service->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>
                        @endif

                        @foreach($service->Documents as $document)
                        @if($document->sender == 'adviser')
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $service->Documents->where('sender', 'adviser')->count() }}</i> Sent Document
                        </button></p>
                        @else
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $service->Documents->where('sender', 'user')->count() }}</i> Document Received
                        </button></p>
                        @endif
                        @endforeach

                        </div>
                        <div class="col-md-3">

                          <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>

                          <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>
                          <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>
                        @if(isset($service->location))
                            <p><strong>Location</strong> : {{ $service->location->address }}
                            @endif</p>

                        </div>
                        <div class="col-md-3">

                          <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>

                          <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>
                          <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>

                        </div>
                        <div class="col-md-3">

                          <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>


                          <p><button class="btn btn-default btn-sm btn-block" data-target="#cad2{{$service->id}}" data-toggle="modal">Change Adviser</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="cad2{{$service->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Change Adviser for {{ $service->availability->consultation_mode }}</h4>
                          </div>
                          <div class="modal-body">
                           {!! Form::open(['route' => ['admin.bookings.changeAdviser', $service->id], 'method' => 'POST', 'id' => 'cd2'.$service->id]) !!}
                           <div class="form-group">
                             {{ Form::label('user_id', 'Select Adviser*') }}
                             <select name="user_id" class="form-control">
                               @foreach($advisers as $adviser)
                               <option value="{{$adviser->id}}">{{$adviser->name}}</option>
                               @endforeach
                             </select>
                           </div>
                          <div class="form-group">
                          <button class="btn btn-primary btn-sm" onclick="document.getElementById(cd2{{ $service->id }}).submit();">submit</button>
                           </div>
                          {!! Form::close() !!}
                          </div>
                          </div>
                          </div>
                          </div>


                          <p><button class="btn btn-default btn-sm btn-block" data-target="#rsb1{{$service->id}}" data-toggle="modal">Reschedule Appointment</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="rsb1{{$service->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Reschedule Appointment</h4>
                          </div>
                          <div class="modal-body">
                          {!! Form::open(['route' => ['admin.bookings.reschedule', $service->id], 'method' => 'POST', 'id' => 'rs1'.$service->id, 'class' => 'form-inline']) !!}
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

                          {!! Form::open(['route' => ['admin.services.document', $service->id], 'method' => 'POST', 'files' => true]) !!}
                          <input type="file" name="doc" id="selectedFile2{{$service->id}}" style="display:none" onchange='this.form.submit();' required>
                          <p><button class="btn btn-default btn-sm btn-block" onclick="document.getElementById('selectedFile2{{$service->id}}').click();">Send Document</button></p>
                          {!! Form::close() !!}

                          <p><button class="btn btn-default btn-sm btn-block">View Detail</button></p>


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
                           {!! Form::open(['route' => ['admin.services.cancel', $service->id], 'method' => 'POST', 'id' => 'cs2'.$service->id]) !!}
                           <div class="form-group">
                             {{ Form::label('reason', 'Reason for cancel Service') }}
                             <select name="reason" class="form-control">
                               <option>Not available on scheduled time.</option>
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
                    <div role="tabpanel" class="tab-pane" id="done">
                         @foreach($services as $service)
          @if($service->status =='done')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-3">

                          <p><small>Name : </small>
                          <strong>
                          @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}
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
                          <p><button class="btn btn-default btn-sm btn-block"><i class="badge badge-default">3</i> View Documents</button></p>

                        </div>
                        <div class="col-md-3">

                          <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>

                          <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>
                          <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>
                          <p><button class="btn btn-default btn-sm btn-block">Raise Dispute</button></p>

                        </div>
                        <div class="col-md-3">

                          <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>
                          <p>Rating</p>
                          <p><button class="btn btn-default btn-sm btn-block">chat</button></p>

                        </div>
                      </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane" id="inprocess">
                         @foreach($services as $service)
            @if($service->status == 'inprocess')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-3">

                          <p><small>Name : </small>
                          <strong>
                          @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        @if($service->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>
                        @endif

                        @foreach($service->Documents as $document)
                        @if($document->sender == 'adviser')
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $service->Documents->where('sender', 'adviser')->count() }}</i> Sent Document
                        </button></p>
                        @else
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $service->Documents->where('sender', 'user')->count() }}</i> Document Received
                        </button></p>
                        @endif
                        @endforeach

                        </div>
                        <div class="col-md-3">

                          <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>

                          <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>
                          <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>
                           @if(isset($service->location))
                            <p><strong>Location</strong> : {{ $service->location->address }}
                            @endif</p>

                        </div>
                        <div class="col-md-3">

                          <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>

                          <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>
                          <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>

                        </div>
                        <div class="col-md-3">

                          <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>

                          <p><button class="btn btn-default btn-sm btn-block">Reschedule Appointment</button></p>

                          {!! Form::open(['route' => ['admin.services.document', $service->id], 'method' => 'POST', 'files' => true]) !!}
                          <input type="file" name="doc" id="selectedFile1" style="display:none" onchange='this.form.submit();' required>
                          <p><button class="btn btn-default btn-sm btn-block" onclick="document.getElementById('selectedFile1').click();">Send Document</button></p>
                          {!! Form::close() !!}

                          <p><button class="btn btn-default btn-sm btn-block">View Detail</button></p>

                        </div>
                      </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane" id="cancel">
                         @foreach($services as $service)
          @if($service->status =='canceled')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-3">

                          <p><small>Name : </small>
                          <strong>
                          @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        @if($service->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>
                        @endif

                        <p style="text-transform:capitalize"><strong>Cancel By</strong> :{{ $service->BookingCancel['cancel_by'] }}</p>

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
                    <div role="tabpanel" class="tab-pane" id="dispute">
                         @foreach($services as $service)
          @if($service->status =='dispute')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-3">

                          <p><small>Name : </small>
                          <strong>
                          @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        @if($service->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>

                        <p><strong>Raised By</strong> : User </p>
                        <p><strong>Raised On</strong> : {{ date('jS M Y' ,strtotime($service->updated_at)) }}, {{ date('g:i A' ,strtotime($service->updated_at)) }}</p>

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



  <!-- Open consultation box starts -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">OPEN</div>-->

  <!--        <div class="panel-body">-->

  <!--        @foreach($services as $service)-->
  <!--        @if($service->status == 'open')-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      @if($service->date != NULL)-->
  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>-->
  <!--                      <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>-->
  <!--                      @endif-->
  <!--                      @if(isset($service->location))-->
  <!--                      <p><strong>Location</strong> : {{ $service->location->address }}</p>-->
  <!--                      @endif-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>-->
  <!--                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>-->
  <!--                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>-->

  <!--                        <p><button class="btn btn-default btn-sm btn-block" data-target="#cad1{{$service->id}}" data-toggle="modal">Change Adviser</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="cad1{{$service->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Change Adviser for {{ $service->availability->consultation_mode }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         {!! Form::open(['route' => ['admin.bookings.changeAdviser', $service->id], 'method' => 'POST', 'id' => 'cd1'.$service->id]) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('user_id', 'Select Adviser*') }}-->
  <!--                           <select name="user_id" class="form-control">-->
  <!--                             @foreach($advisers as $adviser)-->
  <!--                             <option value="{{$adviser->id}}">{{$adviser->name}}</option>-->
  <!--                             @endforeach-->
  <!--                           </select>-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cd1{{ $service->id }}).submit();">submit</button>-->
  <!--                         </div>-->
  <!--                        {!! Form::close() !!}-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->


  <!--                        <p> Confirmation Awaited</p>-->
  <!--                        @if($service->user->ExpertDetail->type == 'professional')-->
  <!--                         {!! Form::open(['route' => ['admin.services.confirm', $service->id], 'method' => 'POST', 'id' => 'cm'.$service->id]) !!}-->
  <!--                          <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cm{{ $service->id }}).submit();">Confirm Consultation</button>-->
  <!--                         {!! Form::close() !!}-->
  <!--                         @endif-->


  <!--                        <p><button class="btn btn-default btn-sm btn-block" data-target="#pcs1{{$service->id}}" data-toggle="modal">Cancel Appointment</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcs1{{$service->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Cancellation for {{ $service->service->name }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         {!! Form::open(['route' => ['admin.services.cancel', $service->id], 'method' => 'POST', 'id' => 'cs1'.$service->id]) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('reason', 'Reason for cancel Service') }}-->
  <!--                           <select name="reason" class="form-control">-->
  <!--                             <option>Not available on scheduled time.</option>-->
  <!--                             <option>My reason is not listed.</option>-->
  <!--                           </select>-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cs1{{ $service->id }}).submit();">Submit</button>-->
  <!--                         </div>-->
  <!--                        {!! Form::close() !!}-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->

  <!--                      </div>-->


  <!--                      @if($service->user->ExpertDetail->type == 'individual')-->
  <!--                      @if( $service->BookingDates->where('suggest_by', 'client')->count() > 0 )-->
  <!--                      <div class="col-md-12">-->
  <!--                        {!! Form::open(['route' => ['admin.services.confirm', $service->id], 'method' => 'POST', 'id' => 'cmdt'.$service->id]) !!}-->
  <!--                        <table class="table">-->
  <!--                          <tbody>-->
  <!--                            <td style="border:none">Client choose Dates for the Appointment</td>-->
  <!--                            @foreach($service->BookingDates as $date)-->
  <!--                            @if($date->suggest_by == 'client')-->
  <!--                            <td style="border:none">-->
  <!--                              <input type="radio" name="date" value="{{ $date->date }}" required>{{ date('jS M Y, H:i A' ,strtotime($date->date)) }}-->
  <!--                            </td>-->
  <!--                            @endif-->
  <!--                            @endforeach-->
  <!--                            <td style="border:none">-->
  <!--                              <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cmdt{{ $service->id }}).submit();">Confirm Consultation</button>-->
  <!--                            </td>-->
  <!--                          </tbody>-->
  <!--                        </table>-->

  <!--                        {!! Form::close() !!}-->
  <!--                      </div>-->
  <!--                      <br clear="all">-->



  <!--                      <p><button class="btn btn-default btn-sm btn-block" data-target="#scc1{{$service->id}}" data-toggle="modal">Suggest New Date & Time</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="scc1{{$service->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Suggest New Date & Time for {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         <table class="table">-->
  <!--                          <form action="{{ route('admin.services.confirm', $service->id) }}" method="POST", id="sdt{{$service->id}}">-->
  <!--                          {{ csrf_field() }}-->
  <!--                          <tbody>-->
  <!--                           <tr>-->
  <!--                             <td><strong>Suggestion1</strong></td>-->
  <!--                            <td>-->
  <!--                              {{ Form::label('sdate', 'Date *') }}-->
  <!--                              {{ Form::date('sdate[]', null, ['class' => 'form-control']) }}-->
  <!--                            </td>-->
  <!--                            <td>-->
  <!--                              {{ Form::label('stime', 'Time Slot *') }}-->
  <!--                              {{ Form::time('stime[]', null, ['class' => 'form-control']) }}-->
  <!--                            </td>-->
  <!--                          </tr>-->
  <!--                          <tr>-->
  <!--                            <td><strong>suggestion2</strong></td>-->
  <!--                           <td>-->
  <!--                             {{ Form::label('sdate', 'Date *') }}-->
  <!--                             {{ Form::date('sdate[]', null, ['class' => 'form-control']) }}-->
  <!--                           </td>-->
  <!--                           <td>-->
  <!--                             {{ Form::label('stime', 'Time Slot *') }}-->
  <!--                             {{ Form::time('stime[]', null, ['class' => 'form-control']) }}-->
  <!--                           </td>-->
  <!--                         </tr>-->
  <!--                         <tr>-->
  <!--                          <td><strong>suggestion3</strong></td>-->
  <!--                          <td>-->
  <!--                            {{ Form::label('sdate', 'Date *') }}-->
  <!--                            {{ Form::date('sdate[]', null, ['class' => 'form-control']) }}-->
  <!--                          </td>-->
  <!--                          <td>-->
  <!--                            {{ Form::label('stime', 'Time Slot *') }}-->
  <!--                            {{ Form::time('stime[]', null, ['class' => 'form-control']) }}-->
  <!--                          </td>-->
  <!--                        </tr>-->
  <!--                        <tr>-->
  <!--                          <td>-->
  <!--                          <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(sdt{{ $service->id }}).submit();">Suggest Date & Time</button>-->
  <!--                        </td>-->
  <!--                        </tr>-->
  <!--                          </tbody>-->
  <!--                          </form>-->
  <!--                        </table>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                      @endif-->
  <!--                      @endif-->


  <!--                    </div>-->
  <!--                  </div>-->
  <!--              </div>-->
  <!--          </div>-->
  <!--          @endif-->
  <!--          @endforeach-->

  <!--        </div>-->
  <!--    </div>-->
  <!--</div>-->
  <!-- Open Consultation Box Ends -->








  <!-- Upcoming Consultation Box Starts -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">UPCOMING</div>-->
  <!--        <div class="panel-body">-->

  <!--        @foreach($services as $service)-->
  <!--          @if($service->status == 'upcoming')-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-heading">-->
  <!--                      <p style="color:#a00">{{ Carbon\Carbon::parse($service->date)->diffInDays(Carbon\Carbon::now()) }} days to Go!</p>-->
  <!--                    </div>-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      @if($service->date != NULL)-->
  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>-->
  <!--                      <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>-->
  <!--                      @endif-->

  <!--                      @foreach($service->Documents as $document)-->
  <!--                      @if($document->sender == 'adviser')-->
  <!--                      <p><button class="btn btn-default btn-sm btn-block">-->
  <!--                      <i class="badge badge-default">{{ $service->Documents->where('sender', 'adviser')->count() }}</i> Sent Document-->
  <!--                      </button></p>-->
  <!--                      @else-->
  <!--                      <p><button class="btn btn-default btn-sm btn-block">-->
  <!--                      <i class="badge badge-default">{{ $service->Documents->where('sender', 'user')->count() }}</i> Document Received-->
  <!--                      </button></p>-->
  <!--                      @endif-->
  <!--                      @endforeach-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>-->
  <!--                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>-->
  <!--                      @if(isset($service->location))-->
  <!--                          <p><strong>Location</strong> : {{ $service->location->address }}-->
  <!--                          @endif</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>-->
  <!--                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>-->


  <!--                        <p><button class="btn btn-default btn-sm btn-block" data-target="#cad2{{$service->id}}" data-toggle="modal">Change Adviser</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="cad2{{$service->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Change Adviser for {{ $service->availability->consultation_mode }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         {!! Form::open(['route' => ['admin.bookings.changeAdviser', $service->id], 'method' => 'POST', 'id' => 'cd2'.$service->id]) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('user_id', 'Select Adviser*') }}-->
  <!--                           <select name="user_id" class="form-control">-->
  <!--                             @foreach($advisers as $adviser)-->
  <!--                             <option value="{{$adviser->id}}">{{$adviser->name}}</option>-->
  <!--                             @endforeach-->
  <!--                           </select>-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cd2{{ $service->id }}).submit();">submit</button>-->
  <!--                         </div>-->
  <!--                        {!! Form::close() !!}-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->


  <!--                        <p><button class="btn btn-default btn-sm btn-block" data-target="#rsb1{{$service->id}}" data-toggle="modal">Reschedule Appointment</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="rsb1{{$service->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Reschedule Appointment</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                        {!! Form::open(['route' => ['admin.bookings.reschedule', $service->id], 'method' => 'POST', 'id' => 'rs1'.$service->id, 'class' => 'form-inline']) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('date', 'Date') }}-->
  <!--                           {{ Form::date('date', null, ['class' => 'form-control', 'required' => '']) }}-->
  <!--                           {{ Form::label('time', 'Time') }}-->
  <!--                           {{ Form::time('time', null, ['class' => 'form-control', 'required' => '']) }}-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(rs1{{ $service->id }}).submit();">Submit</button>-->
  <!--                         </div>-->
  <!--                        {!! Form::close() !!}-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->

  <!--                        {!! Form::open(['route' => ['admin.services.document', $service->id], 'method' => 'POST', 'files' => true]) !!}-->
  <!--                        <input type="file" name="doc" id="selectedFile2{{$service->id}}" style="display:none" onchange='this.form.submit();' required>-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block" onclick="document.getElementById('selectedFile2{{$service->id}}').click();">Send Document</button></p>-->
  <!--                        {!! Form::close() !!}-->

  <!--                        <p><button class="btn btn-default btn-sm btn-block">View Detail</button></p>-->


  <!--                        @if($service->availability->consultation_mode == 'phone_call')-->
  <!--                        @if(Carbon\Carbon::parse($service->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)-->
  <!--                          <button class="btn btn-default btn-sm btn-block" data-target="#pcs2{{$service->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        @if($service->availability->consultation_mode == 'video_call')-->
  <!--                        @if(Carbon\Carbon::parse($service->date)->diffInMinutes(Carbon\Carbon::now()) >= 30)-->
  <!--                          <button class="btn btn-default btn-sm btn-block" data-target="#pcs2{{$service->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        @if($service->availability->consultation_mode == 'personal_meeting')-->
  <!--                        @if(Carbon\Carbon::parse($service->date)->diffInMinutes(Carbon\Carbon::now()) >= 60)-->
  <!--                          <button class="btn btn-default btn-sm btn-block" data-target="#pcs2{{$service->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        @if($service->availability->consultation_mode == 'chat')-->
  <!--                        @if(Carbon\Carbon::parse($service->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)-->
  <!--                          <button class="btn btn-default btn-sm btn-block" data-target="#pcs2{{$service->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcs2{{$service->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Cancellation for {{ $service->service->name }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         {!! Form::open(['route' => ['admin.services.cancel', $service->id], 'method' => 'POST', 'id' => 'cs2'.$service->id]) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('reason', 'Reason for cancel Service') }}-->
  <!--                           <select name="reason" class="form-control">-->
  <!--                             <option>Not available on scheduled time.</option>-->
  <!--                             <option>My reason is not listed.</option>-->
  <!--                           </select>-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cs2{{ $service->id }}).submit();">Submit</button>-->
  <!--                         </div>-->
  <!--                        {!! Form::close() !!}-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->

  <!--                      </div>-->
  <!--                    </div>-->
  <!--                  </div>-->
  <!--              </div>-->
  <!--          </div>-->
  <!--          @endif-->
  <!--          @endforeach-->

  <!--        </div>-->
  <!--    </div>-->
  <!--</div>-->
  <!-- Upcoming Consultation Box Ends -->








  <!-- Done Consultation Box Starts -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">DONE</div>-->

  <!--        <div class="panel-body">-->

  <!--        @foreach($services as $service)-->
  <!--        @if($service->status =='done')-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      @if($service->date != NULL)-->
  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>-->
  <!--                      <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>-->
  <!--                      @endif-->
  <!--                      @if(isset($service->location))-->
  <!--                      <p><strong>Location</strong> : {{ $service->location->address }}</p>-->
  <!--                      @endif-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>-->
  <!--                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block"><i class="badge badge-default">3</i> View Documents</button></p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>-->
  <!--                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block">Raise Dispute</button></p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>-->
  <!--                        <p>Rating</p>-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block">chat</button></p>-->

  <!--                      </div>-->
  <!--                    </div>-->
  <!--                  </div>-->
  <!--              </div>-->
  <!--          </div>-->
  <!--          @endif-->
  <!--          @endforeach-->

  <!--        </div>-->
  <!--    </div>-->
  <!--</div>-->
  <!-- Done Consultation Box ends -->






  <!-- Im-process Consultation Box Starts -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">INPROCESS</div>-->
  <!--        <div class="panel-body">-->

  <!--        @foreach($services as $service)-->
  <!--          @if($service->status == 'inprocess')-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      @if($service->date != NULL)-->
  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>-->
  <!--                      <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>-->
  <!--                      @endif-->

  <!--                      @foreach($service->Documents as $document)-->
  <!--                      @if($document->sender == 'adviser')-->
  <!--                      <p><button class="btn btn-default btn-sm btn-block">-->
  <!--                      <i class="badge badge-default">{{ $service->Documents->where('sender', 'adviser')->count() }}</i> Sent Document-->
  <!--                      </button></p>-->
  <!--                      @else-->
  <!--                      <p><button class="btn btn-default btn-sm btn-block">-->
  <!--                      <i class="badge badge-default">{{ $service->Documents->where('sender', 'user')->count() }}</i> Document Received-->
  <!--                      </button></p>-->
  <!--                      @endif-->
  <!--                      @endforeach-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>-->
  <!--                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>-->
  <!--                         @if(isset($service->location))-->
  <!--                          <p><strong>Location</strong> : {{ $service->location->address }}-->
  <!--                          @endif</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>-->
  <!--                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>-->

  <!--                        <p><button class="btn btn-default btn-sm btn-block">Reschedule Appointment</button></p>-->

  <!--                        {!! Form::open(['route' => ['admin.services.document', $service->id], 'method' => 'POST', 'files' => true]) !!}-->
  <!--                        <input type="file" name="doc" id="selectedFile1" style="display:none" onchange='this.form.submit();' required>-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block" onclick="document.getElementById('selectedFile1').click();">Send Document</button></p>-->
  <!--                        {!! Form::close() !!}-->

  <!--                        <p><button class="btn btn-default btn-sm btn-block">View Detail</button></p>-->

  <!--                      </div>-->
  <!--                    </div>-->
  <!--                  </div>-->
  <!--              </div>-->
  <!--          </div>-->
  <!--          @endif-->
  <!--          @endforeach-->

  <!--        </div>-->
  <!--    </div>-->
  <!--</div>-->
  <!-- In-Process Consultation Box ends -->







  <!-- cancelled Consultation Box Starts -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">CANCELLED</div>-->

  <!--        <div class="panel-body">-->

  <!--        @foreach($services as $service)-->
  <!--        @if($service->status =='canceled')-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      @if($service->date != NULL)-->
  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>-->
  <!--                      <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>-->
  <!--                      @endif-->

  <!--                      <p style="text-transform:capitalize"><strong>Cancel By</strong> :{{ $service->BookingCancel['cancel_by'] }}</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>-->
  <!--                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>-->
  <!--                        <p><strong>Booking Date</strong> : {{ date('jS M Y' ,strtotime($service->created_at)) }}, {{ date('g:i A' ,strtotime($service->created_at)) }}</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>-->
  <!--                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>-->
  <!--                        <p><strong>Cancelled On</strong> : {{ date('jS M Y' ,strtotime($service->updated_at)) }}, {{ date('g:i A' ,strtotime($service->updated_at)) }}</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>-->
  <!--                        <p><strong>Cancellation Reason</strong> : {{ $service->BookingCancel['reason'] }}</p>-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block">Payment Status</button></p>-->

  <!--                      </div>-->
  <!--                    </div>-->
  <!--                  </div>-->
  <!--              </div>-->
  <!--          </div>-->
  <!--          @endif-->
  <!--          @endforeach-->

  <!--        </div>-->
  <!--    </div>-->
  <!--</div>-->
  <!-- Cancelled Consultation Box Ends -->







  <!-- Dispute Consultation Box Starts -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">DISPUTED</div>-->

  <!--        <div class="panel-body">-->

  <!--        @foreach($services as $service)-->
  <!--        @if($service->status =='dispute')-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($service->user->where('id',$service->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $service->user->where('id',$service->client_id)->first()->basicDetail->firstname }} {{ $service->user->where('id',$service->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      @if($service->date != NULL)-->
  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($service->date)) }}</p>-->
  <!--                      <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($service->date)) }}</p>-->

  <!--                      <p><strong>Raised By</strong> : User </p>-->
  <!--                      <p><strong>Raised On</strong> : {{ date('jS M Y' ,strtotime($service->updated_at)) }}, {{ date('g:i A' ,strtotime($service->updated_at)) }}</p>-->

  <!--                      @endif-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Name : </small> <strong> {{ $service->service->name }}</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $service->availability->consultation_mode }}</p>-->
  <!--                        <p><strong>Duration</strong> : {{ $service->service->duration }} min</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Service Fees : </small> <strong>INR {{ $service->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Validity</strong> : {{ $service->service->validity }} days</p>-->
  <!--                        <p><strong>Frequency</strong> : {{ $service->service->frequency }}</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-3">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $service->id }}</strong></p>-->
  <!--                        <p><strong>Dispute Status</strong> : {{ $service->dispute->status }}</p>-->
  <!--                        <p><strong>Dispute Reason</strong> : {{ $service->dispute->reason }}</p>-->

  <!--                      </div>-->
  <!--                    </div>-->
  <!--                  </div>-->
  <!--              </div>-->
  <!--          </div>-->
  <!--          @endif-->
  <!--          @endforeach-->

  <!--        </div>-->
  <!--    </div>-->
  <!--</div>-->
  <!-- Dispute Consultation Box Ends -->




</div>
</div>
</section>

@endsection

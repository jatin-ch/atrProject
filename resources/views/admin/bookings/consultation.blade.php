@extends('layouts.admin')
@section('title') | Appointments | Consultations @endsection
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
    <h2>Appointments</h2>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Appointments</a></li>
      <li class="active">All</li>
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
                    <li class="menu" role="presentation"><a href="#done" aria-controls="done" role="tab" data-toggle="tab">Done</a></li>
                    <li class="menu" role="presentation"><a href="#cancel" aria-controls="#cancel" role="tab" data-toggle="tab">Cancelled</a></li>
                 </ul>

                 <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="open">
                         @foreach($opens as $open)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-4">

                          <p><small>Name : </small>
                          <strong>
                            @if($open->user->where('id',$open->client_id)->first()->basicDetail->gender == 'M')
                            Mr.
                            @else
                            Ms.
                            @endif
                          {{ $open->user->where('id',$open->client_id)->first()->basicDetail->firstname }} {{ $open->user->where('id',$open->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($open->date)) }}</p>
                          <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($open->date)) }}</p>

                        </div>
                        <div class="col-md-4">

                          <p><small>Consultation Fees : </small> <strong>INR {{ $open->total_pay }}/-</strong></p>

                          <p><strong>Mode</strong> : {{ $open->availability->consultation_mode }}</p>
                          @if(isset($open->location))
                          <p><strong>Location</strong> : {{ $open->location->address }}</p>
                          @endif

                        </div>
                        <div class="col-md-4">

                          <p><small>Booking Id : </small> <strong>{{ $open->id }}</strong></p>

                          <p><button class="btn btn-default btn-sm btn-block" data-target="#cad1{{$open->id}}" data-toggle="modal">Change Adviser</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="cad1{{$open->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Change Adviser for {{ $open->availability->consultation_mode }}</h4>
                          </div>
                          <div class="modal-body">
                           {!! Form::open(['route' => ['admin.bookings.changeAdviser', $open->id], 'method' => 'POST', 'id' => 'cd1'.$open->id]) !!}
                           <div class="form-group">
                             {{ Form::label('user_id', 'Select Adviser*') }}
                             <select name="user_id" class="form-control">
                               @foreach($advisers as $adviser)
                               <option value="{{$adviser->id}}">{{$adviser->name}}</option>
                               @endforeach
                             </select>
                           </div>
                          <div class="form-group">
                          <button class="btn btn-primary btn-sm" onclick="document.getElementById(cd1{{ $open->id }}).submit();">submit</button>
                           </div>
                          {!! Form::close() !!}
                          </div>
                          </div>
                          </div>
                          </div>


                          <p> Confirmation Awaited</p>
                           @if($open->user->expertDetail->type == 'professional')
                           {!! Form::open(['route' => ['admin.consultations.confirm', $open->id], 'method' => 'POST', 'id' => 'cm'.$open->id]) !!}
                            <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cm{{ $open->id }}).submit();">Confirm Consultation</button>
                           {!! Form::close() !!}
                           @endif


                          <p style="margin-top:15px"><button class="btn btn-default btn-sm btn-block" data-target="#pcc1{{$open->id}}" data-toggle="modal">Cancel Appointment</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcc1{{$open->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Cancel Consultation for {{ $open->availability->consultation_mode }}</h4>
                          </div>
                          <div class="modal-body">
                           {!! Form::open(['route' => ['admin.consultations.cancel', $open->id], 'method' => 'POST', 'id' => 'cc1'.$open->id]) !!}
                           <div class="form-group">
                             {{ Form::label('reason', 'Reason for cancel Consultation') }}
                             <select name="reason" class="form-control">
                               <option>Not available on scheduled time.</option>
                               <option>My reason is not listed.</option>
                             </select>
                           </div>
                          <div class="form-group">
                          <button class="btn btn-primary btn-sm" onclick="document.getElementById(cc1{{ $open->id }}).submit();">submit</button>
                           </div>
                          {!! Form::close() !!}
                          </div>
                          </div>
                          </div>
                          </div>

                        </div>



                        @if($open->user->expertDetail->type == 'individual')
                        @if($open->BookingDates->where('suggest_by', 'user')->count() > 0)
                        <div class="col-md-12">
                          {!! Form::open(['route' => ['admin.consultations.confirm', $open->id], 'method' => 'POST', 'id' => 'cmdt'.$open->id]) !!}
                          <table class="table">
                            <tbody>
                              <td style="border:none">Client choose Dates for the Appointment</td>
                              @foreach($open->BookingDates as $date)
                              @if($date->suggest_by == 'user')
                              <td style="border:none">
                                <input type="radio" name="date" value="{{ $date->date }}" required>{{ date('jS M Y, H:i A' ,strtotime($date->date)) }}
                              </td>
                              @endif
                              @endforeach
                              <td style="border:none">
                                <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cmdt{{ $open->id }}).submit();">Confirm Consultation</button>
                              </td>
                            </tbody>
                          </table>

                          {!! Form::close() !!}
                        </div>



                        <p><button class="btn btn-default btn-sm btn-block" data-target="#scc1{{$open->id}}" data-toggle="modal">Suggest New Date & Time</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="scc1{{$open->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Suggest New Date & Time for {{ $open->user->where('id',$open->client_id)->first()->basicDetail->firstname }} {{ $open->user->where('id',$open->client_id)->first()->basicDetail->lastname }}</h4>
                          </div>
                          <div class="modal-body">
                           <table class="table">
                            <form action="{{ route('admin.consultations.confirm', $open->id) }}" method="POST", id="smf{{$open->id}}">
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
                              <!-- {{ Form::submit('Suggest Date & Time', ['class' => 'btn btn-default btn-sm btn-block']) }} -->
                            <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(smf{{ $open->id }}).submit();">Suggest Date & Time</button>
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
            @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane" id="upcoming">
                         @foreach($upcomings as $upcoming)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <p style="color:#a00">{{ Carbon\Carbon::parse($upcoming->date)->diffInDays(Carbon\Carbon::now()) }} days to Go!</p>
                      </div>
                      <div class="panel-body">
                        <div class="col-md-4">

                          <p><small>Name : </small>
                          <strong>
                          @if($upcoming->user->where('id',$upcoming->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $upcoming->user->where('id',$upcoming->client_id)->first()->basicDetail->firstname }} {{ $upcoming->user->where('id',$upcoming->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($upcoming->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($upcoming->date)) }}</p>

                        @foreach($upcoming->Documents as $document)
                        @if($document->sender == 'adviser')
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $upcoming->Documents->where('sender', 'adviser')->count() }}</i> Sent Document
                        </button></p>
                        @else
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $upcoming->Documents->where('sender', 'user')->count() }}</i> Document Received
                        </button></p>
                        @endif
                        @endforeach

                        </div>
                        <div class="col-md-4">

                          <p><small>Consultation Fees : </small> <strong>INR {{ $upcoming->total_pay }}/-</strong></p>

                          <p><strong>Mode</strong> : {{ $upcoming->availability->consultation_mode }}</p>
                          @if(isset($upcoming->location))
                          <p><strong>Location</strong> : {{ $upcoming->location->address }}</p>
                          @endif

                        </div>
                        <div class="col-md-4">

                          <p><small>Booking Id : </small> <strong>{{ $upcoming->id }}</strong></p>

                          <p><button class="btn btn-default btn-sm btn-block" data-target="#cad2{{$upcoming->id}}" data-toggle="modal">Change Adviser</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="cad2{{$upcoming->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Change Adviser for {{ $upcoming->availability->consultation_mode }}</h4>
                          </div>
                          <div class="modal-body">
                           {!! Form::open(['route' => ['admin.bookings.changeAdviser', $upcoming->id], 'method' => 'POST', 'id' => 'cd2'.$upcoming->id]) !!}
                           <div class="form-group">
                             {{ Form::label('user_id', 'Select Adviser*') }}
                             <select name="user_id" class="form-control">
                               @foreach($advisers as $adviser)
                               <option value="{{$adviser->id}}">{{$adviser->name}}</option>
                               @endforeach
                             </select>
                           </div>
                          <div class="form-group">
                          <button class="btn btn-primary btn-sm" onclick="document.getElementById(cd2{{ $upcoming->id }}).submit();">submit</button>
                           </div>
                          {!! Form::close() !!}
                          </div>
                          </div>
                          </div>
                          </div>

                          <p><button class="btn btn-default btn-sm btn-block" data-target="#rsb1{{$upcoming->id}}" data-toggle="modal">Reschedule Appointment</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="rsb1{{$upcoming->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Reschedule Appointment</h4>
                          </div>
                          <div class="modal-body">
                          {!! Form::open(['route' => ['admin.bookings.reschedule', $upcoming->id], 'method' => 'POST', 'id' => 'rs1'.$upcoming->id, 'class' => 'form-inline']) !!}
                           <div class="form-group">
                             {{ Form::label('date', 'Date') }}
                             {{ Form::date('date', null, ['class' => 'form-control', 'required' => '']) }}
                             {{ Form::label('time', 'Time') }}
                             {{ Form::time('time', null, ['class' => 'form-control', 'required' => '']) }}
                           </div>
                          <div class="form-group">
                          <button class="btn btn-primary btn-sm" onclick="document.getElementById(rs1{{ $upcoming->id }}).submit();">Submit</button>
                           </div>
                          {!! Form::close() !!}
                          </div>
                          </div>
                          </div>
                          </div>

                          {!! Form::open(['route' => ['admin.consultations.document', $upcoming->id], 'method' => 'POST', 'files' => true, 'id' =>'cbd'.$upcoming->id]) !!}
                          <input type="file" name="doc" id="selectedFile{{$upcoming->id}}" style="display:none" onchange='this.form.submit();' required>
                          <p><button class="btn btn-default btn-sm btn-block" onclick="document.getElementById('selectedFile{{$upcoming->id}}').click();">Send Document</button></p>
                          {!! Form::close() !!}

                          <p><button class="btn btn-default btn-sm btn-block">View Detail</button></p>

                          @if($upcoming->availability->consultation_mode == 'Phone Call')
                          @if(Carbon\Carbon::parse($upcoming->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$upcoming->id}}" data-toggle="modal">Cancel Appointment</button>
                          @endif
                          @endif

                          @if($upcoming->availability->consultation_mode == 'Video Call')
                          @if(Carbon\Carbon::parse($upcoming->date)->diffInMinutes(Carbon\Carbon::now()) >= 30)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$upcoming->id}}" data-toggle="modal">Cancel Appointment</button>
                          @endif
                          @endif

                          @if($upcoming->availability->consultation_mode == 'Personal Meeting')
                          @if(Carbon\Carbon::parse($upcoming->date)->diffInMinutes(Carbon\Carbon::now()) >= 60)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$upcoming->id}}" data-toggle="modal">Cancel Appointment</button>
                          @endif
                          @endif

                          @if($upcoming->availability->consultation_mode == 'Chat')
                          @if(Carbon\Carbon::parse($upcoming->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$upcoming->id}}" data-toggle="modal">Cancel Appointment</button>
                          @endif
                          @endif

                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcc2{{$upcoming->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Cancel Consultation for {{ $upcoming->availability->consultation_mode }}</h4>
                          </div>
                          <div class="modal-body">
                           {!! Form::open(['route' => ['admin.consultations.cancel', $upcoming->id], 'method' => 'POST', 'id' => 'cc2'.$upcoming->id]) !!}
                           <div class="form-group">
                             {{ Form::label('reason', 'Reason for cancel Consultation') }}
                             <select name="reason" class="form-control">
                               <option>Not available on scheduled time.</option>
                               <option>My reason is not listed.</option>
                             </select>
                           </div>
                          <div class="form-group">
                          <button class="btn btn-primary btn-sm" onclick="document.getElementById(cc2{{ $upcoming->id }}).submit();">Submit</button>
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
            @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane" id="done">
                         @foreach($dones as $done)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-4">

                          <p><small>Name : </small>
                          <strong>
                          @if($done->user->where('id',$done->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $done->user->where('id',$done->client_id)->first()->basicDetail->firstname }} {{ $done->user->where('id',$done->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($done->date)) }}</p>
                          <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($done->date)) }}</p>

                        </div>
                        <div class="col-md-4">

                          <p><small>Consultation Fees : </small> <strong>INR {{ $done->total_pay }}/-</strong></p>

                          <p><strong>Mode</strong> : {{ $done->availability->consultation_mode }}</p>
                          @if(isset($done->location))
                          <p><strong>Location</strong> : {{ $done->location->address }}</p>
                          @endif

                        </div>
                        <div class="col-md-4">

                          <p><small>Booking Id : </small> <strong>{{ $done->id }}</strong></p>
                          @if(Carbon\Carbon::now()->diffInHours(Carbon\Carbon::parse($done->date)) <= 48)
                          <p><button class="btn btn-default btn-sm btn-block">Chat</button></p>
                          @endif
                          <p><button class="btn btn-default btn-sm btn-block"><i class="badge badge-default">3</i> View Documents</button></p>

                        </div>
                      </div>
                    </div>
                </div>
            </div>
            @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane" id="cancel">
                         @foreach($cancels as $cancel)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-4">

                          <p><small>Name : </small>
                          <strong>
                          @if($cancel->user->where('id',$cancel->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $cancel->user->where('id',$cancel->client_id)->first()->basicDetail->firstname }} {{ $cancel->user->where('id',$cancel->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        @if($cancel->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($cancel->date)) }}, {{ date('g:i A' ,strtotime($cancel->date)) }}</p>
                        @endif
                        <p><strong>Booking Date</strong> : {{ date('jS M Y' ,strtotime($cancel->created_at)) }}, {{ date('g:i A' ,strtotime($cancel->created_at)) }}</p>
                        <p><strong>Cancelled On</strong> : {{ date('jS M Y' ,strtotime($cancel->updated_at)) }}, {{ date('g:i A' ,strtotime($cancel->updated_at)) }}</p>
                        <p><strong>Cancel By</strong> :
                          @if($cancel->BookingCancel['cancel_by'] == 'user')
                          Adviser
                          @else
                          User
                          @endif</p>

                        </div>
                        <div class="col-md-4">

                          <p><small>Consultation Fees : </small> <strong>INR {{ $cancel->total_pay }}/-</strong></p>

                          <p><strong>Mode</strong> : {{ $cancel->availability->consultation_mode }}</p>
                          @if(isset($cancel->location))
                          <p><strong>Location</strong> : {{ $cancel->location->address }}</p>
                          @endif

                        </div>
                        <div class="col-md-4">
                          <p><small>Booking Id : </small> <strong>{{ $cancel->id }}</strong></p>
                        <p><strong>Cancellation Reason</strong> : {{ $cancel->BookingCancel['reason'] }}</p>
                          <p><button class="btn btn-default btn-sm btn-block">Payment Status</button></p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            @endforeach
                    </div>
                 </div>
            </div>
    </div>

  <!-- Open Consultation Box starts -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">OPEN</div>-->
  <!--        <div class="panel-body">-->
  <!--          @foreach($opens as $open)-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                          @if($open->user->where('id',$open->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                          Mr.-->
  <!--                          @else-->
  <!--                          Ms.-->
  <!--                          @endif-->
  <!--                        {{ $open->user->where('id',$open->client_id)->first()->basicDetail->firstname }} {{ $open->user->where('id',$open->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($open->date)) }}</p>-->
  <!--                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($open->date)) }}</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Consultation Fees : </small> <strong>INR {{ $open->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $open->availability->consultation_mode }}</p>-->
  <!--                        @if(isset($open->location))-->
  <!--                        <p><strong>Location</strong> : {{ $open->location->address }}</p>-->
  <!--                        @endif-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $open->id }}</strong></p>-->

  <!--                        <p><button class="btn btn-default btn-sm btn-block" data-target="#cad1{{$open->id}}" data-toggle="modal">Change Adviser</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="cad1{{$open->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Change Adviser for {{ $open->availability->consultation_mode }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         {!! Form::open(['route' => ['admin.bookings.changeAdviser', $open->id], 'method' => 'POST', 'id' => 'cd1'.$open->id]) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('user_id', 'Select Adviser*') }}-->
  <!--                           <select name="user_id" class="form-control">-->
  <!--                             @foreach($advisers as $adviser)-->
  <!--                             <option value="{{$adviser->id}}">{{$adviser->name}}</option>-->
  <!--                             @endforeach-->
  <!--                           </select>-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cd1{{ $open->id }}).submit();">submit</button>-->
  <!--                         </div>-->
  <!--                        {!! Form::close() !!}-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->


  <!--                        <p> Confirmation Awaited</p>-->
  <!--                         @if($open->user->expertDetail->type == 'professional')-->
  <!--                         {!! Form::open(['route' => ['admin.consultations.confirm', $open->id], 'method' => 'POST', 'id' => 'cm'.$open->id]) !!}-->
  <!--                          <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cm{{ $open->id }}).submit();">Confirm Consultation</button>-->
  <!--                         {!! Form::close() !!}-->
  <!--                         @endif-->


  <!--                        <p><button class="btn btn-default btn-sm btn-block" data-target="#pcc1{{$open->id}}" data-toggle="modal">Cancel Appointment</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcc1{{$open->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Cancel Consultation for {{ $open->availability->consultation_mode }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         {!! Form::open(['route' => ['admin.consultations.cancel', $open->id], 'method' => 'POST', 'id' => 'cc1'.$open->id]) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('reason', 'Reason for cancel Consultation') }}-->
  <!--                           <select name="reason" class="form-control">-->
  <!--                             <option>Not available on scheduled time.</option>-->
  <!--                             <option>My reason is not listed.</option>-->
  <!--                           </select>-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cc1{{ $open->id }}).submit();">submit</button>-->
  <!--                         </div>-->
  <!--                        {!! Form::close() !!}-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->

  <!--                      </div>-->



  <!--                      @if($open->user->expertDetail->type == 'individual')-->
  <!--                      @if($open->BookingDates->where('suggest_by', 'user')->count() > 0)-->
  <!--                      <div class="col-md-12">-->
  <!--                        {!! Form::open(['route' => ['admin.consultations.confirm', $open->id], 'method' => 'POST', 'id' => 'cmdt'.$open->id]) !!}-->
  <!--                        <table class="table">-->
  <!--                          <tbody>-->
  <!--                            <td style="border:none">Client choose Dates for the Appointment</td>-->
  <!--                            @foreach($open->BookingDates as $date)-->
  <!--                            @if($date->suggest_by == 'user')-->
  <!--                            <td style="border:none">-->
  <!--                              <input type="radio" name="date" value="{{ $date->date }}" required>{{ date('jS M Y, H:i A' ,strtotime($date->date)) }}-->
  <!--                            </td>-->
  <!--                            @endif-->
  <!--                            @endforeach-->
  <!--                            <td style="border:none">-->
  <!--                              <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cmdt{{ $open->id }}).submit();">Confirm Consultation</button>-->
  <!--                            </td>-->
  <!--                          </tbody>-->
  <!--                        </table>-->

  <!--                        {!! Form::close() !!}-->
  <!--                      </div>-->



  <!--                      <p><button class="btn btn-default btn-sm btn-block" data-target="#scc1{{$open->id}}" data-toggle="modal">Suggest New Date & Time</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="scc1{{$open->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Suggest New Date & Time for {{ $open->user->where('id',$open->client_id)->first()->basicDetail->firstname }} {{ $open->user->where('id',$open->client_id)->first()->basicDetail->lastname }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         <table class="table">-->
  <!--                          <form action="{{ route('admin.consultations.confirm', $open->id) }}" method="POST", id="smf{{$open->id}}">-->
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
                              <!-- {{ Form::submit('Suggest Date & Time', ['class' => 'btn btn-default btn-sm btn-block']) }} -->
  <!--                          <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(smf{{ $open->id }}).submit();">Suggest Date & Time</button>-->
  <!--                        </td>-->
  <!--                        </tr>-->
  <!--                          </tbody>-->
  <!--                          </form>-->
  <!--                        </table>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                    </div>-->
  <!--                  </div>-->
  <!--              </div>-->
  <!--          </div>-->
  <!--          @endforeach-->

  <!--        </div>-->
  <!--    </div>-->
  <!--</div>-->
  <!-- Open consultations Box ends  -->










  <!-- Upcoming Consultations Box Starts  -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">UPCOMING</div>-->
  <!--        <div class="panel-body">-->
  <!--          @foreach($upcomings as $upcoming)-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-heading">-->
  <!--                      <p style="color:#a00">{{ Carbon\Carbon::parse($upcoming->date)->diffInDays(Carbon\Carbon::now()) }} days to Go!</p>-->
  <!--                    </div>-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($upcoming->user->where('id',$upcoming->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $upcoming->user->where('id',$upcoming->client_id)->first()->basicDetail->firstname }} {{ $upcoming->user->where('id',$upcoming->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($upcoming->date)) }}</p>-->
  <!--                      <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($upcoming->date)) }}</p>-->

  <!--                      @foreach($upcoming->Documents as $document)-->
  <!--                      @if($document->sender == 'adviser')-->
  <!--                      <p><button class="btn btn-default btn-sm btn-block">-->
  <!--                      <i class="badge badge-default">{{ $upcoming->Documents->where('sender', 'adviser')->count() }}</i> Sent Document-->
  <!--                      </button></p>-->
  <!--                      @else-->
  <!--                      <p><button class="btn btn-default btn-sm btn-block">-->
  <!--                      <i class="badge badge-default">{{ $upcoming->Documents->where('sender', 'user')->count() }}</i> Document Received-->
  <!--                      </button></p>-->
  <!--                      @endif-->
  <!--                      @endforeach-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Consultation Fees : </small> <strong>INR {{ $upcoming->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $upcoming->availability->consultation_mode }}</p>-->
  <!--                        @if(isset($upcoming->location))-->
  <!--                        <p><strong>Location</strong> : {{ $upcoming->location->address }}</p>-->
  <!--                        @endif-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $upcoming->id }}</strong></p>-->

  <!--                        <p><button class="btn btn-default btn-sm btn-block" data-target="#cad2{{$upcoming->id}}" data-toggle="modal">Change Adviser</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="cad2{{$upcoming->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Change Adviser for {{ $upcoming->availability->consultation_mode }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         {!! Form::open(['route' => ['admin.bookings.changeAdviser', $upcoming->id], 'method' => 'POST', 'id' => 'cd2'.$upcoming->id]) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('user_id', 'Select Adviser*') }}-->
  <!--                           <select name="user_id" class="form-control">-->
  <!--                             @foreach($advisers as $adviser)-->
  <!--                             <option value="{{$adviser->id}}">{{$adviser->name}}</option>-->
  <!--                             @endforeach-->
  <!--                           </select>-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cd2{{ $upcoming->id }}).submit();">submit</button>-->
  <!--                         </div>-->
  <!--                        {!! Form::close() !!}-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->

  <!--                        <p><button class="btn btn-default btn-sm btn-block" data-target="#rsb1{{$upcoming->id}}" data-toggle="modal">Reschedule Appointment</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="rsb1{{$upcoming->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Reschedule Appointment</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                        {!! Form::open(['route' => ['admin.bookings.reschedule', $upcoming->id], 'method' => 'POST', 'id' => 'rs1'.$upcoming->id, 'class' => 'form-inline']) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('date', 'Date') }}-->
  <!--                           {{ Form::date('date', null, ['class' => 'form-control', 'required' => '']) }}-->
  <!--                           {{ Form::label('time', 'Time') }}-->
  <!--                           {{ Form::time('time', null, ['class' => 'form-control', 'required' => '']) }}-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(rs1{{ $upcoming->id }}).submit();">Submit</button>-->
  <!--                         </div>-->
  <!--                        {!! Form::close() !!}-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->

  <!--                        {!! Form::open(['route' => ['admin.consultations.document', $upcoming->id], 'method' => 'POST', 'files' => true, 'id' =>'cbd'.$upcoming->id]) !!}-->
  <!--                        <input type="file" name="doc" id="selectedFile{{$upcoming->id}}" style="display:none" onchange='this.form.submit();' required>-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block" onclick="document.getElementById('selectedFile{{$upcoming->id}}').click();">Send Document</button></p>-->
  <!--                        {!! Form::close() !!}-->

  <!--                        <p><button class="btn btn-default btn-sm btn-block">View Detail</button></p>-->

  <!--                        @if($upcoming->availability->consultation_mode == 'Phone Call')-->
  <!--                        @if(Carbon\Carbon::parse($upcoming->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)-->
  <!--                        <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$upcoming->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        @if($upcoming->availability->consultation_mode == 'Video Call')-->
  <!--                        @if(Carbon\Carbon::parse($upcoming->date)->diffInMinutes(Carbon\Carbon::now()) >= 30)-->
  <!--                        <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$upcoming->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        @if($upcoming->availability->consultation_mode == 'Personal Meeting')-->
  <!--                        @if(Carbon\Carbon::parse($upcoming->date)->diffInMinutes(Carbon\Carbon::now()) >= 60)-->
  <!--                        <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$upcoming->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        @if($upcoming->availability->consultation_mode == 'Chat')-->
  <!--                        @if(Carbon\Carbon::parse($upcoming->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)-->
  <!--                        <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$upcoming->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcc2{{$upcoming->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Cancel Consultation for {{ $upcoming->availability->consultation_mode }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         {!! Form::open(['route' => ['admin.consultations.cancel', $upcoming->id], 'method' => 'POST', 'id' => 'cc2'.$upcoming->id]) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('reason', 'Reason for cancel Consultation') }}-->
  <!--                           <select name="reason" class="form-control">-->
  <!--                             <option>Not available on scheduled time.</option>-->
  <!--                             <option>My reason is not listed.</option>-->
  <!--                           </select>-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cc2{{ $upcoming->id }}).submit();">Submit</button>-->
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
  <!--          @endforeach-->

  <!--        </div>-->
  <!--    </div>-->
  <!--</div>-->
  <!-- Upcoming Consultations Box Ends  -->









  <!-- Done Consultations Box starts  -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">DONE</div>-->
  <!--        <div class="panel-body">-->
  <!--         @foreach($dones as $done)-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($done->user->where('id',$done->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $done->user->where('id',$done->client_id)->first()->basicDetail->firstname }} {{ $done->user->where('id',$done->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($done->date)) }}</p>-->
  <!--                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($done->date)) }}</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Consultation Fees : </small> <strong>INR {{ $done->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $done->availability->consultation_mode }}</p>-->
  <!--                        @if(isset($done->location))-->
  <!--                        <p><strong>Location</strong> : {{ $done->location->address }}</p>-->
  <!--                        @endif-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $done->id }}</strong></p>-->
  <!--                        @if(Carbon\Carbon::now()->diffInHours(Carbon\Carbon::parse($done->date)) <= 48)-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block">Chat</button></p>-->
  <!--                        @endif-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block"><i class="badge badge-default">3</i> View Documents</button></p>-->

  <!--                      </div>-->
  <!--                    </div>-->
  <!--                  </div>-->
  <!--              </div>-->
  <!--          </div>-->
  <!--          @endforeach-->

  <!--        </div>-->
  <!--    </div>-->
  <!--</div>-->
  <!-- Done Consultations Box ends  -->









  <!-- cancelled Consultations Box starts  -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">CANCELLED</div>-->
  <!--        <div class="panel-body">-->

  <!--         @foreach($cancels as $cancel)-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($cancel->user->where('id',$cancel->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $cancel->user->where('id',$cancel->client_id)->first()->basicDetail->firstname }} {{ $cancel->user->where('id',$cancel->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      @if($cancel->date != NULL)-->
  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($cancel->date)) }}, {{ date('g:i A' ,strtotime($cancel->date)) }}</p>-->
  <!--                      @endif-->
  <!--                      <p><strong>Booking Date</strong> : {{ date('jS M Y' ,strtotime($cancel->created_at)) }}, {{ date('g:i A' ,strtotime($cancel->created_at)) }}</p>-->
  <!--                      <p><strong>Cancelled On</strong> : {{ date('jS M Y' ,strtotime($cancel->updated_at)) }}, {{ date('g:i A' ,strtotime($cancel->updated_at)) }}</p>-->
  <!--                      <p><strong>Cancel By</strong> :-->
  <!--                        @if($cancel->BookingCancel['cancel_by'] == 'user')-->
  <!--                        Adviser-->
  <!--                        @else-->
  <!--                        User-->
  <!--                        @endif</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Consultation Fees : </small> <strong>INR {{ $cancel->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $cancel->availability->consultation_mode }}</p>-->
  <!--                        @if(isset($cancel->location))-->
  <!--                        <p><strong>Location</strong> : {{ $cancel->location->address }}</p>-->
  <!--                        @endif-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->
  <!--                        <p><small>Booking Id : </small> <strong>{{ $cancel->id }}</strong></p>-->
  <!--                      <p><strong>Cancellation Reason</strong> : {{ $cancel->BookingCancel['reason'] }}</p>-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block">Payment Status</button></p>-->
  <!--                      </div>-->
  <!--                    </div>-->
  <!--                  </div>-->
  <!--              </div>-->
  <!--          </div>-->
  <!--          @endforeach-->

  <!--        </div>-->
  <!--    </div>-->
  <!--</div>-->
  <!-- Cancelled Consultations Box ends  -->




</div>
</div>


</section>
@endsection

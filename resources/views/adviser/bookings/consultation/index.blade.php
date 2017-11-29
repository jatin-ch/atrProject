@extends('layouts.adviser')
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
                    <li class="menu" role="presentation" class="active"><a href="#open" aria-controls="open" role="tab" data-toggle="tab">OPEN</a></li>
                    <li class="menu" role="presentation"><a href="#upcoming" aria-controls="#upcoming" role="tab" data-toggle="tab">UPCOMING</a></li>
                    <li class="menu" role="presentation"><a href="#done" aria-controls="done" role="tab" data-toggle="tab">DONE</a></li>
                    <li class="menu" role="presentation"><a href="#cancel" aria-controls="#cancel" role="tab" data-toggle="tab">CANCELLED</a></li>
                 </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="open">
                       @foreach($consultations as $consultation)
          @if($consultation->status == 'open')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-4">

                          <p><small>Name : </small>
                          <strong>
                            @if($consultation->user->where('id',$consultation->client_id)->first()->basicDetail->gender == 'M')
                            Mr.
                            @else
                            Ms.
                            @endif
                          {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->firstname }} {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}</p>
                          <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($consultation->date)) }}</p>

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
                          <p> Confirmation Awaited</p>

                           @if($consultation->user->expertDetail->type == 'professional')
                           {!! Form::open(['route' => ['adviser.bookings.consultation.confirm', $consultation->id], 'method' => 'POST', 'id' => 'cm'.$consultation->id]) !!}
                            <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cm{{ $consultation->id }}).submit();">Confirm Consultation</button>
                           {!! Form::close() !!}
                           @endif


                          <p><button class="btn btn-default btn-sm btn-block" data-target="#pcc1{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcc1{{$consultation->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Cancel Consultation for {{ $consultation->availability->consultation_mode }}</h4>
                          </div>
                          <div class="modal-body">
                           {!! Form::open(['route' => ['adviser.bookings.consultation.cancel', $consultation->id], 'method' => 'POST', 'id' => 'cc1'.$consultation->id]) !!}
                           <div class="form-group">
                             {{ Form::label('reason', 'Reason for cancel Consultation') }}
                             <select name="reason" class="form-control">
                               <option>Not available on scheduled time.</option>
                               <option>My reason is not listed.</option>
                             </select>
                           </div>
                          <div class="form-group">
                          <button class="btn btn-primary btn-sm" onclick="document.getElementById(cc1{{ $consultation->id }}).submit();">submit</button>
                           </div>
                          {!! Form::close() !!}
                          </div>
                          </div>
                          </div>
                          </div>

                        </div>



                        @if($consultation->user->expertDetail->type == 'individual')
                        @if($consultation->BookingDates->where('suggest_by', 'user')->count() > 0)
                        <div class="col-md-12">
                          {!! Form::open(['route' => ['adviser.bookings.consultation.confirm', $consultation->id], 'method' => 'POST', 'id' => 'cmdt'.$consultation->id]) !!}
                          <table class="table">
                            <tbody>
                              <td style="border:none">Client choose Dates for the Appointment</td>
                              @foreach($consultation->BookingDates as $date)
                              @if($date->suggest_by == 'user')
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



                        <p><button class="btn btn-default btn-sm btn-block" data-target="#scc1{{$consultation->id}}" data-toggle="modal">Suggest New Date & Time</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="scc1{{$consultation->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Suggest New Date & Time for {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->firstname }} {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->lastname }}</h4>
                          </div>
                          <div class="modal-body">
                           <table class="table">
                            <form action="{{ route('adviser.bookings.consultation.confirm', $consultation->id) }}" method="POST", id="smf{{$consultation->id}}">
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
                            <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(smf{{ $consultation->id }}).submit();">Suggest Date & Time</button>
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
                          @if($consultation->user->where('id',$consultation->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->firstname }} {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}</p>
                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($consultation->date)) }}</p>

                        @foreach($consultation->Documents as $document)
                        @if($document->sender == 'adviser')
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $consultation->Documents->where('sender', 'adviser')->count() }}</i> Sent Document
                        </button></p>
                        @else
                        <p><button class="btn btn-default btn-sm btn-block">
                        <i class="badge badge-default">{{ $consultation->Documents->where('sender', 'user')->count() }}</i> Document Received
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

                          <p><button class="btn btn-default btn-sm btn-block" data-target="#rsb1{{$consultation->id}}" data-toggle="modal">Reschedule Appointment</button></p>
                          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="rsb1{{$consultation->id}}" tabindex="-1">
                          <div class="modal-dialog modal-md">
                          <div class="modal-content">
                          <div class="modal-header">
                          <button class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Reschedule Appointment</h4>
                          </div>
                          <div class="modal-body">
                          {!! Form::open(['route' => ['adviser.bookings.reschedule', $consultation->id], 'method' => 'POST', 'id' => 'rs1'.$consultation->id, 'class' => 'form-inline']) !!}
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

                          {!! Form::open(['route' => ['adviser.bookings.consultation.document', $consultation->id], 'method' => 'POST', 'files' => true, 'id' =>'cbd'.$consultation->id]) !!}
                          <input type="file" name="doc" id="selectedFile1" style="display:none" onchange='this.form.submit();' required>
                          <p><button class="btn btn-default btn-sm btn-block" onclick="document.getElementById('selectedFile1').click();">Send Document</button></p>
                          {!! Form::close() !!}

                          <p><button class="btn btn-default btn-sm btn-block">View Detail</button></p>

                          @if($consultation->availability->consultation_mode == 'Phone Call')
                          @if(Carbon\Carbon::parse($consultation->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>
                          @endif
                          @endif

                          @if($consultation->availability->consultation_mode == 'Video Call')
                          @if(Carbon\Carbon::parse($consultation->date)->diffInMinutes(Carbon\Carbon::now()) >= 30)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>
                          @endif
                          @endif

                          @if($consultation->availability->consultation_mode == 'Personal Meeting')
                          @if(Carbon\Carbon::parse($consultation->date)->diffInMinutes(Carbon\Carbon::now()) >= 60)
                          <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>
                          @endif
                          @endif

                          @if($consultation->availability->consultation_mode == 'Chat')
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
                           {!! Form::open(['route' => ['adviser.bookings.consultation.cancel', $consultation->id], 'method' => 'POST', 'id' => 'cc2'.$consultation->id]) !!}
                           <div class="form-group">
                             {{ Form::label('reason', 'Reason for cancel Consultation') }}
                             <select name="reason" class="form-control">
                               <option>Not available on scheduled time.</option>
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
                    <div role="tabpanel" class="tab-pane" id="done">
                         @foreach($consultations as $consultation)
          @if($consultation->status =='done')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-4">

                          <p><small>Name : </small>
                          <strong>
                          @if($consultation->user->where('id',$consultation->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->firstname }} {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}</p>
                          <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($consultation->date)) }}</p>

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
                    <div role="tabpanel" class="tab-pane" id="cancel">
                         @foreach($consultations as $consultation)
          @if($consultation->status =='canceled')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="col-md-4">

                          <p><small>Name : </small>
                          <strong>
                          @if($consultation->user->where('id',$consultation->client_id)->first()->basicDetail->gender == 'M')
                          Mr.
                          @else
                          Ms.
                          @endif
                          {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->firstname }} {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->lastname }}
                        </strong></p>

                        @if($consultation->date != NULL)
                        <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}, {{ date('g:i A' ,strtotime($consultation->date)) }}</p>
                        @endif
                        <p><strong>Booking Date</strong> : {{ date('jS M Y' ,strtotime($consultation->created_at)) }}, {{ date('g:i A' ,strtotime($consultation->created_at)) }}</p>
                        <p><strong>Cancelled On</strong> : {{ date('jS M Y' ,strtotime($consultation->updated_at)) }}, {{ date('g:i A' ,strtotime($consultation->updated_at)) }}</p>
                        <p><strong>Cancel By</strong> :
                          @if($consultation->BookingCancel['cancel_by'] == 'user')
                          Adviser
                          @else
                          User
                          @endif</p>

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


  <!-- Open Consultation Box starts -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">OPEN</div>-->
  <!--        <div class="panel-body">-->

  <!--        @foreach($consultations as $consultation)-->
  <!--        @if($consultation->status == 'open')-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                          @if($consultation->user->where('id',$consultation->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                          Mr.-->
  <!--                          @else-->
  <!--                          Ms.-->
  <!--                          @endif-->
  <!--                        {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->firstname }} {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}</p>-->
  <!--                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($consultation->date)) }}</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Consultation Fees : </small> <strong>INR {{ $consultation->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $consultation->availability->consultation_mode }}</p>-->
  <!--                        @if(isset($consultation->location))-->
  <!--                        <p><strong>Location</strong> : {{ $consultation->location->address }}</p>-->
  <!--                        @endif-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $consultation->id }}</strong></p>-->
  <!--                        <p> Confirmation Awaited</p>-->

  <!--                         @if($consultation->user->expertDetail->type == 'professional')-->
  <!--                         {!! Form::open(['route' => ['adviser.bookings.consultation.confirm', $consultation->id], 'method' => 'POST', 'id' => 'cm'.$consultation->id]) !!}-->
  <!--                          <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cm{{ $consultation->id }}).submit();">Confirm Consultation</button>-->
  <!--                         {!! Form::close() !!}-->
  <!--                         @endif-->


  <!--                        <p><button class="btn btn-default btn-sm btn-block" data-target="#pcc1{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcc1{{$consultation->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Cancel Consultation for {{ $consultation->availability->consultation_mode }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         {!! Form::open(['route' => ['adviser.bookings.consultation.cancel', $consultation->id], 'method' => 'POST', 'id' => 'cc1'.$consultation->id]) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('reason', 'Reason for cancel Consultation') }}-->
  <!--                           <select name="reason" class="form-control">-->
  <!--                             <option>Not available on scheduled time.</option>-->
  <!--                             <option>My reason is not listed.</option>-->
  <!--                           </select>-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cc1{{ $consultation->id }}).submit();">submit</button>-->
  <!--                         </div>-->
  <!--                        {!! Form::close() !!}-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->

  <!--                      </div>-->



  <!--                      @if($consultation->user->expertDetail->type == 'individual')-->
  <!--                      @if($consultation->BookingDates->where('suggest_by', 'user')->count() > 0)-->
  <!--                      <div class="col-md-12">-->
  <!--                        {!! Form::open(['route' => ['adviser.bookings.consultation.confirm', $consultation->id], 'method' => 'POST', 'id' => 'cmdt'.$consultation->id]) !!}-->
  <!--                        <table class="table">-->
  <!--                          <tbody>-->
  <!--                            <td style="border:none">Client choose Dates for the Appointment</td>-->
  <!--                            @foreach($consultation->BookingDates as $date)-->
  <!--                            @if($date->suggest_by == 'user')-->
  <!--                            <td style="border:none">-->
  <!--                              <input type="radio" name="date" value="{{ $date->date }}" required>{{ date('jS M Y, H:i A' ,strtotime($date->date)) }}-->
  <!--                            </td>-->
  <!--                            @endif-->
  <!--                            @endforeach-->
  <!--                            <td style="border:none">-->
  <!--                              <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(cmdt{{ $consultation->id }}).submit();">Confirm Consultation</button>-->
  <!--                            </td>-->
  <!--                          </tbody>-->
  <!--                        </table>-->

  <!--                        {!! Form::close() !!}-->
  <!--                      </div>-->



  <!--                      <p><button class="btn btn-default btn-sm btn-block" data-target="#scc1{{$consultation->id}}" data-toggle="modal">Suggest New Date & Time</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="scc1{{$consultation->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Suggest New Date & Time for {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->firstname }} {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->lastname }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         <table class="table">-->
  <!--                          <form action="{{ route('adviser.bookings.consultation.confirm', $consultation->id) }}" method="POST", id="smf{{$consultation->id}}">-->
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
  <!--                          <button class="btn btn-default btn-sm btn-block" onclick="document.getElementById(smf{{ $consultation->id }}).submit();">Suggest Date & Time</button>-->
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
  <!-- Open consultations Box ends  -->










  <!-- Upcoming Consultations Box Starts  -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">UPCOMING</div>-->
  <!--        <div class="panel-body">-->

  <!--        @foreach($consultations as $consultation)-->
  <!--          @if($consultation->status == 'upcoming')-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-heading">-->
  <!--                      <p style="color:#a00">{{ Carbon\Carbon::parse($consultation->date)->diffInDays(Carbon\Carbon::now()) }} days to Go!</p>-->
  <!--                    </div>-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($consultation->user->where('id',$consultation->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->firstname }} {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}</p>-->
  <!--                      <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($consultation->date)) }}</p>-->

  <!--                      @foreach($consultation->Documents as $document)-->
  <!--                      @if($document->sender == 'adviser')-->
  <!--                      <p><button class="btn btn-default btn-sm btn-block">-->
  <!--                      <i class="badge badge-default">{{ $consultation->Documents->where('sender', 'adviser')->count() }}</i> Sent Document-->
  <!--                      </button></p>-->
  <!--                      @else-->
  <!--                      <p><button class="btn btn-default btn-sm btn-block">-->
  <!--                      <i class="badge badge-default">{{ $consultation->Documents->where('sender', 'user')->count() }}</i> Document Received-->
  <!--                      </button></p>-->
  <!--                      @endif-->
  <!--                      @endforeach-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Consultation Fees : </small> <strong>INR {{ $consultation->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $consultation->availability->consultation_mode }}</p>-->
  <!--                        @if(isset($consultation->location))-->
  <!--                        <p><strong>Location</strong> : {{ $consultation->location->address }}</p>-->
  <!--                        @endif-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $consultation->id }}</strong></p>-->

  <!--                        <p><button class="btn btn-default btn-sm btn-block" data-target="#rsb1{{$consultation->id}}" data-toggle="modal">Reschedule Appointment</button></p>-->
  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="rsb1{{$consultation->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Reschedule Appointment</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                        {!! Form::open(['route' => ['adviser.bookings.reschedule', $consultation->id], 'method' => 'POST', 'id' => 'rs1'.$consultation->id, 'class' => 'form-inline']) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('date', 'Date') }}-->
  <!--                           {{ Form::date('date', null, ['class' => 'form-control', 'required' => '']) }}-->
  <!--                           {{ Form::label('time', 'Time') }}-->
  <!--                           {{ Form::time('time', null, ['class' => 'form-control', 'required' => '']) }}-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(rs1{{ $consultation->id }}).submit();">Submit</button>-->
  <!--                         </div>-->
  <!--                        {!! Form::close() !!}-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->
  <!--                        </div>-->

  <!--                        {!! Form::open(['route' => ['adviser.bookings.consultation.document', $consultation->id], 'method' => 'POST', 'files' => true, 'id' =>'cbd'.$consultation->id]) !!}-->
  <!--                        <input type="file" name="doc" id="selectedFile1" style="display:none" onchange='this.form.submit();' required>-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block" onclick="document.getElementById('selectedFile1').click();">Send Document</button></p>-->
  <!--                        {!! Form::close() !!}-->

  <!--                        <p><button class="btn btn-default btn-sm btn-block">View Detail</button></p>-->

  <!--                        @if($consultation->availability->consultation_mode == 'Phone Call')-->
  <!--                        @if(Carbon\Carbon::parse($consultation->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)-->
  <!--                        <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        @if($consultation->availability->consultation_mode == 'Video Call')-->
  <!--                        @if(Carbon\Carbon::parse($consultation->date)->diffInMinutes(Carbon\Carbon::now()) >= 30)-->
  <!--                        <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        @if($consultation->availability->consultation_mode == 'Personal Meeting')-->
  <!--                        @if(Carbon\Carbon::parse($consultation->date)->diffInMinutes(Carbon\Carbon::now()) >= 60)-->
  <!--                        <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        @if($consultation->availability->consultation_mode == 'Chat')-->
  <!--                        @if(Carbon\Carbon::parse($consultation->date)->diffInMinutes(Carbon\Carbon::now()) >= 10)-->
  <!--                        <button class="btn btn-default btn-sm btn-block" data-target="#pcc2{{$consultation->id}}" data-toggle="modal">Cancel Appointment</button>-->
  <!--                        @endif-->
  <!--                        @endif-->

  <!--                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pcc2{{$consultation->id}}" tabindex="-1">-->
  <!--                        <div class="modal-dialog modal-md">-->
  <!--                        <div class="modal-content">-->
  <!--                        <div class="modal-header">-->
  <!--                        <button class="close" data-dismiss="modal">&times;</button>-->
  <!--                        <h4 class="modal-title">Cancel Consultation for {{ $consultation->availability->consultation_mode }}</h4>-->
  <!--                        </div>-->
  <!--                        <div class="modal-body">-->
  <!--                         {!! Form::open(['route' => ['adviser.bookings.consultation.cancel', $consultation->id], 'method' => 'POST', 'id' => 'cc2'.$consultation->id]) !!}-->
  <!--                         <div class="form-group">-->
  <!--                           {{ Form::label('reason', 'Reason for cancel Consultation') }}-->
  <!--                           <select name="reason" class="form-control">-->
  <!--                             <option>Not available on scheduled time.</option>-->
  <!--                             <option>My reason is not listed.</option>-->
  <!--                           </select>-->
  <!--                         </div>-->
  <!--                        <div class="form-group">-->
  <!--                        <button class="btn btn-primary btn-sm" onclick="document.getElementById(cc2{{ $consultation->id }}).submit();">Submit</button>-->
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
  <!-- Upcoming Consultations Box Ends  -->









  <!-- Done Consultations Box starts  -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">DONE</div>-->
  <!--        <div class="panel-body">-->

  <!--        @foreach($consultations as $consultation)-->
  <!--        @if($consultation->status =='done')-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($consultation->user->where('id',$consultation->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->firstname }} {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}</p>-->
  <!--                        <p><strong>Time</strong> : {{ date('g:i A' ,strtotime($consultation->date)) }}</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Consultation Fees : </small> <strong>INR {{ $consultation->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $consultation->availability->consultation_mode }}</p>-->
  <!--                        @if(isset($consultation->location))-->
  <!--                        <p><strong>Location</strong> : {{ $consultation->location->address }}</p>-->
  <!--                        @endif-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Booking Id : </small> <strong>{{ $consultation->id }}</strong></p>-->
  <!--                        @if(Carbon\Carbon::now()->diffInHours(Carbon\Carbon::parse($consultation->date)) <= 48)-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block">Chat</button></p>-->
  <!--                        @endif-->
  <!--                        <p><button class="btn btn-default btn-sm btn-block"><i class="badge badge-default">3</i> View Documents</button></p>-->

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
  <!-- Done Consultations Box ends  -->









  <!-- cancelled Consultations Box starts  -->
  <!--<div class="col-md-12">-->
  <!--    <div class="panel panel-default">-->
  <!--        <div class="panel-heading">CANCELLED</div>-->
  <!--        <div class="panel-body">-->

  <!--        @foreach($consultations as $consultation)-->
  <!--        @if($consultation->status =='canceled')-->
  <!--          <div class="row">-->
  <!--              <div class="col-md-12">-->
  <!--                  <div class="panel panel-default">-->
  <!--                    <div class="panel-body">-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Name : </small>-->
  <!--                        <strong>-->
  <!--                        @if($consultation->user->where('id',$consultation->client_id)->first()->basicDetail->gender == 'M')-->
  <!--                        Mr.-->
  <!--                        @else-->
  <!--                        Ms.-->
  <!--                        @endif-->
  <!--                        {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->firstname }} {{ $consultation->user->where('id',$consultation->client_id)->first()->basicDetail->lastname }}-->
  <!--                      </strong></p>-->

  <!--                      @if($consultation->date != NULL)-->
  <!--                      <p><strong>Date</strong> : {{ date('jS M Y' ,strtotime($consultation->date)) }}, {{ date('g:i A' ,strtotime($consultation->date)) }}</p>-->
  <!--                      @endif-->
  <!--                      <p><strong>Booking Date</strong> : {{ date('jS M Y' ,strtotime($consultation->created_at)) }}, {{ date('g:i A' ,strtotime($consultation->created_at)) }}</p>-->
  <!--                      <p><strong>Cancelled On</strong> : {{ date('jS M Y' ,strtotime($consultation->updated_at)) }}, {{ date('g:i A' ,strtotime($consultation->updated_at)) }}</p>-->
  <!--                      <p><strong>Cancel By</strong> :-->
  <!--                        @if($consultation->BookingCancel['cancel_by'] == 'user')-->
  <!--                        Adviser-->
  <!--                        @else-->
  <!--                        User-->
  <!--                        @endif</p>-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->

  <!--                        <p><small>Consultation Fees : </small> <strong>INR {{ $consultation->total_pay }}/-</strong></p>-->

  <!--                        <p><strong>Mode</strong> : {{ $consultation->availability->consultation_mode }}</p>-->
  <!--                        @if(isset($consultation->location))-->
  <!--                        <p><strong>Location</strong> : {{ $consultation->location->address }}</p>-->
  <!--                        @endif-->

  <!--                      </div>-->
  <!--                      <div class="col-md-4">-->
  <!--                        <p><small>Booking Id : </small> <strong>{{ $consultation->id }}</strong></p>-->
  <!--                      <p><strong>Cancellation Reason</strong> : {{ $consultation->BookingCancel['reason'] }}</p>-->
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
  <!-- Cancelled Consultations Box ends  -->




</div>
</div>
</section>


@endsection

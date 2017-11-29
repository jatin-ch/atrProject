@extends('layouts.admin')
@section('title') | Appointments @endsection
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
         <h1>Appointments</h1>
     <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Appointment</a></li>
       <li class="active">Provided</li>
     </ol>
   </section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
           <div class="row">
               <div class="col-lg-3">
                   <div class="form-group">
                       <select class="form-control" id="fetch" name="fetch">
                          <option value="">-- Fetch by --</option>
                          <option value="1">Adviser</option>
                          <option value="2">User</option>
                          <option value="3">Mode</option>
                          <option value="4">Date</option>
                      </select>
                   </div>
               </div>
               <div class="col-lg-3">
                   <form action="{{ route('admin.bookings.fetch') }}" method="POST" id="fetchForm">
                    {{ csrf_field() }}
                   <div class="form-group">
                      <select class="form-control" id="adviser" name="adviser" style="display:none">
                          <option value="">-- Select --</option>
                          @foreach($advisers as $adviser)
                          <option value="{{$adviser->id}}" onChange="$(this).form.submit();">{{ $adviser->name }}</option>
                          @endforeach
                      </select>
                      <select class="form-control" id="user" name="user" style="display:none">
                          <option value="">-- Select --</option>
                          @foreach($users as $user)
                          <option value="{{$user->id}}">{{ $user->name }}</option>
                          @endforeach
                      </select>
                      <select class="form-control" id="mode" name="consultation" style="display:none">
                          <option value="">-- Select --</option>
                          @foreach($consultations as $consultation)
                          <option>{{ $consultation->mode }}</option>
                          @endforeach
                      </select>
                      <input type="date" class="form-control" id="date" name="date" style="display:none">
                   </div>
                   </form>
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
                             <!-- Nav tabs -->
                             <div class="card">
                                    <ul class="nav nav-tabs text-center" role="tablist">
                                        <li class="menu" role="presentation" class="active"><a href="#open" aria-controls="overview" role="tab" data-toggle="tab">OPEN</a></li>
                                        <li class="menu" role="presentation"><a href="#inprocess" aria-controls="#inprocess" role="tab" data-toggle="tab">IN-PROCESS</a></li>
                                        <li class="menu" style="margin-right:0px " role="presentation"><a href="#done" aria-controls="qa" role="tab" data-toggle="tab">DONE</a></li>
                                        <li class="menu" style="margin-right:0px " role="presentation"><a href="#cancelled" aria-controls="qa" role="tab" data-toggle="tab">CANCELLED</a></li>
                                        <li class="menu" style="margin-right:0px " role="presentation"><a href="#dispute" aria-controls="qa" role="tab" data-toggle="tab">DISPUTE</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                  <div role="tabpanel" class="tab-pane active" id="open">
                                   <div class="row">
                                       @if(isset($message))
                                       <div class="col-md-8">
                                           <p style="color:#cc0000">{{$message}}</p>
                                       </div>
                                       @else
                                       <div class="col-lg-8">
                                           <table class="table table-bordered table-striped">
                                               <thead>
                                                   <th>Booking Id</th>
                                                   <th>Booking Type</th>
                                                   <th>Date - Time</th>
                                                   <th>Adviser</th>
                                                   <th>Client</th>
                                               </thead>
                                               <tbody>
                                                   @foreach($bookings as $booking)
                                                   <tr>
                                                       <td>{{ $booking->id }}</td>
                                                       <td>{{ $booking->type }}</td>
                                                       <td>
                                                           @if($booking->date)
                                                           {{ date('j M Y, g:i A' ,strtotime($booking->date)) }}
                                                           @else
                                                           <small style="color:#cc0000">Confirmation awaited</small>
                                                           @endif
                                                           </td>
                                                       <td>{{ $booking->user->where('id',$booking->user_id)->first()->basicDetail->firstname }} {{ $booking->user->where('id',$booking->user_id)->first()->basicDetail->lastname }}</td>
                                                       <td>{{ $booking->user->where('id',$booking->client_id)->first()->basicDetail->firstname }} {{ $booking->user->where('id',$booking->client_id)->first()->basicDetail->lastname }}</td>
                                                   </tr>
                                                   @endforeach
                                               </tbody>
                                           </table>
                                       </div>
                                       @endif
                                    </div>
                                        </div>
                                    <div role="tabpanel" class="tab-pane " id="inprocess">
                                    @foreach($bookings as $booking)
                                    @if($booking->status == 'inprocess')
                                   <div class="row">
                                       <div class="box box-default">
                                           <div class="box-header with-border heading">
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Name</label><br />
                                                   <strong class="clrblck">Harsh Sharma</strong>
                                               </div>
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Consultation/Service</label><br />
                                                   <strong class="clrblck">Onology</strong>
                                               </div>
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Fees</label><br />
                                                   <strong class="clrblck">INR 2000/-</strong>
                                               </div>
                                               <div class="col-sm-3" style="text-align: right;">
                                                   <label class="clrblck">Booking ID</label><br />
                                                   <strong class="clrblck">123456</strong>
                                               </div>
                                           </div>
                                           <div class="box-body pad10">
                                               <div class="col-lg-8">
                                                   <div class="col-lg-4 mt20">
                                                       <strong>Date :</strong>
                                                       <label >16th Aug 2017</label>
                                                   </div>
                                                   <div class="col-lg-4 mt20">
                                                       <strong>Mode :</strong>
                                                       <label class="">Phone Call</label>
                                                   </div>
                                                   <div class="col-lg-4 mt20">
                                                       <strong>Validity :</strong>
                                                       <label class="">30 Days</label>
                                                   </div>
                                                   <div class="col-lg-4 mt20">
                                                       <strong>Time :</strong>
                                                       <label class="">11:45 PM</label>
                                                   </div>
                                                   <div class="col-lg-4 mt20">
                                                       <strong >Duration :</strong>
                                                       <label class="">30 Min</label>
                                                   </div>
                                                   <div class="col-lg-4 mt20">
                                                       <strong>Frequency :</strong>
                                                       <label class="">3</label>
                                                   </div>
                                                   <div class="col-lg-10 mt20">
                                                       <strong>Advisor Location :</strong>
                                                       <label class="">100, New York,US</label>
                                                   </div>
                                                   <div class="col-lg-12 mt20 text-center">
                                                       <label class="docP">4 Document Sent</label><br />
                                                           <button class="btn btn-default">
                                                               Send Document/Test
                                                           </button>
                                                   </div>
                                               </div>


                                                   <div class="col-lg-4 text-center" style="border-left: 1px solid;">
                                                       <select class="form-control text-olive mt20 ml5 ">
                                                           <option value="inprocess" selected>In-Process</option>
                                                       </select>
                                                       <button type="button" class="btn btn-default mar10 width200">Chat </button>
                                                       <p class="docP text-center">4 Document Inside</p>
                                                       <button type="button" class="btn btn-default mar10 width200">View Document Recieved</button>
                                                   </div>
                                               </div>
                                       </div>
                                   </div>
                                   @endif
                                   @endforeach
                                        </div>
                                    <div role="tabpanel" class="tab-pane " id="done">
                                   @foreach($bookings as $booking)
                                    @if($booking->status == 'done')
                                   <div class="row">
                                       <div class="box box-default">
                                           <div class="box-header with-border heading">
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Name</label><br />
                                                   <strong class="clrblck">Harsh Sharma</strong>
                                               </div>
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Consultation/Service</label><br />
                                                   <strong class="clrblck">Onology</strong>
                                               </div>
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Fees</label><br />
                                                   <strong class="clrblck">INR 2000/-</strong>
                                               </div>
                                               <div class="col-sm-3" style="text-align: right;">
                                                   <label class="clrblck">Booking ID</label><br />
                                                   <strong class="clrblck">123456</strong>
                                               </div>
                                           </div>
                                           <div class="box-body pad10">
                                               <div class="col-lg-8">
                                                   <div class="col-lg-5 mt20">
                                                       <strong>Date :</strong>
                                                       <label class="">16th Aug 2017</label>
                                                   </div>
                                                   <div class="col-lg-5 mt20">
                                                       <strong>Mode :</strong>
                                                       <label class="">Phone Call</label>
                                                   </div>

                                                   <div class="col-lg-5 mt20">
                                                       <strong>Time :</strong>
                                                       <label class="">11:45 PM</label>
                                                   </div>
                                                   <div class="col-lg-5 mt20">
                                                       <strong>Duration :</strong>
                                                       <label class="">30 Min</label>
                                                   </div>

                                                   <div class="col-lg-11 mt20">
                                                       <strong>Purpose of Consultation</strong><br />
                                                      <textarea class="form-control txtheight"></textarea>
                                                   </div>
                                               </div>


                                               <div class="col-lg-4 text-center" style="border-left: 1px solid;">
                                                   <label class="mt10">3.3 Star</label><br />
                                                   <img src="/img/rating.png" class="mt10" />
                                                   <button type="button" class="btn btn-default mar10 mt10 width200">View Document</button>
                                                   <button type="button" class="btn btn-default mar10 width200">Send Document </button>
                                                   <button type="button" class="btn btn-default mar10 width200">Chat</button>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   @endif
                                   @endforeach
                                        </div>
                                    <div role="tabpanel" class="tab-pane " id="cancelled">
                                   @foreach($bookings as $booking)
                                    @if($booking->status == 'canceled')
                                   <div class="row">
                                       <div class="box box-default">
                                           <div class="box-header with-border ">
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Name</label><br />
                                                   <strong class="clrblck">Harsh Sharma</strong>
                                               </div>
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Consultation/Service</label><br />
                                                   <strong class="clrblck">Onology</strong>
                                               </div>
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Fees</label><br />
                                                   <strong class="clrblck">INR 2000/-</strong>
                                               </div>
                                               <div class="col-sm-3" style="text-align: right;">
                                                   <label class="clrblck">Booking ID</label><br />
                                                   <strong class="clrblck">123456</strong>
                                               </div>
                                           </div>
                                           <div class="box-body pad10">
                                               <div class="col-lg-8">
                                                   <div class="col-lg-5 mt20">
                                                       <strong>Date :</strong>
                                                       <label class="">16th Aug 2017</label>
                                                   </div>
                                                   <div class="col-lg-5 mt20">
                                                       <strong>Mode :</strong>
                                                       <label class="">Phone Call</label>
                                                   </div>

                                                   <div class="col-lg-5 mt20">
                                                       <strong>Time :</strong>
                                                       <label class="">11:45 PM</label>
                                                   </div>
                                                   <div class="col-lg-5 mt20">
                                                       <strong>Duration :</strong>
                                                       <label class="">30 Min</label>
                                                   </div>

                                                   <div class="col-lg-5 mt20">
                                                       <strong>Cancelled By :</strong>
                                                       <label class="">30 Min</label>
                                                   </div>
                                                   <div class="col-lg-6 mt20">
                                                       <strong>Cancelled On :</strong>
                                                       <label class="">16th Aug 2017</label>
                                                   </div>
                                               </div>


                                               <div class="col-lg-4 text-right" style="border-left: 1px solid;">
                                                   <label class="mt10">Reason for Cancellation</label><br />
                                                   <p class="text-right">i am not avaliable on schedule time</p>
                                                   <label class="mt10">Any Penalty</label><br />
                                                   <p class="text-right">INR 100/- to Dr Neetu Sharma</p>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   @endif
                                   @endforeach
                                        </div>
                                    <div role="tabpanel" class="tab-pane " id="dispute">
                                   @foreach($bookings as $booking)
                                    @if($booking->status == 'dispute')
                                   <div class="row">
                                       <div class="box box-default">
                                           <div class="box-header with-border heading">
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Name</label><br />
                                                   <strong class="clrblck">Harsh Sharma</strong>
                                               </div>
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Consultation/Service</label><br />
                                                   <strong class="clrblck">Onology</strong>
                                               </div>
                                               <div class="col-sm-3">
                                                   <label class="clrblck">Fees</label><br />
                                                   <strong class="clrblck">INR 2000/-</strong>
                                               </div>
                                               <div class="col-sm-3" style="text-align: right;">
                                                   <label class="clrblck">Booking ID</label><br />
                                                   <strong class="clrblck">123456</strong>
                                               </div>
                                           </div>
                                           <div class="box-body pad10">
                                               <div class="col-lg-8">
                                                   <div class="col-lg-5 mt20">
                                                       <strong>Date :</strong>
                                                       <label class="">16th Aug 2017</label>
                                                   </div>
                                                   <div class="col-lg-5 mt20">
                                                       <strong>Mode :</strong>
                                                       <label class="">Phone Call</label>
                                                   </div>

                                                   <div class="col-lg-5 mt20">
                                                       <strong>Time :</strong>
                                                       <label class="">11:45 PM</label>
                                                   </div>
                                                   <div class="col-lg-5 mt20">
                                                       <strong>Duration :</strong>
                                                       <label class="">30 Min</label>
                                                   </div>

                                                   <div class="col-lg-5 mt20">
                                                       <strong>Raise By :</strong>
                                                       <label class="">User</label>
                                                   </div>
                                                   <div class="col-lg-6 mt20">
                                                       <strong>Raised On :</strong>
                                                       <label class="">16th Aug 2017</label>
                                                   </div>
                                               </div>
                                               <div class="col-lg-4 text-right" style="border-left: 1px solid;">
                                                   <label class="mt10">Reason for Dispute</label><br />
                                                   <p class="text-right">i am not avaliable on schedule time</p>
                                                   <label class="mt10">Dispute Status</label><br />
                                                   <p class="text-right">Resolved in favour of User</p>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   @endif
                                   @endforeach
                                        </div>
                                      </div>
                                </div>

              </div>
          </div>

   </section>

<script type="text/javascript">
  $(function(){
     $('.timepicker').timepicker({
               showInputs: false
                });
  });
</script>

<script type="text/javascript">
   $('#fetch').on('change', function(e){
     var fetch = e.target.value;
     if(fetch==1)
     {
        $('#adviser').show();
        $('#user').hide();
        $('#mode').hide();
        $('#date').hide();
     }
     else if(fetch==2)
     {
         $('#user').show();
         $('#adviser').hide();
         $('#mode').hide();
         $('#date').hide();
     }
     else if(fetch==3)
     {
         $('#mode').show();
         $('#adviser').hide();
         $('#user').hide();
         $('#date').hide();
     }
     else if(fetch==4)
     {
         $('#date').show();
         $('#mode').hide();
         $('#adviser').hide();
         $('#user').hide();
     }
     else
     {
         $('#adviser').hide();
         $('#user').hide();
         $('#mode').hide();
         $('#date').hide();
     }

   });


  $('#adviser').change(function(){
      $('#fetchForm').submit();
    });
    $('#user').change(function(){
      $('#fetchForm').submit();
    });
    $('#mode').change(function(){
      $('#fetchForm').submit();
    });
    $('#date').change(function(){
      $('#fetchForm').submit();
    });

 </script>

@endsection

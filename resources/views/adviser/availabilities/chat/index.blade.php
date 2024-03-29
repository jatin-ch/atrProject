@extends('layouts.adviser')
@section('title') | Availability | Chat @endsection
@section('content')

 <section class="content-header">
      <h1>
        Availabilities
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Availability</a></li>
        <li class="active">Chat</li>
      </ol>
    </section>
    <hr>
   <section class="content">
<div class="col-md-11">
      <div class="panel panel-default">
        <div class="panel-heading">
          <label> Chat</label>
          <button class="btn btn-warning btn-sm pull-right" data-target="#sl1e3" data-toggle="modal"><i class="fa fa-edit"></i> Edit</button>
           <!-- Edit Modal -->
      <div class="modal fade" id="sl1e3" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Chat Availability</h4>
                </div>

                <div class="modal-body">
                    {!! Form::model($availability, ['route' => ['availabilities.update', $availability->id], 'method' => 'PUT']) !!}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label style="margin-left: 10px;" >Number of Questions to be Asked :</label><br>
                                 <label class="ml20"><input type="radio" class="flat" name="consultation_question" value="10" {{ $availability->time_slot == '10'?'checked':'' }}> 10 </label>
                                 <label class="ml20"><input type="radio" class="flat" name="consultation_question" value="20" {{ $availability->time_slot == '20'?'checked':'' }}> 20 </label>
                                <label class="ml20"><input type="radio" class="flat" name="consultation_question" value="30" {{ $availability->time_slot == '30'?'checked':'' }}> 30 </label>
                                <label class="ml20"><input type="radio" class="flat" name="consultation_question" value="40" {{ $availability->time_slot == '40'?'checked':'' }}> 40 </label>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                {{ Form::label('consultation_fee', 'CONSULTATION FEES *') }}
                                {{ Form::text('consultation_fee', null, ['class' => 'form-control', 'id' => 'field11']) }}
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                   {{ Form::label('consultation_commision', 'ADVICELI COMMISION') }}
                                   @if(isset(Auth::user()->commission))
                                   {{ Form::text('consultation_commision', Auth::user()->commission->price, ['class' => 'form-control', 'id' => 'field21', 'readonly'=>'']) }}
                                   @else
                                   {{ Form::text('consultation_commision', null, ['class' => 'form-control', 'id' => 'field21', 'readonly'=>'']) }}
                                   @endif
                              </div>
                           </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                 {{ Form::label('consultation_payout', 'YOUR PAYOUT') }}
                                 {{ Form::text('consultation_payout', null, ['class' => 'form-control', 'id' => 'field31', 'readonly' => '']) }}
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label> <input type="checkbox" name="free_consultation" value="1"> It's Free, I'm doing it for Society</label>
                              </div>
                           </div>
                           <div class="col-md-12 text-center">
                             {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                           </div>
                        </div>
                    </div>
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
               <!-- Edit Modal -->
  </div>

        <div class="panel-body">
          <div class="form-group">
            <label>Consultation Time Slot :</label>
            <span>{{$availability->time_slot}} min<span>
          </div>
           <div class="form-group">
            @if(isset($availability->free_conslutation))
          <label>Consultation fees :</label>
          <span>It's free, I'm doing it for Society<span>
          @else
            @if($availability->consultation_commision)
             <label>Consultation Payout :</label>
              <span><strike>INR {{ $availability->consultation_fee }} /-</strike></span> <span>INR {{ $availability->consultation_payout }} /-<span>
            @else
               <label>Consultation Payout :</label>
              <span>INR {{ $availability->consultation_fee }} /-<span>
            @endif
          @endif
          </div>
          {!! Form::open(['route' => ['availabilities.destroy', $availability->id], 'method' => 'DELETE', 'id' => 'dl'.$availability->id]) !!}
           {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'style' => 'cursor:pointer']) }}
          {!! Form::close() !!}
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
         <label>Shifts Availabilities</label>
          <button class="btn btn-success btn-sm pull-right" data-target="#afsp{{$availability->id}}" data-toggle="modal">Add Shifts</button>

          <!--Add Shift Modal -->
      <div class="modal fade" data-keyboard="false" data-backdrop="static" id="afsp{{$availability->id}}" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Chat Availability</h4>
                </div>

                <div class="modal-body">
                   {!! Form::open(['route' => ['availabilities.firstshift.store'], 'method' => 'POST']) !!}
                   {{ Form::hidden('availability_id', $availability->id) }}
                   {{ Form::hidden('mode', $availability->consultation_mode)}}
                    <div class="container-fluid">
                        <div class="row">
                              <div class="col-md-4">
                              <div class="form-group">
                                 {{ Form::label('days', 'SELECT DAYS *') }}
                                 <select class="form-control" name="day">
                                   <option value="monday">Monday</option>
                                     <option value="tuesday">Tuesday</option>
                                       <option value="wednesday">Wednesday</option>
                                         <option value="thursday">Thursday</option>
                                           <option value="friday">Friday</option>
                                             <option value="saturday">Saturday</option>
                                               <option value="sunday">Sunday</option>
                                 </select>
                              </div>
                             </div>
                             <div class="col-md-4">
                               <div class="bootstrap-timepicker">
                                                    <div class="form-group">
                                                      <label>FROM</label>
                                                     <div class="input-group">
                                                     <input type="time" name="time_from" style="width: 100%" class="form-control">
                                                    </div>
                                                    </div>
                                               </div>
                             </div>
                                <div class="col-md-4">
                               <div class="bootstrap-timepicker">
                                                    <div class="form-group">
                                                      <label>TO</label>
                                                     <div class="input-group">
                                                     <input type="time" name="time_to" style="width: 100%" class="form-control">
                                                    </div>
                                                    </div>
                                               </div>
                             </div>

                             <div class="col-md-12">
                                {{ Form::submit('Add New', ['class' => 'btn btn-success btn-sm']) }}
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
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
         <table class="table">
           <thead>
             <tr>
               <th>Day</th>
               <th>From</th>
               <th>To</th>
               <th>Edit</th>
               <th>Delete</th>
             </tr>
           </thead>
           <tbody>
             @foreach($availability->firstshifts as $firstshift)
             <tr>
               <td style="border:none">{{  $firstshift->day }}</td>
               <td style="border:none">{{ date('g:i A', strtotime($firstshift->time_from)) }}</td>
               <td style="border:none">{{ date('g:i A', strtotime($firstshift->time_to)) }}</td>
               <td>
                 <a  class="btn" data-target="#tri{{$firstshift->id}}" data-toggle="modal"><i class="fa fa-edit"></i></a>

                 <!--Edit Shift Modal -->
      <div class="modal fade" data-keyboard="false" data-backdrop="static" id="tri{{$firstshift->id}}" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Shift Availability</h4>
                </div>

                <div class="modal-body">
                  {!! Form::model($firstshift, ['route' => ['availabilities.firstshift.update', $firstshift->id], 'method' => 'PUT']) !!}
                   {{ Form::hidden('availability_id', $availability->id) }}
                   {{ Form::hidden('mode', $availability->consultation_mode)}}
                    <div class="container-fluid">
                        <div class="row">
                              <div class="col-md-4">
                              <div class="form-group">
                                 {{ Form::label('days', 'SELECT DAYS *') }}
                                 <select class="form-control" name="day">
                                   <option value="monday">Monday</option>
                                     <option value="tuesday">Tuesday</option>
                                       <option value="wednesday">Wednesday</option>
                                         <option value="thursday">Thursday</option>
                                           <option value="friday">Friday</option>
                                             <option value="saturday">Saturday</option>
                                               <option value="sunday">Sunday</option>
                                 </select>
                              </div>
                             </div>
                             <div class="col-md-4">
                               <div class="bootstrap-timepicker">
                                                    <div class="form-group">
                                                      <label>FROM</label>
                                                     <div class="input-group">
                                                    {{ Form::time('time_from', null, ['class' => 'form-control']) }}
                                                    </div>
                                                    </div>
                                               </div>
                             </div>
                                <div class="col-md-4">
                               <div class="bootstrap-timepicker">
                                                    <div class="form-group">
                                                      <label>TO</label>
                                                     <div class="input-group">
                                                     {{ Form::time('time_to', null, ['class' => 'form-control']) }}
                                                    </div>
                                                    </div>
                                               </div>
                             </div>

                             <div class="col-md-12">
                                {{ Form::submit('Update', ['class' => 'btn btn-success btn-sm']) }}
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
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
                 {{ Form::open(['route' => ['availabilities.firstshift.destroy', $firstshift->id], 'method' => 'DELETE', 'id' => $firstshift->id]) }}
                 {{ Form::close() }}
                 <a onclick="
                    if(confirm('Are you sure, You Want to delete this?'))
                        {
                          event.preventDefault();
                          document.getElementById({{ $firstshift->id }}).submit();
                        }
                        else{
                          event.preventDefault();
                        }" class="btn">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {

$('.timepicker').timepicker({
               showInputs: false
                });

    var max_fields      = 7;
    var wrapper         = $(".input_fields_wrap");
    var add_button      = $(".add_field_button");

    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<tr><td><input type="text" name="day[]" class="form-control"></td><td><input type="time" name="time_from[]" class="form-control"></td><td><input type="time" name="time_to[]" class="form-control"></td><a href="#" class="remove_field">Remove</a></tr>');
        }
    });

    $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('tr').remove(); x--;
    });


    $("#field1").keyup(function(){
          $("#field3").val($("#field1").val() - $("#field2").val());
    });
    $("#field2").keyup(function(){
          $("#field3").val($("#field1").val() - $("#field2").val());
    });


    $("#field11").keyup(function(){
          $("#field31").val($("#field11").val() - $("#field21").val());
    });
    $("#field21").keyup(function(){
          $("#field31").val($("#field11").val() - $("#field21").val());
    });
});
</script

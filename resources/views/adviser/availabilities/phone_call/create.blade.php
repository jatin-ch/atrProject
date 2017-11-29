@extends('layouts.adviser')
@section('title') | Availability | Phone-call @endsection
@section('content')

<!-- <div class="container">
    <div class="row"> -->
      <section class="content-header">
      <h1>
        Availabilities
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Availability</a></li>
        <li class="active">Phone Call</li>
      </ol>
    </section>
    <hr>
    <section class="content">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Add Phone Call Availabilities
                </div>

                <div class="panel-body">
                  {!! Form::open(['route' => ['availabilities.store'], 'method' => 'POST']) !!}
                  {{ Form::hidden('consultation_mode', 'phone_call') }}
                       <div class="form-group">
                                <label >CHOOSE YOUR CONSULTATION TIME SLOT</label>
                                 <label class="ml20"><input type="radio" class="flat" name="time_slot" value="15" checked="" required /> 15 min </label>
                                 <label class="ml20"><input type="radio" class="flat" name="time_slot" value="30" required /> 30 min</label>
                                <label class="ml20"><input type="radio" class="flat" name="time_slot" value="45" required /> 45 min</label>
                                <label class="ml20"><input type="radio" class="flat" name="time_slot" value="60" required /> 60 min</label>
                                <label class="ml20"><input type="radio" class="flat" name="time_slot" value="70" required /> 70 min</label>
                                <label class="ml20"><input type="radio" class="flat" name="time_slot" value="90" required /> 90 min </label>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 {{ Form::label('consultation_fee', 'CONSULTATION FEES *') }}
                                 {{ Form::text('consultation_fee', null, ['class' => 'form-control', 'id' => 'field1']) }}
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                  {{ Form::label('consultation_commision', 'ADVICELI COMMISION') }}
                                  @if(isset(Auth::user()->commission))
                                  {{ Form::text('consultation_commision', Auth::user()->commission->price, ['class' => 'form-control', 'id' => 'field2', 'readonly'=>'']) }}
                                  @else
                                  {{ Form::text('consultation_commision', null, ['class' => 'form-control', 'id' => 'field2', 'readonly'=>'']) }}
                                  @endif
                              </div>
                           </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                 {{ Form::label('consultation_payout', 'YOUR PAYOUT') }}
                                 {{ Form::text('consultation_payout', null, ['class' => 'form-control', 'id' => 'field3', 'readonly' => '']) }}
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label> <input type="checkbox" name="free_consultation" value="1"> It's Free, I'm doing it for Society</label>
                              </div>
                           </div>
</div>

                    <div class="panel panel-default" style="margin: 10px">
                        <div class="panel-heading">
                         <label>Days and Tme Availabilty</label> <button class="btn btn-success btn-sm pull-right add_field_button" style="margin-top: -2px;">Add Shift</button>
                        </div>

                        <div class="panel-body">
                          <div class="col-md-12 input_fields_wrap">
                          <div class="col-md-4">
                              <div class="form-group">
                                 {{ Form::label('days', 'SELECT DAYS *') }}
                                 <select class="form-control" name="day[]">
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
                                                     <input type="time" name="time_from[]" style="width: 140%" class="form-control">
                                                    </div>
                                                    </div>
                                               </div>
                             </div>
                                <div class="col-md-4">
                               <div class="bootstrap-timepicker">
                                                    <div class="form-group">
                                                      <label>TO</label>
                                                     <div class="input-group">
                                                     <input type="time" name="time_to[]" style="width: 140%" class="form-control">
                                                    </div>
                                                    </div>
                                               </div>
                             </div>
                      </div>
                      <div class="col-md-12 text-center">
                        {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
                        </div>
                        </div>
                    </div>
                  </div>
                 {!! Form::close() !!}
                </div>
            </div>
        </div>
      </section>
    <!-- </div>
</div> -->

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

  var temp='<div class="col-md-4"><div class="form-group"><label>SELECT DAYS</label><select class="form-control" name="day[]"><option value="monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option> <option value="Saturday">Saturday</option><option value="Sunday">Sunday</option></select></div></div><div class="col-md-4"><div class="bootstrap-timepicker"><div class="form-group"><label>FROM</label><div class="input-group"><input type="text" name="time_from[]" style="width: 140%" class="form-control timepicker"></div></div></div></div><div class="col-md-4"><div class="bootstrap-timepicker"><div class="form-group"><label>TO</label><div class="input-group"><input type="text" name="time_to[]" style="width: 140%" class="form-control timepicker"></div></div></div></div>'

            // $(wrapper).append('<tr><td><input type="text" name="day[]" class="form-control"></td><td><input type="time" name="time_from[]" class="form-control"></td><td><input type="time" name="time_to[]" class="form-control"></td><td><a href="#" class="remove_field"><i class="fa fa-close"></i></a></td></tr>');
            $(wrapper).append(temp);
              $('.timepicker').timepicker({
               showInputs: false
                });
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
</script>

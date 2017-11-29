@extends('layouts.admin')
@section('content')



<section class="content-header">
      <h1>
         Availabilities({{$user->name}})
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Availabilities</a></li>
        <li class="active">Adviser</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
<div class="col-md-12">
<div class="panel panel-default">
        <div class="panel-heading">
         <label>Manage Availabilities:- </label>  <strong>{{$user->name}}</strong>
          <button class="btn btn-success btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Add New</button>
         <div class="modal fade" id="addpop1" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Availabilities</h4>
                </div>
         <div class="modal-body">
          {!! Form::open(['route' => ['availability.store'], 'method' => 'POST', 'files' => 'true', 'id' => 'addnew']) !!}
          {{ Form::hidden('user_id', $user->id) }}
          <div class="form-group">
            <table class="table">
              <tbody>
                <tr>
                  <th style="border:none">Consultation Mode</th>
                  @foreach($consultations as $consultation)
                  <td style="border:none">
                     <input type="radio" class="flat" name="consultation_mode" value="{{ $consultation->slug }}" checked="" required /> {{ $consultation->mode }}
                  </td>
                    @endforeach
                </tr>

                <tr>
                  <th style="border:none">Consultation time slot</th>
                  <td style="border:none">
                     <input type="radio" class="flat" name="time_slot" value="15" checked="" required /> 15 min
                  </td>
                  <td style="border:none">
                     <input type="radio" class="flat" name="time_slot" value="30" required /> 30 min
                  </td>
                  <td style="border:none">
                     <input type="radio" class="flat" name="time_slot" value="45" required /> 45 min
                  </td>
                  <td style="border:none">
                     <input type="radio" class="flat" name="time_slot" value="60" required /> 60 min
                  </td>
                </tr>

                <tr>
                  <th style="border:none">Number of questions to be asked</th>
                  <td style="border:none">
                     <input type="radio" class="flat" name="consultation_question" value="10" checked="" required /> 10
                  </td>
                  <td style="border:none">
                     <input type="radio" class="flat" name="consultation_question" value="15" required /> 15
                  </td>
                  <td style="border:none">
                     <input type="radio" class="flat" name="consultation_question" value="25" required /> 25
                  </td>
                </tr>

                <tr>
                  <td style="border:none">
                    {{ Form::label('consultation_fee', 'CONSULTATION FEES *') }}
                    {{ Form::text('consultation_fee', null, ['class' => 'form-control', 'id' => 'field1']) }}
                  </td>

                  <td style="border:none">
                    {{ Form::label('consultation_commision', 'ADVICELI COMMISION') }}
                    {{ Form::text('consultation_commision', null, ['class' => 'form-control', 'id' => 'field2']) }}
                  </td>

                  <td style="border:none">
                    {{ Form::label('consultation_payout', 'YOUR PAYOUT') }}
                    {{ Form::text('consultation_payout', null, ['class' => 'form-control', 'id' => 'field3', 'readonly' => '']) }}
                  </td>

                </tr>
                <tr>
                  <td style="border:none">
                    <input type="checkbox" name="free_consultation" value="1"> It's Free, I'm doing it for society
                  </td>
                </tr>

              </tbody>
            </table>


            <div class="panel panel-default">
                <div class="panel-heading">
                  FIRST SHIFT <button class="add_field_button">Add More Fields</button>
                </div>

                <div class="panel-body">
                  <table class="table">
                  <thead>
                    <tr>
                      <th>Day</th>
                      <th>Time from</th>
                      <th>Time to</th>
                      <th>Location</th>
                      <th></th>
                    </tr>
                  <thead>
                  <tbody class="input_fields_wrap">
                  <!-- <button class="add_field_button">Add More Fields</button> -->
                  <tbody>
                    <tr>
                      <td>
                        <input type="text" name="day[]" class="form-control">
                      </td>
                      <td>
                        <input type="time" name="time_from[]" class="form-control">
                      </td>
                      <td>
                        <input type="time" name="time_to[]" class="form-control">
                      </td>
                      <td>
                        <select name="location[]" class="form-control">
                          @foreach($user->locations as $location)
                          <option value="{{ $location->id }}">{{ $location->address }}</option>
                          @endforeach
                        </select>
                      </td>
                      </tr>
                    </tbody>
                </tbody>
              </table>
                </div>
            </div>
          </div>
         <button class="btn btn-success pull-right" onclick="document.getElementById(addnew).submit();">Submit</button>
         <br>
         {!! Form::close() !!}
         </div>
         </div>
         </div>
         </div>
        </div>
    </div>




@foreach($user->availabilities as $availability)
<div class="panel panel-default">
  <div class="panel-heading">
    <label>{{ $availability->consultation_mode }}</label>
      <button class="btn btn-warning btn-sm pull-right" data-target="#eap1{{$availability->id}}" data-toggle="modal"><i class="fa fa-pencil-square-o"></i> Edit</button>
      <div class="modal fade" data-keyboard="false" data-backdrop="static" id="eap1{{$availability->id}}" tabindex="-1">
      <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-header">
      <button class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Edit Availability:-{{$availability->consultation_mode}}</h4>
      </div>
      <div class="modal-body">
       {!! Form::model($availability, ['route' => ['availability.update', $availability->id], 'method' => 'PUT', 'id' => 'sf1'.$availability->id]) !!}
       {{ Form::hidden('user_id', $user->id) }}
       <div class="form-group">
         <table class="table">
           <tbody>
            @if($availability->consultation_mode == 'chat')
             <tr>
               <th style="border:none">Number of questions to be asked</th>
               <td style="border:none">
                  <input type="radio" class="flat" name="consultation_question" value="10" {{ $availability->consultation_question == '10'?'checked':'' }}> 10
               </td>
               <td style="border:none">
                  <input type="radio" class="flat" name="consultation_question" value="15" {{ $availability->consultation_question == '15'?'checked':'' }}> 15
               </td>
               <td style="border:none">
                  <input type="radio" class="flat" name="consultation_question" value="25" {{ $availability->consultation_question == '25'?'checked':'' }}> 25
               </td>
             </tr>
             @else
             <tr>
               <th style="border:none">Consultation time slot</th>
               <td style="border:none">
                  <input type="radio" class="flat" name="time_slot" value="15" {{ $availability->time_slot == '15'?'checked':'' }}> 15 min
               </td>
               <td style="border:none">
                  <input type="radio" class="flat" name="time_slot" value="30" {{ $availability->time_slot == '30'?'checked':'' }}> 30 min
               </td>
               <td style="border:none">
                  <input type="radio" class="flat" name="time_slot" value="45" {{ $availability->time_slot == '45'?'checked':'' }}> 45 min
               </td>
               <td style="border:none">
                  <input type="radio" class="flat" name="time_slot" value="60" {{ $availability->time_slot == '60'?'checked':'' }}> 60 min
               </td>
             </tr>
             @endif

             <tr>
               <td style="border:none">
                 {{ Form::label('consultation_fee', 'CONSULTATION FEES *') }}
                 {{ Form::text('consultation_fee', null, ['class' => 'form-control', 'id' => 'field11']) }}
               </td>

               <td style="border:none">
                 {{ Form::label('consultation_commision', 'ADVICELI COMMISION') }}
                 {{ Form::text('consultation_commision', null, ['class' => 'form-control', 'id' => 'field21']) }}
               </td>

               <td style="border:none">
                 {{ Form::label('consultation_payout', 'YOUR PAYOUT') }}
                 {{ Form::text('consultation_payout', null, ['class' => 'form-control', 'id' => 'field31', 'readonly' => '']) }}
               </td>

             </tr>
             <tr>
               <td style="border:none">
                 <input type="checkbox" name="free_consultation" value="1"> It's Free, I'm doing it for society
               </td>
               <td style="border:none"></td><td style="border:none"></td><td style="border:none"></td>
               <td style="border:none"><button class="btn btn-success btn-sm pull-right" onclick="document.getElementById(sf1{{ $availability->id }}).submit();">Save</button></td>
             </tr>

           </tbody>
         </table>
         <br>
       </div>
      {!! Form::close() !!}
      </div>
      </div>
      </div>
      </div>
  </div>
  <div class="panel-body">

    @if($availability->consultation_mode == 'chat')
    <p>Questions to be asked : <strong>{{ $availability->consultation_question }}</strong></p>
    @else
    <p>Time Slot : <strong>{{$availability->time_slot}} min</strong></p>
    @endif

    @if(isset($availability->free_conslutation))
    <p>Consultation fees : <strong>It's free, I'm doing it for society</strong></p>
    @else
    @if(isset($availability->consultation_commision))
      <p>Consultation Payout : <strong>INR {{ $availability->consultation_fee }} /-</strong> <strong>INR {{ $availability->consultation_fee }} /-</strong></p>
    @else
      <p>Consultation Payout : <strong>INR {{ $availability->consultation_fee }} /-</strong></p>
    @endif
    @endif

   <p>
    {!! Form::open(['route' => ['availability.destroy', $availability->id], 'method' => 'DELETE', 'id' => 'dl'.$availability->id]) !!}
     {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'style' => 'cursor:pointer']) }}
    {!! Form::close() !!}
  </p>

  <div class="panel panel-default">
      <div class="panel-heading">
       <label> FIRST SHIFT</label>
        <button class="btn btn-success btn-sm pull-right" data-target="#afsp{{$availability->id}}" data-toggle="modal">Add First Shifts</button>
       <div class="modal fade" data-keyboard="false" data-backdrop="static" id="afsp{{$availability->id}}" tabindex="-1">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
      <button class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Shifts</h4>
      </div>
       <div class="modal-body">
         {!! Form::open(['route' => ['firstshift.store'], 'method' => 'POST']) !!}
          {{ Form::hidden('availability_id', $availability->id) }}
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Day</label>
                <input type="text" name="day" class="form-control" placeholder="day">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>From</label>
               <input type="time" name="time_from" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>To</label>
                  <input type="time" name="time_to" class="form-control">
              </div>
            </div>
            @if($availability->consultation_mode == 'personal_meeting')
             <div class="col-md-12">
              <div class="form-group">
                <label>Locations</label>
                 <select name="location" class="form-control">
                     @foreach($user->locations as $location)
                     <option value="{{ $location->id }}">{{ $location->address }}</option>
                     @endforeach
                   </select>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="form-group">
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
            <th>Time Slot</th>
            <th>Location</th>
            <th></th>
            <th></th>
          </tr>
        <thead>
        <tbody>
        <tbody>
          @foreach($availability->firstshifts as $firstshift)
          <tr>
            <td>{{ $firstshift->day }}</td>
            <td>{{ date('g:i A', strtotime($firstshift->time_from))}} - {{ date('g:i A', strtotime($firstshift->time_to))}}</td>
            <td>{{$firstshift->location->address}}</td>
            <td>
              <button class="btn btn-default btn-sm" data-target="#fsp{{$firstshift->id}}" data-toggle="modal">Edit</button>
             <div class="modal fade" data-keyboard="false" data-backdrop="static" id="fsp{{$firstshift->id}}" tabindex="-1">
             <div class="modal-dialog modal-md">
             <div class="modal-content">
             <div class="modal-body">
               {!! Form::open(['route' => ['firstshift.update'], 'method' => 'POST']) !!}
               {{ Form::hidden('firstshift_id', $firstshift->id) }}
                 <table class="table">
                   <tbody>
                     <tr>
                       <td style="border:none">
                         <input type="text" name="day" class="form-control" value="{{$firstshift->day}}">
                       </td>
                       <td style="border:none">
                         <input type="time" name="time_from" class="form-control" value="{{$firstshift->time_from}}">
                       </td>
                       <td style="border:none">
                         <input type="time" name="time_to" class="form-control" value="{{$firstshift->time_to}}">
                       </td>
                     </tr>
                     <tr>
                       @if($availability->consultation_mode == 'personal_meeting')
                       <td style="border:none">
                         <select name="location" class="form-control">
                           @foreach($user->locations as $location)
                           <option value="{{ $location->id }}">{{ $location->address }}</option>
                           @endforeach
                         </select>
                       </td>
                       @endif
                       <td style="border:none">
                         {{ Form::submit('save', ['class' => 'btn btn-primary btn-sm']) }}
                         <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">cancel</button>
                       </td>
                     </tr>
                   </tbody>
                 </table>
               {!! Form::close() !!}
             </div>
             </div>
             </div>
             </div>
            </td>
            <td>
               {!! Form::open(['route' => ['firstshift.destroy', $firstshift->id], 'method' => 'DELETE', 'id' => 'dl'.$firstshift->id]) !!}
                {{ Form::submit('Delete', ['class' => 'btn btn-default btn-sm', 'style' => 'color:#a00;cursor:pointer']) }}
               {!! Form::close() !!}
             </td>
          </tr>
          @endforeach
          </tbody>
      </tbody>
      </table>
      </div>
  </div>

  </div>
</div>
@endforeach



</div>
</div>
</div>
</section>

@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
    var max_fields      = 7;
    var wrapper         = $(".input_fields_wrap");
    var add_button      = $(".add_field_button");

    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<tr><td><input type="text" name="day[]" class="form-control"></td><td><input type="time" name="time_from[]" class="form-control"></td><td><input type="time" name="time_to[]" class="form-control"></td><td><select name="location[]" class="form-control">@foreach($user->locations as $location)<option value="{{ $location->id }}">{{ $location->address }}</option>@endforeach</select></td><a href="#" class="remove_field">Remove</a></tr>');
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

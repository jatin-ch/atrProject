@extends('layouts.app')
@section('content')

<!-- <div class="container">
    <div class="row"> -->
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Generate Invoice
                </div>

                <div class="panel-body">
                  {!! Form::open(['route' => ['invoice.consultation.store'], 'method' => 'POST', 'id' => 'sf123']) !!}
                  <div class="form-group">
                    {{ Form::label('consultation_booking_id', 'Select Booking') }}
                      @foreach($bookings as $booking)
                      <input type="checkbox" name="consultation_booking_id[]" value="{{ $booking->id }}"> {{ $booking->id }}
                      @endforeach
                      <br>

                      {{ Form::label('status', 'Status') }}
                       <select name="status" class="form-control">
                       <option value="paid">Paid</option>
                       <option value="canceled">Canceled</option>
                       <option value="pending">Pending</option>
                       <option value="panelty">Panelty</option>
                       </select>
                    </div>

                    <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(sf123).submit();">Submit</button>
                   <br>
                 {!! Form::close() !!}
                </div>
            </div>
        </div>
    <!-- </div>
</div> -->

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
    var max_fields1      = 4;
    var wrapper1         = $(".input_fields_wrap1");
    var add_button1      = $(".add_field_button1");

    var x1 = 1;
    $(add_button1).click(function(e){
        e.preventDefault();
        if(x1 < max_fields1){
            x1++;
            $(wrapper1).append('<div style="margin-top:20px"><input type="text" name="benifit[]" class="form-control"><a href="#" class="remove_field">Remove</a></div>');
        }
    });

    $(wrapper1).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x1--;
    });


    var max_fields2      = 4;
    var wrapper2         = $(".input_fields_wrap2");
    var add_button2      = $(".add_field_button2");

    var x2 = 1;
    $(add_button2).click(function(e){
        e.preventDefault();
        if(x2 < max_fields2){
            x2++;
            $(wrapper2).append('<div style="margin-top:20px"><input type="text" name="include[]" class="form-control"><a href="#" class="remove_field">Remove</a></div>');
        }
    });

    $(wrapper2).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x2--;
    });


    $("#field1").keyup(function(){
          $("#field3").val($("#field1").val() - $("#field2").val());
    });
    $("#field2").keyup(function(){
          $("#field3").val($("#field1").val() - $("#field2").val());
    });

});
</script

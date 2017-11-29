@extends('layouts.adviser')
@section('title') | Service | {{$service->name}} @endsection
@section('content')

{!! Html::style('css/select2.min.css') !!}

<script>
 $('input').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
</script>
<section class="content-header">
      <h1>
        Edit the service
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Service</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
 <section class="content">
        <div class="container-fluid">
            <div class="row basicdetail">
                {!! Form::model($service, ['route' => ['services.update', $service->id], 'method' => 'PUT', 'files' => 'true']) !!}
                    <div class=" col-lg-offset-1 col-lg-10 mt10">
                        <div class="form-control">
                          <label>Timeline * </label>
                           Active: <input type="radio" name="timeline" value="1" {{ $service->timeline == '1' ? "checked" : "" }}>
                           Inactive: <input type="radio" name="timeline" value="0" {{ $service->timeline == '0' ? "checked" : "" }}>
                        </div>
                        <div class="form-group" style="margin-top:20px">
                          {{ Form::label('name', 'NAME OF THE SERVICE *') }}
                          {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Type your service name']) }}
                        </div>
                        <div class="row mr0 mb10 mt10">
                            <div class="col-lg-4 pd0">
                              {{ Form::label('duration', 'SERVICE TIME DURATION *') }}
                              <select name="duration" class="form-control">
                                <option value="15" {{$service->duration=='15'?'selected':''}}>15 min</option>
                                <option value="30" {{$service->duration=='30'?'selected':''}}>30 min</option>
                                <option value="45" {{$service->duration=='45'?'selected':''}}>45 min</option>
                                <option value="60" {{$service->duration=='60'?'selected':''}}>60 min</option>
                              </select>
                            </div>
                            <div class="col-lg-4 pd0 pdl10">
                              {{ Form::label('validity', 'VALIDITY *') }}
                              <select name="validity" class="form-control">
                                <option value="15" {{$service->validity=='15'?'selected':''}}>15 days</option>
                                <option value="30" {{$service->validity=='30'?'selected':''}}>30 days</option>
                                <option value="45" {{$service->validity=='45'?'selected':''}}>45 days</option>
                                <option value="60" {{$service->validity=='60'?'selected':''}}>60 days</option>
                              </select>
                            </div>
                            <div class="col-lg-4 pd0 pdl10">
                              {{ Form::label('frequency', 'FREQUENCY *') }}
                              <select name="frequency" class="form-control">
                                <option value="1" {{$service->frequency=='1'?'selected':''}}>1</option>
                                <option value="2" {{$service->frequency=='2'?'selected':''}}>2</option>
                                <option value="3" {{$service->frequency=='3'?'selected':''}}>3</option>
                                <option value="4" {{$service->frequency=='4'?'selected':''}}>4</option>
                              </select>
                            </div>
                        </div>
                        <div class="row mr0 mb10 benft">
                            <div class="col-lg-4">
                                <div class="form-group">
                                  {{ Form::label('price', 'Price(INR) *') }}
                                  {{ Form::text('price', null, ['class' => 'form-control br1', 'id' => 'field1']) }}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                  {{ Form::label('commision', 'Adviceli Commission') }}
                                  @if(isset(Auth::user()->commission))
                                  {{ Form::text('commision', Auth::user()->commission->price, ['class' => 'form-control br1', 'id' => 'field2', 'readonly'=>'']) }}
                                  @else
                                  {{ Form::text('commision', null, ['class' => 'form-control br1', 'id' => 'field2', 'readonly'=>'']) }}
                                  @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('payout', 'Your Payout') }}
                                    {{ Form::text('payout', null, ['class' => 'form-control br1', 'id' => 'field3', 'readonly' => '']) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt10">
                          {{ Form::label('details', 'ABOUT/SERVICE AND PACKEAGE *') }}
                          {{ Form::textarea('details', null, ['class' => 'form-control', 'rows' => '2']) }}
                        </div>
                        <div class="form-group mt10">
                            <label>CHOOSE MODE OF SERVICE *</label>
                            <div>
                              {{ Form::select('consultations[]', $consultations, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}
                            </div>

                        </div>
                        <div class="form-group mt10">
                          <label>Is physically visit mendatory  ?  </label>
                          <label><input type="radio" name="presence" value="1" {{$service->presence=='1'?'checked':''}}> Yes</label>
                          <label><input type="radio"  name="presence"  value="0" {{$service->presence=='0'?'checked':''}}> No</label>
                        </div>
                        <div class="text-center col-lg-offset-2 mb10">
                          {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>


{!! Html::script('js/select2.min.js') !!}
<script type='text/javascript'>
  $('.select2-multi').select2();
</script>



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
            $(wrapper1).append('<div style="margin-top:20px"><input type="text" name="benifit[]" class="form-control" placeholder="Type your feature"><a href="#" class="remove_field"><i class="fa fa-close"></i></a></div>');
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
            $(wrapper2).append('<div style="margin-top:20px"><input type="text" name="include[]" class="form-control" placeholder="Type your package"><a href="#" class="remove_field"><i class="fa fa-close"></i></a></div>');
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
</script>

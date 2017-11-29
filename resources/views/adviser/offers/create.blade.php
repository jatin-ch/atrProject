@extends('layouts.adviser')
@section('title') | Offers | Create @endsection
@section('content')

<style>
    .headlines{
        color: skyblue;
    }
</style>

<section class="content-header">
    <h1>
        Create New Offer
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Create New Offer</a></li>

    </ol>
</section>
<hr style="border-top: 1px solid #00a65a;">

<section class="content">
    <div class="container-fluid">
        <div class="row">
          {!! Form::open(['route' => 'offers.store', 'method' => 'POST']) !!}
            <div class="col-lg-offset-1 col-lg-10 bdr-offer">
              <div class="ml30">
                {{ Form::label('title', 'OFFER TITLE *') }}
                {{ Form::text('title', null, ['class' => 'form-control']) }}
              </div> <br>
                <div class="ml30">
                    <label class="inline"><b>OFFER FOR:</b></label>
                    <label class="radio-inline"><input type="radio" class="consultation1" name="offer_for" value="consultation" checked="" required onchange="valueChanged()">Consultation</label>
                    <label class="radio-inline"><input type="radio" class="service1" name="offer_for"  value="service" onchange="valueChanged()">Service</label>
                </div>
                <div class="col-lg-12 pt20">
                    <div class=" col-lg-12 form-group">
                        <label><b>DISCOUNT TYPE:</b></label>
                        <div>
                            <label class="inline"><input type="radio" class="pd1" name="discount_type"  value="percent" checked="" required onchange="typeChanged()">Percent Discount</label>
                            <label class="radio-inline"><input type="radio" class="fd1" name="discount_type"  value="flat" onchange="typeChanged()">Flat Discount</label>
                        </div>
                    </div>

                    <div ng-show="percentDiscount" class="col-lg-4 form-group pd2">
                            <label>PERCENT DISCOUNT</label>
                            <select ng-model="newOff.percentDis" placeholder="choose your percent" id="selectDiscount" class="form-control" name="percent_discount">
                              <option value="10">10%</option>
                              <option value="20">20%</option>
                              <option value="30">30%</option>
                              <option value="40">40%</option>
                              <option value="50">50%</option>
                              <option value="50">50%</option>
                              </select>
                        </div>
                    <div ng-show="flatDiscount" class="col-lg-4 form-group pd2">
                      {{ Form::label('discount_limit', 'DISCOUNT LIMIT') }}
                      {{ Form::text('discount_limit', null, ['class' => 'form-control']) }}
                    </div>
                    <div ng-show="flatDiscount" class="col-lg-4 form-group fd2" style="display:none">
                      {{ Form::label('flat_discount', 'FLAT DISCOUNT') }}
                      {{ Form::text('flat_discount', null, ['class' => 'form-control']) }}
                    </div>
                </div>


            </div>
            <div class="col-lg-offset-1 col-lg-10 bdr-offer mt30">
            <div  class="col-lg-6">
             <div class="bootstrap-timepicker">
               <div class="form-group">
                 <div class="input-group">
                 <div class="input-group-addon">
                    <span>From</span>
                   </div>
                   <input type="date" name="valid_from" style="width: 105%" class="form-control datepicker">
                 </div>
               </div>
             </div>
              </div>
              <div  class="col-lg-6">
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                   <div class="input-group">
                     <div class="input-group-addon">
                      <span>To</span>
                     </div>
                   <input type="date" name="valid_to" style="width: 105%" class="form-control datepicker">
                 </div>
               </div>

                </div>
              </div>
            </div>
                <div  class="col-lg-offset-1 col-lg-10 bdr-offer mt30 consultation2">
                <div class="form-group">
                  <strong>Mode:</strong>
                    <div class="radio">
                      @foreach($consultations as $consultation)
                        <label class="radio-inline"><input type="checkbox" name="consultations[]" value="{{ $consultation->id }}"> {{ $consultation->mode }}</label>
                      @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-offset-1 col-lg-10 bdr-offer" >
                <div class="service2" style="display:none">
                    <div class="form-group">
                        <label><b>Choose your Service For Offer/Discount</b></label><br>
                        <label><input type="checkbox" /><label> <b> For All Services</b></label></label>
                    </div>
                    <div class="form-group">
                    <div class="radio">
                      @foreach($services as $service)
                      <label class="radio-inline"><input type="checkbox" name="services[]" value="{{ $service->id }}"> {{ $service->name }} </label>
                      @endforeach
                    </div>
                     </div>
                </div>
                  <div class=" col-lg-12 bdr-offer mt30">
                    {{ Form::label('more', 'More about offer') }}
                    {{ Form::textarea('more', null, ['class' => 'form-control', 'rows' => '3']) }}
                 </div>
            </div>
            <div class="col-lg-offset-2 col-lg-8 pt20 text-center">
                {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>


<script type="text/javascript">
function valueChanged()
{
    if($('.consultation1').is(":checked"))
        $(".consultation2").show();
    else
        $(".consultation2").hide();

    if($('.service1').is(":checked"))
        $(".service2").show();
    else
        $(".service2").hide();
}

function typeChanged()
{
    if($('.pd1').is(":checked"))
        $(".pd2").show();
    else
        $(".pd2").hide();

    if($('.fd1').is(":checked"))
        $(".fd2").show();
    else
        $(".fd2").hide();
}
</script>


@endsection

@extends('layouts.admin')
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

          <div class="col-md-11">
              <div class="panel panel-default">
                  <div class="panel-body">
                    {!! Form::open(['route' => 'admin.offers.store', 'method' => 'POST']) !!}
                    <div class="form-group">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td style="border:none">
                              {{ Form::label('userId', 'CHOOSE ADVISER *') }}
                              <select class="form-control" name="userId">
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td style="border:none">
                              {{ Form::label('title', 'OFFER TITLE *') }}
                              {{ Form::text('title', null, ['class' => 'form-control']) }}
                            </td>
                          </tr>
                        </tbody>
                      </table>

                      <label style="margin-top:20px">OFFER FOR:</label>
                      <input type="radio" class="flat consultation1" name="offer_for" value="consultation" checked="" required onchange="valueChanged()"> Consultation
                      <input type="radio" class="flat service1" name="offer_for"  value="service" onchange="valueChanged()"> Service
                      <br>

                      <label style="margin-top:20px">DISCOUNT TYPE:</label>
                      <input type="radio" class="flat pd1" name="discount_type"  value="percent" checked="" required onchange="typeChanged()"> Percent Discount
                      <input type="radio" class="flat fd1" name="discount_type"  value="flat" onchange="typeChanged()"> Flat Discount
                      <br>

                      </div>
                      <br>

                      <table class="table">
                        <tbody>
                          <tr>
                            <td class="pd2" style="border:none">
                              <label>PERCENT DISCOUNT:</label>
                              <select name="percent_discount" class="form-control">
                              <option value="10">10%</option> <option value="20">20%</option> <option value="30">30%</option>
                              <option value="40">40%</option> <option value="50">50%</option> <option value="50">50%</option>
                              </select>
                            </td>
                            <td class="pd2" style="border:none">
                              {{ Form::label('discount_limit', 'DISCOUNT LIMIT') }}
                              {{ Form::text('discount_limit', null, ['class' => 'form-control']) }}
                            </td>
                            <td class="fd2" style="border:none; display:none">
                              {{ Form::label('flat_discount', 'FLAT DISCOUNT') }}
                              {{ Form::text('flat_discount', null, ['class' => 'form-control']) }}
                            </td>
                          </tr>
                        </tbody>
                      </table>

                      <div class="consultation2">
                      {{ Form::label('consultations', 'Select Consultation Type', ['style' => 'margin-top:20px']) }}
                      @foreach($consultations as $consultation)
                      <input type="checkbox" name="consultations[]" value="{{ $consultation->id }}"> {{ $consultation->mode }}
                      @endforeach
                      </div>
                      <br>

                      <div class="service2" style="display:none">
                      {{ Form::label('services', 'Choose your Service for offer', ['style' => 'margin-top:20px']) }} <br>
                      @foreach($services as $service)
                      <input type="checkbox" name="services[]" value="{{ $service->id }}"> {{ $service->name }} <br>
                      @endforeach
                      </div>


                      <table class="table" style="margin-top:20px;">
                        <tbody>
                          <tr>
                            <td style="border:none">
                              {{ Form::label('valid_from', 'Valid From') }}
                              {{ Form::date('valid_from', null, ['class' => 'form-control']) }}
                            </td>
                            <td style="border:none">
                              {{ Form::label('valid_to', 'Valid To') }}
                              {{ Form::date('valid_to', null, ['class' => 'form-control']) }}
                            </td>
                          </tr>
                        </tbody>
                      </table>

                      {{ Form::label('more', 'More about offer', ['style' => 'margin-top:20px']) }}
                      {{ Form::textarea('more', null, ['class' => 'form-control', 'rows' => '3']) }}
                      <br>

                      {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}

                   {!! Form::close() !!}
                  </div>
              </div>
          </div>

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

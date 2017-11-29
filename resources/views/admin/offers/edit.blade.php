@extends('layouts.admin')
@section('title') | Offers | {{$offer->title}} @endsection
@section('content')

<style>
    .headlines{
        color: skyblue;
    }
</style>
{!! Html::style('css/select2.min.css') !!}

<section class="content-header">
    <h1>
        Edit The Offer
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>{{$offer->title}}</a></li>

    </ol>
</section>
<hr style="border-top: 1px solid #00a65a;">
<section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-md-11">
              <div class="panel panel-default">
                  <div class="panel-body">
                    {!! Form::model($offer, ['route' => ['admin.offers.update', $offer->id], 'method' => 'PUT', 'id' => 'sf1'.$offer->id]) !!}
                    <div class="form-group">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td style="border:none">
                              {{ Form::label('title', 'OFFER TITLE *') }}
                              {{ Form::text('title', null, ['class' => 'form-control']) }}
                            </td>
                          </tr>
                        </tbody>
                      </table>

                      <label style="margin-top:20px">OFFER FOR:</label>
                      <input type="radio" class="flat" name="offer_for" value="consultation" {{$offer->offer_for=='consultation'?'checked':''}}> Consultation
                      <input type="radio" class="flat" name="offer_for"  value="service" {{$offer->offer_for=='service'?'checked':''}}> Service
                      <br>

                      <label style="margin-top:20px">DISCOUNT TYPE:</label>
                      <input type="radio" class="flat" name="discount_type"  value="percent" {{$offer->discount_type=='percent'?'checked':''}}> Percent Discount
                      <input type="radio" class="flat" name="discount_type"  value="flat" {{$offer->discount_type=='flat'?'checked':''}}> Flat Discount
                      <br>

                      </div>
                      <br>

                      <table class="table">
                        <tbody>
                          <tr>
                            <td style="border:none">
                              <label>PERCENT DISCOUNT:</label>
                              <select name="percent_discount" class="form-control">
                              <option value="10" {{$offer->percent_discount=='10'?'selected':''}}>10%</option>
                              <option value="20" {{$offer->percent_discount=='20'?'selected':''}}>20%</option>
                              <option value="30" {{$offer->percent_discount=='30'?'selected':''}}>30%</option>
                              <option value="40" {{$offer->percent_discount=='40'?'selected':''}}>40%</option>
                              <option value="50" {{$offer->percent_discount=='50'?'selected':''}}>50%</option>
                              <option value="50" {{$offer->percent_discount=='60'?'selected':''}}>50%</option>
                              </select>
                            </td>
                            <td style="border:none">
                              {{ Form::label('discount_limit', 'DISCOUNT LIMIT') }}
                              {{ Form::text('discount_limit', null, ['class' => 'form-control']) }}
                            </td>
                            <td style="border:none">
                              {{ Form::label('flat_discount', 'FLAT DISCOUNT') }}
                              {{ Form::text('flat_discount', null, ['class' => 'form-control']) }}
                            </td>
                          </tr>
                        </tbody>
                      </table>

                      {{ Form::label('consultations', 'Select Consultation Type', ['style' => 'margin-top:20px']) }}
                      {{ Form::select('consultations[]', $consultations, null, ['class' => 'form-control select1-multi', 'multiple' => 'multiple']) }}
                      <br>

                      {{ Form::label('services', 'Choose your Service for offer', ['style' => 'margin-top:20px']) }} <br>
                      {{ Form::select('services[]', $services, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}



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

{!! Html::script('js/select2.min.js') !!}
<script type='text/javascript'>
  $('.select1-multi').select2();
  $('.select2-multi').select2();
</script>

@endsection

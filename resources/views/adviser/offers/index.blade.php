@extends('layouts.adviser')
@section('title') | Offers @endsection
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
       Offers
     </h1>
     <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Offers</a></li>
       <li class="active">Existing</li>
     </ol>
   </section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                 <div class="card">
                                    <ul class="nav nav-tabs text-center" role="tablist">
                                        <li class="menu" role="presentation" class="active"><a href="#existing" aria-controls="existing" role="tab" data-toggle="tab">Offer Ended</a></li>
                                        <li class="menu" role="presentation"><a href="#running" aria-controls="#running" role="tab" data-toggle="tab">Running Offer</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="existing">
                                 <div class="row">
                                  @foreach($offers as $offer)
                                  @if(Carbon\Carbon::parse($offer->valid_to) < Carbon\Carbon::now())
                                  <div class="col-lg-12 basicdetail" style="margin: 0px!important;border: 1px solid #dcdce6;border-radius: 3px;">
                                    <div class="col-lg-10">

                                        <div class="col-lg-12 form-inline">
                                                 <strong>Offer Title :</strong>
                                                 <span>{{ $offer->title }}</span>
                                       </div>

                                       <div class=" col-lg-4 mt20 form-inline">
                                                 <strong>Offer On :</strong>
                                                 <span>{{ $offer->offer_for }}</span>
                                       </div>
                                         <div class="col-lg-4 mt20 form-inline">
                                                 <strong>Start Date :</strong>
                                               <span>{{date('j M Y', strtotime($offer->valid_from))}}</span>
                                       </div>
                                        <div class="col-lg-4 mt20 form-inline">
                                          @if($offer->discount_type == 'percent')
                                          <strong>Discount</strong> : <span>{{$offer->percent_discount}}% , </span>
                                            @if(isset($offer->discount_limit))
                                            <strong>Max</strong> : <span>INR {{$offer->discount_limit}} /- </span>
                                            @endif
                                          @else
                                          <strong>Discount</strong> : <span>INR {{$offer->flat_discount}} /- </span>
                                          @endif
                                       </div>
                                        <div class="col-lg-4 mt20 form-inline">
                                                 <strong>Discount Type :</strong>
                                                  <span>{{ $offer->discount_type }}</span>
                                       </div>
                                       <div class="col-lg-4 mt20 form-inline">
                                              <strong>End Date :</strong>
                                        <span>{{date('j M Y', strtotime($offer->valid_to))}}</span>
                                       </div>
                                       <div class="col-lg-4 mt20 form-inline">
                                        <label>
                                          @if($offer->offer_for == 'service')
                                          <strong>Total Services({{ $offer->services->count() }})</strong>
                                          @else
                                          <strong>Total Consultations({{ $offer->consultations->count() }})</strong>
                                          @endif
                                        </label>
                                       </div>

                                    </div>

                                    <div class="col-lg-2 text-center" style="border-left: 1px solid; padding: 10px;margin-bottom: 10px">

                                        <a href="{{route('offers.show', $offer->id)}}" class="btn btn-default mt10">View Offer</a>

                                        <a href="{{route('offers.edit', $offer->id)}}" class="btn btn-default mt10">Edit Offer</a>

                                        {{ Form::open(['route' => ['offers.destroy', $offer->id], 'method' => 'DELETE', 'id' => $offer->id]) }}
                                        {{ Form::close() }}
                                        <a onclick="
                                           if(confirm('Are you sure, You Want to delete this?'))
                                               {
                                                 event.preventDefault();
                                                 document.getElementById({{ $offer->id }}).submit();
                                               }
                                               else{
                                                 event.preventDefault();
                                               }" class="btn btn-default mt10" >End Offer
                                        </a>
                                    </div>
                                    </div>
                                  @endif
                                  @endforeach
                         </div>
        </div>


                                        <div role="tabpanel" class="tab-pane" id="running">
                                           <div class="row">
                            <div class="col-lg-12">
                             <div class="col-lg-4">
                                           <div class="form-group">
                                               <label class="clrblck" for="date">Offer Running On</label>
                                               <select class="form-control">
                                                   <option value="today">All</option>
                                               </select>
                                           </div>
                                       </div>
                                        <div class="col-lg-4">
                                           <div class="form-group">
                                               <label class="clrblck" for="date">Discount Type</label>
                                               <select class="form-control">
                                                   <option value="today">All</option>
                                               </select>
                                           </div>
                                       </div>
                                        <div class="col-lg-4">
                                           <div class="form-group">
                                               <label class="clrblck" for="date">Offer End Date</label>
                                               <select class="form-control">
                                                   <option value="today">Ascending</option>
                                               </select>
                                           </div>
                                       </div>
                            </div>

                            @foreach($offers as $offer)
                            @if(Carbon\Carbon::parse($offer->valid_from) <= Carbon\Carbon::now() && Carbon\Carbon::parse($offer->valid_to) >= Carbon\Carbon::now())
                            <div class="col-lg-12 basicdetail" style="margin: 0px!important;border: 1px solid #dcdce6;border-radius: 3px;">
                              <div class="col-lg-10">

                                  <div class="col-lg-12 form-inline">
                                           <strong>Offer Title :</strong>
                                           <span>{{ $offer->title }}</span>
                                 </div>

                                 <div class=" col-lg-4 mt20 form-inline">
                                           <strong>Offer On :</strong>
                                           <span>{{ $offer->offer_for }}</span>
                                 </div>
                                   <div class="col-lg-4 mt20 form-inline">
                                           <strong>Start Date :</strong>
                                         <span>{{date('j M Y', strtotime($offer->valid_from))}}</span>
                                 </div>
                                  <div class="col-lg-4 mt20 form-inline">
                                    @if($offer->discount_type == 'percent')
                                    <strong>Discount</strong> : <span>{{$offer->percent_discount}}% , </span>
                                      @if(isset($offer->discount_limit))
                                      <strong>Max</strong> : <span>INR {{$offer->discount_limit}} /- </span>
                                      @endif
                                    @else
                                    <strong>Discount</strong> : <span>INR {{$offer->flat_discount}} /- </span>
                                    @endif
                                 </div>
                                  <div class="col-lg-4 mt20 form-inline">
                                           <strong>Discount Type :</strong>
                                            <span>{{ $offer->discount_type }}</span>
                                 </div>
                                 <div class="col-lg-4 mt20 form-inline">
                                        <strong>End Date :</strong>
                                  <span>{{date('j M Y', strtotime($offer->valid_to))}}</span>
                                 </div>
                                 <div class="col-lg-4 mt20 form-inline">
                                  <label>
                                    @if($offer->offer_for == 'service')
                                    <strong>Total Services({{ $offer->services->count() }})</strong>
                                    @else
                                    <strong>Total Consultations({{ $offer->consultations->count() }})</strong>
                                    @endif
                                  </label>
                                 </div>

                              </div>

                              <div class="col-lg-2 text-center" style="border-left: 1px solid; padding: 10px;margin-bottom: 10px">

                                  <a href="{{route('offers.show', $offer->id)}}" class="btn btn-default mt10">View Offer</a>

                                  <a href="{{route('offers.edit', $offer->id)}}" class="btn btn-default mt10">Edit Offer</a>

                                  {{ Form::open(['route' => ['offers.destroy', $offer->id], 'method' => 'DELETE', 'id' => $offer->id]) }}
                                  {{ Form::close() }}
                                  <a onclick="
                                     if(confirm('Are you sure, You Want to delete this?'))
                                         {
                                           event.preventDefault();
                                           document.getElementById({{ $offer->id }}).submit();
                                         }
                                         else{
                                           event.preventDefault();
                                         }" class="btn btn-default mt10" >End Offer
                                  </a>
                              </div>
                              </div>
                             @endif
                            @endforeach

                         </div>
                      </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>

</section>



@endsection

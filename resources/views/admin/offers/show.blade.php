@extends('layouts.admin')
@section('title') | Offers | {{$offer->title}} @endsection
@section('content')

<section class="content-header">
     <h1>
      {{$offer->title}}
     </h1>
     <ol class="breadcrumb">
       <li><a href="{{route('offers.index')}}"><i class="fa fa-dashboard"></i> Offer</a></li>
       @if($offer->offer_for == 'service')
       <li class="active">Services</li>
       @else
       <li class="active">Consultations</li>
       @endif
     </ol>
   </section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
       <div class="container-fluid">
           <div class="row basicdetail">
               <div class="col-lg-12">
                   <div class="box box-default">
                       <div class="box-header with-border heading">
                           <div class="col-lg-8">
                               <div class="input-group">
                                   <input type="text" class="form-control" placeholder="Search">
                                   <div class="input-group-btn">
                                       <button class="btn btn-default" style="height:34px;" type="submit">
                                           <i class="glyphicon glyphicon-search"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>

                       </div>

                       <div class="box-body pd10">
                           <!-- ng-repeat start here -->
                        @if($offer->offer_for == 'service')
                          @foreach($offer->services as $service)
                           <div class="col-lg-6">
                               <div class="box box-default" style="border-top-color: #5a8dff!important;">
                                   <div class="box-header text-center serbg with-border heading">
                                       <label>{{ $service->name }}</label> |
                                       <strong>
                                       @if($offer->discount_type == 'percent')
                                       {{$offer->percent_discount}}% Off
                                       @else
                                       flat INR {{$offer->flat_discount}} /- Off
                                       @endif
                                     </strong>
                                   </div>
                                   <!-- ng-repeat start here -->
                                   <div class="box-body pd10">
                                       <label class="pull-left">Feature/Benifits of the Package</label>
                                       @if($offer->discount_type == 'percent')
                                       <div class="imageContainer">
                                           <img src=" /images/offer-bench.png" />
                                       <span>{{$offer->percent_discount}}% Off</span></div>
                                       @else
                                       <div class="imageContainer">
                                           <img src=" /images/offer-bench.png" />
                                       <span>{{$offer->flat_discount}} /-Off</span></div>
                                       @endif
                                       <ul class="mt-30">
                                         @foreach($service->benifits as $benifit)
                                           <li>
                                               <p>{{ $benifit->benifit }}</p>
                                           </li>
                                          @endforeach
                                       </ul>
                                       <label>Feature/Benifits of the Package</label>
                                       <ul>
                                         @foreach($service->packages as $package)
                                           <li>
                                               <p>{{ $package->include }}</p>
                                           </li>
                                          @endforeach
                                       </ul>
                                       <label class="pull-left mr10">Service Time Duration:</label>
                                       <p>{{ $service->duration }} Min</p>
                                       <label class="pull-left mr10">Validity:</label>
                                       <p>{{ $service->validity }} Days</p>
                                       <label class="pull-left mr10">Frequency:</label>
                                       <p>{{ $service->frequency }}</p>
                                       <label class="pull-left mr10">Price(INR):</label>
                                       <p>{{ $service->price }} /-</p>
                                   </div>
                                   <div class="box-footer servfooter">
                                      <img style="margin-right:48px;" src=" /images/rating.png" />
                                   </div>
                               </div>
                           </div>
                          @endforeach
                        @else
                        @foreach($offer->consultations as $consultation)
                         <div class="col-lg-6">
                             <div class="box box-default" style="border-top-color: #5a8dff!important;">
                                 <div class="box-header text-center serbg with-border heading">
                                     <label>{{ $consultation->mode }}</label> |
                                     <strong>
                                     @if($offer->discount_type == 'percent')
                                     {{$offer->percent_discount}}% Off
                                     @else
                                     flat INR {{$offer->flat_discount}} /- Off
                                     @endif
                                   </strong>
                                 </div>
                                 <!-- ng-repeat start here -->
                                 <div class="box-body pd10">
                                     <label class="pull-left">Feature/Benifits of the Package</label> |
                                     @if($offer->discount_type == 'percent')
                                     <div class="imageContainer">
                                         <img src=" /images/offer-bench.png" />
                                     <span>{{$offer->percent_discount}}% Off</span></div>
                                     @else
                                     <div class="imageContainer">
                                         <img src=" /images/offer-bench.png" />
                                     <span>{{$offer->flat_discount}} /-Off</span></div>
                                     @endif

                                     @if($offer->discount_type == 'percent')
                                     <p><strong>Discount</strong> : {{$offer->percent_discount}}%,
                                       @if(isset($offer->discount_limit))
                                       <strong>Max</strong> : INR {{$offer->discount_limit}} /-</p>
                                       @endif
                                     @else
                                     <p><strong>Discount</strong> : INR {{$offer->flat_discount}} /-</p>
                                     @endif
                                 </div>
                                 <div class="box-footer servfooter">
                                    <img style="margin-right:48px;" src=" /images/rating.png" />
                                 </div>
                             </div>
                         </div>
                        @endforeach
                        @endif

                       </div>
                   </div>
               </div>
           </div>
       </div>
</section>

<script type="text/javascript">
            $('input').iCheck({
   checkboxClass: 'icheckbox_flat-green',
   radioClass: 'iradio_flat-green'
 });
       </script>

<!-- Add new Comment -->
<script type="text/ng-template" id="EditService.html">

<style>
.header-color{
   background-color: #00a65a!important;
}
.md-datepicker-input-container {
   width: 250px;
   margin-top:10px;
}
.fnt18 {
       font-size: 14px !important;
   }
</style>

</script>


@endsection

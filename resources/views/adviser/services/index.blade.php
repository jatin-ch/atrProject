@extends('layouts.adviser')
@section('title') | Services @endsection
@section('content')

<section class="content-header">
     <h1>
      Services
     </h1>
     <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Services</a></li>
       <li class="active">Listed</li>
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
                          @foreach($services as $service)
                           <div class="col-lg-6">
                               <div class="box box-default" style="border-top-color: #5a8dff!important;">
                                   <div class="box-header text-center serbg with-border heading">
                                       <label>{{ $service->name }}</label>
                                   </div>
                                   <!-- ng-repeat start here -->
                                   <div class="box-body pd10">
                                       <label class="pull-left">Feature/Benifits of the Package</label>
                                       <div class="imageContainer">
                                           <img src=" /images/offer-bench.png" />
                                       <span>25% Off</span></div>
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
                                       {!! Form::open(['route' => ['services.destroy', $service->id], 'method' => 'DELETE', 'id' => $service->id]) !!}
                                       {!! Form::close() !!}
                                       <a onclick="
                                          if(confirm('Are you sure, You Want to delete this?'))
                                              {
                                                event.preventDefault();
                                                document.getElementById({{ $service->id }}).submit();
                                              }
                                              else{
                                                event.preventDefault();
                                              }" class="footercontent" href="">
                                            <img src=" /images/delete-button.png" />
                                       </a>
                                       <a class="footercontent" href="{{route('services.edit', $service->id)}}">
                                           <img src=" /images/edit.png" />
                                       </a>
                                   </div>
                               </div>
                           </div>
                          @endforeach

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
<md-dialog  aria-label='' style="width:50%">
   <form name='userForm' id='chatform' ng-cloak novalidate>
     <md-toolbar class="header-color">
       <div class='md-toolbar-tools'>
         <h2>Update Service Details</h2>
         <span flex></span>
         <md-button class='md-icon-button' ng-click='cancel()'>
                       <i class='fa fa-times closeIcon'></i>
        </md-button>
       </div>
     </md-toolbar>
     <md-dialog-content>
     <section class="content">
       <div class="container-fluid">
           <div class="row">
               <form action="" method="post">
                   <div class="col-lg-offset-2 col-lg-8 mt10">
                       <div class="form-group">
                           <label for="name">NAME OF THE SERVICE *</label>
                           <input type="text" class="form-control br1" placeholder="Type your service name" id="name">
                       </div>
                       <div class="form-group">
                           <label class="mb10 mt10">FEATURE/BENIFITS OF THE PACKAGE *</label>
                           <div class="row mr0 benft">
                               <div class="col-lg-6">
                                   <div class="form-group">
                                       <label class="fnt12" for="feature1">Feature/Benifits 1 *</label>
                                       <input type="text" class="form-control br1" placeholder="Type your feature" id="feature1">
                                   </div>
                                   <div class="form-group">
                                       <label class="fnt12" for="feature2">Feature/Benifits 2 *</label>
                                       <input type="text" class="form-control br1" placeholder="Type your feature" id="feature1">
                                   </div>
                               </div>
                               <div class="col-lg-6">
                                   <div class="form-group">
                                       <label class="fnt12" for="feature3">Feature/Benifits 3 *</label>
                                       <input type="text" class="form-control br1" placeholder="Type your feature" id="feature1">
                                   </div>
                                   <div class="form-group">
                                       <label class="fnt12" for="feature4">Feature/Benifits 4 *</label>
                                       <input type="text" class="form-control br1" placeholder="Type your feature" id="feature1">
                                   </div>
                               </div>
                               <div class="text-center">
                                   <button class="btn btn-success">Add More</button>
                               </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="mb10 mt10">PACKAGE/SERVICE INCLUDES *</label>
                           <div class="row mr0 benft">
                               <div class="col-lg-6">
                                   <div class="form-group">
                                       <label class="fnt12" for="ser1">Package/Service 1 *</label>
                                       <input type="text" class="form-control br1" placeholder="Type your feature" id="ser1">
                                   </div>
                                   <div class="form-group">
                                       <label class="fnt12" for="ser2">Package/Service 2 *</label>
                                       <input type="text" class="form-control br1" placeholder="Type your feature" id="ser2">
                                   </div>
                               </div>
                               <div class="col-lg-6">
                                   <div class="form-group">
                                       <label class="fnt12" for="ser3">Package/Service 3 *</label>
                                       <input type="text" class="form-control br1" placeholder="Type your feature" id="ser3">
                                   </div>
                                   <div class="form-group">
                                       <label class="fnt12" for="ser4">Package/Service 4 *</label>
                                       <input type="text" class="form-control br1" placeholder="Type your feature" id="ser4">
                                   </div>
                               </div>
                               <div class="text-center">
                                   <button class="btn btn-success">Add More</button>
                               </div>
                           </div>
                       </div>
                       <div class="row mr0 mb10 mt10">
                           <div class="col-lg-4 pd0">
                               <label for="duration">SERVICE TIME DURATION *</label>
                               <select class="form-control">
                                   <option value="1">1</option>
                                   <option value="2">2</option>
                                   <option value="3">3</option>
                               </select>
                           </div>
                           <div class="col-lg-4 pd0 pdl10">
                               <label for="duration">VALIDITY *</label>
                               <select class="form-control">
                                   <option value="1">1</option>
                                   <option value="2">2</option>
                                   <option value="3">3</option>
                               </select>
                           </div>
                           <div class="col-lg-4 pd0 pdl10">
                               <label for="duration">FREQUENCY *</label>
                               <select class="form-control">
                                   <option value="1">1</option>
                                   <option value="2">2</option>
                                   <option value="3">3</option>
                               </select>
                           </div>
                       </div>
                       <div class="row mr0 mb10 benft">
                           <div class="col-lg-4">
                               <div class="form-group">
                                   <label class="fnt12" for="price">Price(INR) *</label>
                                   <input type="text" class="form-control br1" placeholder="Type your feature" id="price">
                               </div>
                           </div>
                           <div class="col-lg-4">
                               <div class="form-group">
                                   <label class="commission" for="feature3">Adviceli Commission</label>
                                   <input type="text" class="form-control br1" placeholder="Type your feature" id="commission">
                               </div>
                           </div>
                           <div class="col-lg-4">
                               <div class="form-group">
                                   <label class="fnt12" for="payout">Your Payout</label>
                                   <input type="text" class="form-control br1" placeholder="Type your feature" id="payout">
                               </div>
                           </div>
                       </div>
                       <div class="form-group mt10">
                           <label>ABOUT/SERVICE AND PACKEAGE *</label>
                           <textarea style="min-height:150px" class="form-control"></textarea>
                       </div>
                       <div class="form-group mt10">
                           <label>CHOOSE MODE OF SERVICE *</label>
                           <div>
                               <label class="checkbox-inline"><input type="checkbox" checked value=""> Phone Call</label>
                               <label class="checkbox-inline"><input type="checkbox" value=""> Video Call</label>
                               <label class="checkbox-inline"><input type="checkbox" value=""> Personal Meeting</label>
                           </div>
                       </div>
                       <div class="form-group mt10">
                           <label>Is physically visit mendatory  ?  </label>
                           <label><input type="radio" name="iCheck"> Yes</label>
                           <label><input type="radio" name="iCheck" checked> No </label>
                       </div>
                       <div class="form-group mt10">
                           <label>Choose Cover Image:</label>
                           <label class="inline"><input name="visit" class="form-control" type="file"></label>
                       </div>
                       <div class="text-center col-lg-offset-2">
                           <input type="submit" style="width:150px;" class="btn btn-success" value="Submit" />
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </section>
      </md-dialog-content>
   </form>
 </md-dialog>
</script>






@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {

    $("#field1").keyup(function(){
          $("#field3").val($("#field1").val() - $("#field2").val());
    });
    $("#field2").keyup(function(){
          $("#field3").val($("#field1").val() - $("#field2").val());
    });


});
</script

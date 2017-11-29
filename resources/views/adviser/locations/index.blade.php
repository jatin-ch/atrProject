@extends('layouts.adviser')
@section('title') | Locations @endsection
@section('content')



<style type="text/css">
    .mt70{
        margin-top: 70px;
    }
    .brdrdashed{
        border: 1px dashed;
    }
</style>
<section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">Address</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;margin-bottom: 0px;">
<section class="content">
            <div class="row basicdetail">
                <div class="col-lg-offset-1 col-lg-4 mt20 ">
                    <div class="adrheight brdrdashed form-control text-center address">
                        <button class="btn btn-default mt70" data-target="#addpop1" data-toggle="modal">Add Address</button>
                    </div>

                                           <!-- Add Address Modal -->

      <div class="modal fade" id="addpop1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Location</h4>
                </div>

                <div class="modal-body">
                   {!! Form::open(['route' => ['adviser.locations.store'], 'method' => 'POST']) !!}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="address">Address</label>
                                     {{ Form::text('address', null, ['class' => 'form-control','placeholder'=>'Address']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="locality">Locality</label>
                                   {{ Form::text('locality', null, ['class' => 'form-control','placeholder'=>'Locality']) }}
                                </div>
                            </div>

                             <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Country</label>
                                    {{ Form::text('country', null, ['class' => 'form-control','placeholder'=>'Country']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="state">State</label>
                                      {{ Form::text('state', null, ['class' => 'form-control','placeholder'=>'State']) }}
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="city" >City</label>
                                   {{ Form::text('city', null, ['class' => 'form-control','placeholder'=>'City']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="pin">Pin</label>
                                     {{ Form::number('pin', null, ['class' => 'form-control','placeholder'=>'Pincode']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Mobile</label>
                                     {{ Form::number('mobile', Auth::user()->mobile, ['class' => 'form-control','placeholder'=>'Mobile']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                               <div class="form-group">
                                    <label >Address Type</label><br />
                                   <label> <input type="radio" class="flat" name="address_type"  value="home"> Home / Personal</label>
                    <label><input type="radio" class="flat" name="address_type"  value="office" checked> Office / Commercial</label>
                                </div>
                            </div>
                              <div class="col-lg-12">
                                <div class="text-center">
                                   {{ Form::submit('Save & Next', ['class' => 'btn btn-success btnsuccess']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

               <!-- Add Address -->
                </div>

                @foreach(Auth::user()->locations as $location)

                <div class="col-lg-offset-1 col-lg-4 mt20">
                    <div class="box box-default adrheight">
                        <div class="box-header with-border heading">
                            <label class="pull-left fontcolor">Address</label>
                        </div>
                        <div class="box-body">
                          <p>{{ $location->address }} , {{ $location->locality }} , {{ $location->city }} , {{ $location->state }} , {{ $location->country }} , {{ $location->pin }}</p>
                            <label class="fontcolor">Mobile : {{ $location->mobile }} </label></br>
                            <label class=" fontcolor">Pin :{{ $location->pin }}</label></br>
                            <label class="fontcolor">City: {{ $location->city }}</label></br>

                            <div class="">
                              <a href="" data-target="#sl1{{$location->id}}" data-toggle="modal">Edit</a>
                              {!! Form::open(['class'=>'pull-left' ,'route' => ['adviser.locations.destroy', $location->id], 'method' => 'DELETE', 'id' => $location->id]) !!}
                               {!! Form::close() !!}
                               | <a onclick="
                                  if(confirm('Are you sure want to delete this address?'))
                                      {
                                        event.preventDefault();
                                        document.getElementById({{ $location->id }}).submit();
                                      }
                                      else{
                                        event.preventDefault();
                                      }" href="">
                                  Delete
                               </a>

          <!-- Edit Address Modal -->

      <div class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static" id="sl1{{$location->id}}">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Location</h4>
                </div>

                <div class="modal-body">
                  {!! Form::model($location, ['route' => ['adviser.locations.update', $location->id], 'method' => 'PUT', 'id' => 'sf1'.$location->id]) !!}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="address">Address</label>
                                     {{ Form::text('address', null, ['class' => 'form-control','placeholder'=>'Address']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="locality">Locality</label>
                                   {{ Form::text('locality', null, ['class' => 'form-control','placeholder'=>'Locality']) }}
                                </div>
                            </div>

                             <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Country</label>
                                    {{ Form::text('country', null, ['class' => 'form-control','placeholder'=>'Country']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="state">State</label>
                                      {{ Form::text('state', null, ['class' => 'form-control','placeholder'=>'State']) }}
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="city" >City</label>
                                   {{ Form::text('city', null, ['class' => 'form-control','placeholder'=>'City']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="pin">Pin</label>
                                     {{ Form::number('pin', null, ['class' => 'form-control','placeholder'=>'Pincode']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Mobile</label>
                                     {{ Form::number('mobile', null, ['class' => 'form-control','placeholder'=>'Mobile']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                               <div class="form-group">
                                    <label >Address Type</label><br />
                                   <label> <input type="radio" class="flat" name="address_type"  value="home" {{ $location->address_type == 'home' ? "checked" : "" }}> Home / Personal</label>
                    <label><input type="radio" class="flat" name="address_type"  value="office" {{ $location->address_type == 'office' ? "checked" : "" }}> Office / Commercial</label>
                                </div>
                            </div>
                              <div class="col-lg-12">
                                <div class="text-center">
                                    <button class="btn btn-success" onclick="document.getElementById(sf1{{ $location->id }}).submit();">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

               <!-- Edit Address -->
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="col-lg-12 text-center mt20 mb10">
                 <button type="button" class="btn btn-success btnsuccess">Save & Next</button>
                </div>
            </div>
</section>


@endsection

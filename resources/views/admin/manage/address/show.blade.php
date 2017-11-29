@extends('layouts.admin')
@section('content')
<section class="content-header">
      <h1>
         Locations({{$user->name}})
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Locations</a></li>
        <li class="active">Adviser</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                 <label> Manage Locations :-</label> <strong>{{$user->name}}</strong>
                  <button class="btn btn-success btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Add New</button>
                <div class="modal fade" id="addpop1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Locations</h4>Add New Locations
                </div>
                 <div class="modal-body">
                  {!! Form::open(['route' => ['address.store'], 'method' => 'POST', 'id' => 'addnew']) !!}
                  {{ Form::hidden('user_id', $user->id) }}
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        {{ Form::label('address', 'Address') }}
                    {{ Form::text('address', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                       {{ Form::label('locality', 'Locality') }}
                    {{ Form::text('locality', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                       {{ Form::label('country', 'Country') }}
                    {{ Form::text('country', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        {{ Form::label('state', 'State') }}
                    {{ Form::text('state', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        {{ Form::label('city', 'City') }}
                    {{ Form::text('city', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         {{ Form::label('pin', 'Pincode Number') }}
                    {{ Form::text('pin', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        {{ Form::label('mobile', 'Mobile Number') }}
                    {{ Form::text('mobile', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        {{ Form::label('address_type', 'Address Type') }}<br>
                   <label><input type="radio" class="flat" name="address_type"  value="home"> Home / Personal</label> 
                   <label> <input type="radio" class="flat" name="address_type"  value="office" checked> Office / Commercial</label> 
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                    <div class="form-group">
                 <button class="btn btn-success " onclick="document.getElementById(addnew).submit();">Save</button>
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
                  <div class="table-responsive">
                  <table class="table">
                              <thead>
                                <tr>
                                  <th>id</th>
                                  <th>Address</th>
                                  <th>City</th>
                                  <th>Pin</th>
                                  <th>Address Type</th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                </tr>
                              </thead>

                              <tbody>
                                @foreach ($user->locations as $location)
                                  <tr>
                                    <th>{{$location->id}}</th>
                                    <td>{{ $location->address }}</td>
                                    <td>{{ $location->city }}</td>
                                    <td>{{ $location->pin }}</td>
                                    <td>{{ $location->address_type }}</td>
                                    <td>
                                     <button class="btn btn-success btn-sm" data-target="#sl2{{$location->id}}" data-toggle="modal">View</button>
                                    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl2{{$location->id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <button class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Address Type : <strong>{{ $location->address_type }}</strong></h4>
                                    </div>
                                    <div class="modal-body">
                                       <p><strong>Address</strong> : {{ $location->address }}, {{ $location->locality }}</p>
                                       <p><strong>City</strong> : {{ $location->city }}, {{ $location->state }} ( {{ $location->country }} )</p>
                                       <p><strong>Pincode</strong> : {{ $location->pin }}</p>
                                       <p><strong>Mobile</strong> : {{ $location->mobile }}</p>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                     <button class="btn btn-warning btn-sm" data-target="#sl1{{$location->id}}" data-toggle="modal">Edit</button>
                                    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl1{{$location->id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <button class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Location</h4>
                                    </div>
                                    <div class="modal-body">
                                     {!! Form::model($location, ['route' => ['address.update', $location->id], 'method' => 'PUT', 'id' => 'sf1'.$location->id]) !!}
                                     {{ Form::hidden('user_id', $user->id) }}

                                     <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                       {{ Form::label('address', 'Address') }}
                         {{ Form::text('address', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                       {{ Form::label('locality', 'Locality') }}
                        {{ Form::text('locality', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                       {{ Form::label('country', 'Country') }}
                    {{ Form::text('country', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        {{ Form::label('state', 'State') }}
                    {{ Form::text('state', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        {{ Form::label('city', 'City') }}
                    {{ Form::text('city', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         {{ Form::label('pin', 'Pincode Number') }}
                    {{ Form::text('pin', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        {{ Form::label('mobile', 'Mobile Number') }}
                    {{ Form::text('mobile', null, ['class' => 'form-control']) }}
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        {{ Form::label('address_type', 'Address Type') }}<br>
                   <label><input type="radio" class="flat" name="address_type"  value="home" {{ $location->address_type == 'home' ? "checked" : "" }}> Home / Personal</label> 
                   <label> <input type="radio" class="flat" name="address_type"  value="office" {{ $location->address_type == 'office' ? "checked" : "" }}> Office / Commercial</label> 
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                    <div class="form-group">
                 <button class="btn btn-success btn-sm" onclick="document.getElementById(sf1{{ $location->id }}).submit();">Submit</button>
                  </div>
                  </div>
                  </div>

                                    {!! Form::close() !!}
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                       {!! Form::open(['route' => ['address.destroy', $location->id], 'method' => 'DELETE', 'id' => 'dl'.$location->id]) !!}
                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'style' => 'cursor:pointer']) }}
                                       {!! Form::close() !!}
                                     </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection

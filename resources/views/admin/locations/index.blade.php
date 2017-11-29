@extends('layouts.app')
@section('content')

<!-- <div class="container">
    <div class="row"> -->
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Manage Locations
                  <button class="btn btn-primary btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Add New</button>
                 <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
                 <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                 <div class="modal-header">
                 <button class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Add New Location</h4>
                 </div>
                 <div class="modal-body">
                  {!! Form::open(['route' => ['locations.store'], 'method' => 'POST', 'id' => 'addnew']) !!}
                  <div class="form-group">
                    {{ Form::label('address', 'Address') }}
                    {{ Form::text('address', null, ['class' => 'form-control']) }}

                    {{ Form::label('locality', 'Locality') }}
                    {{ Form::text('locality', null, ['class' => 'form-control']) }}

                    {{ Form::label('country', 'Country') }}
                    {{ Form::text('country', null, ['class' => 'form-control']) }}

                    {{ Form::label('state', 'State') }}
                    {{ Form::text('state', null, ['class' => 'form-control']) }}

                    {{ Form::label('city', 'City') }}
                    {{ Form::text('city', null, ['class' => 'form-control']) }}

                    {{ Form::label('pin', 'Pincode Number') }}
                    {{ Form::text('pin', null, ['class' => 'form-control']) }}

                    {{ Form::label('mobile', 'Mobile Number') }}
                    {{ Form::text('mobile', null, ['class' => 'form-control']) }}

                    {{ Form::label('address_type', 'Address Type') }}
                    <input type="radio" class="flat" name="address_type"  value="home"> Home / Personal
                    <input type="radio" class="flat" name="address_type"  value="office" checked> Office / Commercial

                  </div>
                 <div class="form-group">
                 <button class="btn btn-primary btn-sm" onclick="document.getElementById(addnew).submit();">Submit</button>
                  </div>
                 {!! Form::close() !!}
                 </div>
                 </div>
                 </div>
                 </div>
                </div>

                <div class="panel-body">
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
                                @foreach (Auth::user()->locations as $location)
                                  <tr>
                                    <th>{{$location->id}}</th>
                                    <td>{{ $location->address }}</td>
                                    <td>{{ $location->city }}</td>
                                    <td>{{ $location->pin }}</td>
                                    <td>{{ $location->address_type }}</td>
                                    <td>
                                     <button class="btn btn-default btn-sm" data-target="#sl2{{$location->id}}" data-toggle="modal">View</button>
                                    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl2{{$location->id}}" tabindex="-1">
                                    <div class="modal-dialog modal-sm">
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
                                     <button class="btn btn-default btn-sm" data-target="#sl1{{$location->id}}" data-toggle="modal">Edit</button>
                                    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl1{{$location->id}}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <button class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Location</h4>
                                    </div>
                                    <div class="modal-body">
                                     {!! Form::model($location, ['route' => ['locations.update', $location->id], 'method' => 'PUT', 'id' => 'sf1'.$location->id]) !!}
                                     <div class="form-group">
                                       {{ Form::label('address', 'Address') }}
                                       {{ Form::text('address', null, ['class' => 'form-control']) }}

                                       {{ Form::label('locality', 'Locality') }}
                                       {{ Form::text('locality', null, ['class' => 'form-control']) }}

                                       {{ Form::label('country', 'Country') }}
                                       {{ Form::text('country', null, ['class' => 'form-control']) }}

                                       {{ Form::label('state', 'State') }}
                                       {{ Form::text('state', null, ['class' => 'form-control']) }}

                                       {{ Form::label('city', 'City') }}
                                       {{ Form::text('city', null, ['class' => 'form-control']) }}

                                       {{ Form::label('pin', 'Pincode Number') }}
                                       {{ Form::text('pin', null, ['class' => 'form-control']) }}

                                       {{ Form::label('mobile', 'Mobile Number') }}
                                       {{ Form::text('mobile', null, ['class' => 'form-control']) }}

                                       {{ Form::label('address_type', 'Address Type') }}
                                       <input type="radio" class="flat" name="address_type"  value="home" {{ $location->address_type == 'home' ? "checked" : "" }}> Home / Personal
                                       <input type="radio" class="flat" name="address_type"  value="office" {{ $location->address_type == 'office' ? "checked" : "" }}> Office / Commercial

                                     </div>
                                    <div class="form-group">
                                    <button class="btn btn-primary btn-sm" onclick="document.getElementById(sf1{{ $location->id }}).submit();">Submit</button>
                                     </div>
                                    {!! Form::close() !!}
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                       {!! Form::open(['route' => ['locations.destroy', $location->id], 'method' => 'DELETE', 'id' => 'dl'.$location->id]) !!}
                                        {{ Form::submit('Delete', ['class' => 'btn btn-default btn-sm', 'style' => 'color:#a00;cursor:pointer']) }}
                                       {!! Form::close() !!}
                                     </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                </div>
            </div>
        </div>
    <!-- </div>
</div> -->

@endsection

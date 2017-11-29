@extends('layouts.app')
@section('content')

<!-- <div class="container">
    <div class="row"> -->
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">  Manage Your Organization</div>
                <div class="panel-body">

                  @if(Auth::user()->org)


                  <h4>{{Auth::user()->org->name}}</h4>
                  <img src="{{asset('images/' .Auth::user()->org->logo)}}" class="img-circle" style="width:50px">


                  @else
                  {!! Form::open(['route' => ['myOrg.store'], 'method' => 'POST', 'files' => 'true', 'id' => 'addnew']) !!}
                  <div class="form-group">
                    {{ Form::label('name', 'Organization Name') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    {{ Form::label('logo', 'Logo', ['style' => 'margin-top:20px']) }}
                    {{ Form::file('logo', null, ['class' => 'form-control']) }}
                    </div>
                 <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(addnew).submit();">Submit</button>
                 <br>
                 {!! Form::close() !!}


                  @endif

                </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                Add an Adviser to Your Org
              </div>
              <div class="panel-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Full Name</th>
                      <th></th>
                      <th></th>
                      <th><th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($advisers as $adviser)
                      <tr>
                        <th>{{$adviser->id}}
                          @foreach($adviser->organizations as $org)
                          {{$org->name}}
                          @endforeach
                        </th>
                        <td>
                          @if(!empty($adviser->basicDetail->image))
                          <img src="{{ asset('images/' .$adviser->basicDetail->image) }}" style="width:30px">
                          @else
                          <img src="{{ asset('images/user.png') }}" style="width:30px">
                          @endif
                        {{$adviser->name}}
                        </td>
                        <td>{{$adviser->email}}</td>
                        <td>
                          @if($adviser->basicDetail)
                          {{ $adviser->basicDetail->firstname }} {{ $adviser->basicDetail->lastname }}
                          @endif
                        </td>
                        <td>
                          {!! Form::open(['route' => ['myOrg.add'], 'method' => 'POST']) !!}
                          {{ Form::hidden('users', $adviser->id) }}
                          {{ Form::submit('Send Request', ['class' => 'btn btn-info btn-xs']) }}
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

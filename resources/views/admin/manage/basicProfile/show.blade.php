@extends('layouts.admin')
@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
          Manage Basic Profile for <strong>{{$user->name}}</strong>
          <button class="btn btn-primary btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Edit</button>
          <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
          <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <div class="modal-header">
          <button class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit</h4>
          </div>
          <div class="modal-body">
          {!! Form::model($user->basicDetail, ['route' => ['basicProfile.update', $user->id], 'method' => 'PUT', 'files' => true, 'id' => 'addnew']) !!}
          <div class="form-group">
            <table class="table">
              <tbody>
                <tr>
                <td style="border:none">
                  {{ Form::label('firstname', 'First name') }}
                  {{ Form::text('firstname', null, ['class' => 'form-control']) }}
                </td>
                <td style="border:none">
                  {{ Form::label('lastname', 'Last Name') }}
                  {{ Form::text('lastname', null, ['class' => 'form-control']) }}
                </td>
              </tr>
              <tr>
              <td style="border:none">
                {{ Form::label('gender', 'Gender') }}
                <input type="radio" name="gender"  value="M" {{ $user->basicDetail->gender == 'M' ? 'checked' : '' }}> Male
                <input type="radio" name="gender"  value="F" {{ $user->basicDetail->gender == 'F' ? 'checked' : '' }}> Female
              </td>
              <td style="border:none">
                {{ Form::label('dob', 'Date Of Birth') }}
                {{ Form::date('dob', null, ['class' => 'form-control']) }}
              </td>
            </tr>
              <tr>
              <td style="border:none">
                {{ Form::label('landline', 'Landline') }}
                {{ Form::text('landline', $user->basicdetail->adviserBasic->landline, ['class' => 'form-control']) }}
              </td>
              <td style="border:none">
                {{ Form::label('language', 'Language') }}
                {{ Form::text('language', $user->basicdetail->adviserBasic->language, ['class' => 'form-control']) }}
              </td>
            </tr>
              </tbody>
            </table>

            {{ Form::label('website', 'Website') }}
            {{ Form::text('website', $user->basicdetail->adviserBasic->website, ['class' => 'form-control']) }}

            {{ Form::label('facebook', 'Facebook') }}
            {{ Form::text('facebook', $user->basicdetail->adviserBasic->facebook, ['class' => 'form-control']) }}

            {{ Form::label('linkedin', 'LinkedIn') }}
            {{ Form::text('linkedin', $user->basicdetail->adviserBasic->linkedin, ['class' => 'form-control']) }}

          </div>
          <div class="form-group">
          <button class="btn btn-success" onclick="document.getElementById(addnew).submit();">Submit</button>
          </div>
          {!! Form::close() !!}
          </div>
          </div>
          </div>
          </div>
        </div>

        <div class="panel-body">
          <div class="row">
            <div class="col-md-2">
              <img src="{{ asset('images/' .$user->basicDetail->image) }}" style="width:150px">
            </div>
            <div class="col-md-2">
              <small>Adviser Name</small>
              <p><strong>{{ $user->basicDetail->firstname }} {{ $user->basicDetail->lastname }}</strong></p>
              <small>Email Id</small>
              <p><strong>{{ $user->basicDetail->email }}</strong></p>
              <p><strong><a href="{{ $user->basicDetail->adviserbasic->website }}">website</a></strong></p>
            </div>
            <div class="col-md-2">
              <small>Date of Birth</small>
              <p><strong>{{ date('j M Y', strtotime($user->basicDetail->dob)) }}</strong></p>
              <small>Language</small>
              <p><strong>{{ $user->basicDetail->adviserbasic->language }}</strong></p>  <small></small>
              <p><strong><a href="{{ $user->basicDetail->adviserbasic->facebook }}">facebook</a></strong></p>
            </div>
            <div class="col-md-2">
              <small>Mobile</small>
              <p><strong>{{ $user->basicDetail->mobile }}</strong></p>
              <small>Landline</small>
              <p><strong>{{ $user->basicDetail->adviserbasic->landline }}</strong></p>
              <p><strong><a href="{{ $user->basicDetail->adviserbasic->linkedin }}">linkedin</a></strong></p>

            </div>
            <div class="col-md-2">

            </div>
          </div>
        </div>
    </div>
</div>


@endsection

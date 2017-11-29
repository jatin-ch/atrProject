@extends('layouts.admin')
@section('content')

<section class="content-header">
      <h1>
        Consultation
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Consultation Mode</a></li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
         <label> Manage All Consultation Modes</label>
          <button class="btn btn-success btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Add New</button>
         <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
         <div class="modal-dialog">
         <div class="modal-content">
         <div class="modal-header">
         <button class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Add New Consultation Mode</h4>
         </div>
         <div class="modal-body">
          {!! Form::open(['route' => ['consultations.store'], 'method' => 'POST', 'id' => 'addnew']) !!}
          <div class="form-group">
            {{ Form::label('mode', 'Consultation Mode') }}
            {{ Form::text('mode', null, ['class' => 'form-control']) }}
            {{ Form::label('slug', 'Slug', ['style' => 'margin-top:20px']) }}
            {{ Form::text('slug', null, ['class' => 'form-control']) }}
          </div>
            <br>
         <button class="btn btn-success" onclick="document.getElementById(addnew).submit();">Submit</button>
         <br>
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
                          <th>Id</th>
                          <th>Consultation Mode</th>
                          <th>Slug</th>
                          <th>Created At</th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach ($consultations as $consultation)
                          <tr>
                            <th>{{ $consultation->id }}</th>
                            <td>{{ $consultation->mode }}</td>
                            <td>{{ $consultation->slug }}</td>
                            <td>{{ date('j M Y', strtotime($consultation->created_at)) }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
        </div>
    </div>
</div>
</div>
</div>
</section>

@endsection

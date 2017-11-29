@extends('layouts.admin')
@section('title') | Qualifications @endsection
@section('content')
<section class="content-header">
      <h1>
        Qualifications
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Qualifications</a></li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <label>  Manage All Qualifications</label>
                  <button class="btn btn-success btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Add New</button>
                 <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
                 <div class="modal-dialog">
                 <div class="modal-content">
                 <div class="modal-header">
                 <button class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Add New Qualification</h4>
                 </div>
                 <div class="modal-body">
                  {!! Form::open(['route' => ['qualifications.store'], 'method' => 'POST', 'id' => 'addnew']) !!}
                  <div class="row">
                    <div class="col-md-12">
                       <div class="form-group">

                            {{ Form::label('category_id', 'Select Category') }}
                            <select name="category_id" class="form-control">
                              @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                              @endforeach
                            </select>
                          </div>
                           <div class="form-group">
                            {{ Form::label('name', 'Qualification') }}
                            {{ Form::text('name', null, ['class' => 'form-control']) }}

                    </div>
                    <div class="form-group text-center">
                       <button class="btn btn-success btn-sm pull-right" onclick="document.getElementById(addnew).submit();">Save</button>
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
                  <table class="table">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Qualification</th>
                                  <th>Category Associated</th>
                                  <th></th>
                                  <th></th>
                                </tr>
                              </thead>

                              <tbody>
                                @foreach ($qualifications as $qualification)
                                  <tr>
                                    <th>{{ $qualification->id }}</th>
                                    <td>{{ $qualification->name }}</td>
                                    <td>{{ $qualification->category->name }}</td>
                                    <td>
                                     <button class="btn btn-warning btn-sm" data-target="#sl1{{$qualification->id}}" data-toggle="modal">Edit</button>
                                    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl1{{$qualification->id}}" tabindex="-1">
                                    <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <button class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Qualification</h4>
                                    </div>
                                    <div class="modal-body">
                                     {!! Form::model($qualification, ['route' => ['qualifications.update', $qualification->id], 'method' => 'PUT', 'id' => 'sf1'.$qualification->id]) !!}
                                     <div class="form-group">
                                       <table class="table">
                                         <tbody>
                                           <tr>
                                             <td style="border:none">
                                               {{ Form::label('category_id', 'Select Category') }}
                                               <select name="category_id" class="form-control">
                                                 @foreach($categories as $category)
                                                 <option value="{{ $category->id }}" {{$qualification->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                                 @endforeach
                                               </select>
                                             </td>
                                           </tr>
                                           <tr>
                                             <td style="border:none">
                                               {{ Form::label('name', 'Qualification') }}
                                               {{ Form::text('name', null, ['class' => 'form-control']) }}
                                             </td>
                                           </tr>
                                         </tbody>
                                       </table>
                                       <button class="btn btn-success btn-sm pull-right" onclick="document.getElementById(sf1{{ $qualification->id }}).submit();">Save</button>
                                       <br>
                                       </div>
                                    {!! Form::close() !!}
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                       {!! Form::open(['route' => ['qualifications.destroy', $qualification->id], 'method' => 'DELETE', 'id' => 'dl'.$qualification->id]) !!}
                                       {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'style' => 'cursor:pointer']) }}
                                       {!! Form::close() !!}
                                     </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>

                            <div class="text-center">
                            {!! $qualifications->links() !!}
                            <p>{{ $qualifications->count() }} items</p>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection

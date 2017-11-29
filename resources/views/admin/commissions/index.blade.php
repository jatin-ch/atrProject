@extends('layouts.admin')
@section('title') | Commissions @endsection
@section('content')
<section class="content-header">
      <h1>
        Adviceli Commission
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">All</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label></label>
          <a href="{{route('commissions.create')}}" class="btn btn-default btn-sm pull-right">Add New</a>
        </div>

        <div class="panel-body">
          <table class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Commission</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach ($commissions as $commission)
                          <tr>
                            <th>{{ $commission->id }}</th>
                            <td>{{ $commission->user->name }}</td>
                            <td>{{ $commission->user->email }}</td>
                            <td>INR {{ $commission->price }} /-</td>
                            <td>
                             <button class="btn btn-default btn-sm" data-target="#sl1{{$commission->id}}" data-toggle="modal">Edit</button>
                            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl1{{$commission->id}}" tabindex="-1">
                            <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                            <div class="modal-header">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Commission</h4>
                            </div>
                            <div class="modal-body">
                             {!! Form::model($commission, ['route' => ['commissions.update', $commission->id], 'method' => 'PUT', 'id' => 'sf1'.$commission->id]) !!}
                             <div class="form-group form-inline">
                             {{ Form::text('price', null, ['class' => 'form-control', 'required'=>'']) }}
                             <button class="btn btn-success" onclick="document.getElementById(sf1{{ $commission->id }}).submit();">Save</button>
                              </div>
                            {!! Form::close() !!}
                            </div>
                            </div>
                            </div>
                            </div>
                            </td>
                            <td>
                               {!! Form::open(['route' => ['commissions.destroy', $commission->id], 'method' => 'DELETE', 'id' => $commission->id]) !!}
                               {!! Form::close() !!}
                               <a onclick="
                                  if(confirm('Are you sure, You Want to delete this?'))
                                      {
                                        event.preventDefault();
                                        document.getElementById({{ $commission->id }}).submit();
                                      }
                                      else{
                                        event.preventDefault();
                                      }" href="" class="btn btn-default btn-sm" style='cursor:pointer'>
                                    Delete
                               </a>
                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    <div class="text-center">
                    {!! $commissions->links() !!}
                    <p>{{ $commissions->count() }} items</p>
                    </div>
        </div>
    </div>
</div>
</div>
</div>
</section>

@endsection

@extends('layouts.admin')
@section('title') | Service | {{$service->name}} @endsection
@section('content')

<script>
 $('input').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
</script>
<section class="content-header">
      <h1>
      View service
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Services</a></li>
        <li class="active">{{ $service->name }}</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">

<section class="content">
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        {{ $service->name }}
      </div>
      <div class="panel-body">
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
    </div>
  </div>


  <div class="panel panel-default">
    <div class="panel-heading">
      BENIFITS OF SERVICE
      <button class="btn btn-success btn-sm pull-right" data-target="#afsp{{$service->id}}" data-toggle="modal">Add Benifit</button>
     <div class="modal fade" data-keyboard="false" data-backdrop="static" id="afsp{{$service->id}}" tabindex="-1">
     <div class="modal-dialog modal-md">
     <div class="modal-content">
     <div class="modal-body">
       {!! Form::open(['route' => ['benifit.store'], 'method' => 'POST']) !!}
        {{ Form::hidden('service_id', $service->id) }}
        <input type="text" name="benifit" class="form-control" placeholder="benifit">
        <div style="margin-top:20px">
        {{ Form::submit('Add New', ['class' => 'btn btn-primary btn-sm']) }}
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">cancel</button>
      </div>
       {!! Form::close() !!}
     </div>
     </div>
     </div>
     </div>
    </div>
    <div class="panel-body">
     <table class="table">
       <tbody>
         @foreach($service->benifits as $benifit)
         <tr>
           <td style="border:none">{{  $benifit->benifit }}</td>
           <td style="border:none">
             <button class="btn btn-default btn-sm" data-target="#tri{{$benifit->id}}" data-toggle="modal"><i class="fa fa-edit"></i></button>
            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="tri{{$benifit->id}}" tabindex="-1">
            <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-body">
              {!! Form::model($benifit, ['route' => ['benifit.update', $benifit->id], 'method' => 'PUT']) !!}
                {{ Form::text('benifit', null, ['class' => 'form-control', 'placeholder' => 'benifit']) }}
                <div style="margin-top:20px">
                {{ Form::submit('save', ['class' => 'btn btn-primary btn-sm']) }}
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">cancel</button>
                </div>
              {!! Form::close() !!}
            </div>
            </div>
            </div>
            </div>
           </td>
           <td style="border:none">
             {{ Form::open(['route' => ['benifit.destroy', $benifit->id], 'method' => 'DELETE', 'id' => $benifit->id]) }}
             {{ Form::close() }}
             <a onclick="
                if(confirm('Are you sure, You Want to delete this?'))
                    {
                      event.preventDefault();
                      document.getElementById({{ $benifit->id }}).submit();
                    }
                    else{
                      event.preventDefault();
                    }" class="btn btn-default btn-sm">
                <i class="fa fa-trash" style="cursor:pointer;color:#a94442"></i>
             </a>
           </td>
         </tr>
         @endforeach
       </tbody>
     </table>
    </div>
  </div>



  <div class="panel panel-default">
    <div class="panel-heading">
      PACKAGES OF SERVICE
      <button class="btn btn-success btn-sm pull-right" data-target="#kks{{$service->id}}" data-toggle="modal">Add Package</button>
     <div class="modal fade" data-keyboard="false" data-backdrop="static" id="kks{{$service->id}}" tabindex="-1">
     <div class="modal-dialog modal-md">
     <div class="modal-content">
     <div class="modal-body">
       {!! Form::open(['route' => ['package.store'], 'method' => 'POST']) !!}
        {{ Form::hidden('service_id', $service->id) }}
        <input type="text" name="include" class="form-control" placeholder="package Included">
        <div style="margin-top:20px">
        {{ Form::submit('Add New', ['class' => 'btn btn-primary btn-sm']) }}
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">cancel</button>
      </div>
       {!! Form::close() !!}
     </div>
     </div>
     </div>
     </div>
    </div>
    <div class="panel-body">
     <table class="table">
       <tbody>
         @foreach($service->packages  as $package)
         <tr>
           <td style="border:none">{{  $package->include }}</td>
           <td style="border:none">
             <button class="btn btn-default btn-sm" data-target="#tk{{$package->id}}" data-toggle="modal"><i class="fa fa-edit"></i></button>
            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="tk{{$package->id}}" tabindex="-1">
            <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-body">
              {!! Form::model($package, ['route' => ['package.update', $package->id], 'method' => 'PUT']) !!}
                {{ Form::text('include', null, ['class' => 'form-control', 'placeholder' => 'package included']) }}
                <div style="margin-top:20px">
                {{ Form::submit('save', ['class' => 'btn btn-primary btn-sm']) }}
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">cancel</button>
                </div>
              {!! Form::close() !!}
            </div>
            </div>
            </div>
            </div>
           </td>
           <td style="border:none">
             {{ Form::open(['route' => ['package.destroy', $package->id], 'method' => 'DELETE', 'id' => $package->id]) }}
             {{ Form::close() }}
             <a onclick="
                if(confirm('Are you sure, You Want to delete this?'))
                    {
                      event.preventDefault();
                      document.getElementById({{ $package->id }}).submit();
                    }
                    else{
                      event.preventDefault();
                    }" class="btn btn-default btn-sm">
                <i class="fa fa-trash" style="cursor:pointer;color:#a94442"></i>
             </a>
           </td>
         </tr>
         @endforeach
       </tbody>
     </table>
    </div>
  </div>


</section>




@endsection

@extends('layouts.admin')
@section('title') | Manage Advisers @endsection
@section('content')

<style type="text/css">
  .users{
        background: #f9fafc;
    padding: 10px;
    border: 1px solid #c5cde0;
    margin: 10px;
  }
</style>
<section class="content-header">
      <h1>
        Manage Advisers
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage</a></li>
        <li class="active">Adviser</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
          <form action="{{ route('search') }}" method="POST" role="search">
          {{ csrf_field() }}
          <div class="input-group pull-right" style="width:30%; margin-top:-4px">
            <input type="text" name="q" class="form-control" placeholder="Search username or email" required><span class="input-group-btn">
              <button type="submit" class="btn btn-default">
                Go!
              </button>
            </span>
          </div>
        </form>
          <label>Manage Advisers</label>
        </div>

        <div class="panel-body">
          @if(isset($details))
    			<p> The Search results for your query <b> {{ $query }} </b> are :</p>
          @if($details){!! $details->render() !!}@endif
    			@elseif(isset($message))
    			<p>{{ $message }}</p>
    			@endif

<hr>

          @foreach ($users as $user)
          <div class="row users">
            <div class="col-md-12">
              <div class="row">
              <div class="col-md-1">
              <!-- <strong>{{$user->id}}</strong> -->
              @if(!empty($user->basicDetail->image))
              <img src="{{ asset('images/' .$user->basicDetail->image) }}" style="width:40px">
              @else
              <img src="{{ asset('images/user.png') }}" style="width:40px">
              @endif
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Name:</label>
               <a href="{{ route('basicProfile.show', $user->id) }}"> <p>{{$user->name}}</p></a>
              </div>
            </div>
            <div class="col-md-9">
              <div class="form-group">
                <label>Email:</label>
                <p>{{$user->email}}</p>
              </div>
            </div>
            </div>
            <div class="row">
              <div class="col-md-2">
              <div class="form-group">
                <a href="#" class="btn btn-default">Blog Posts</a>
              </div>
            </div>
             <div class="col-md-2">
              <div class="form-group">
               <a href="{{ route('expertProfile.show', $user->id) }}" class="btn btn-default">Expert Details</a>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
               <a href="{{ route('address.show', $user->id) }}" class="btn btn-default "> Locations</a>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <a href="{{ route('bank-detail.show', $user->id) }}" class="btn btn-default ">Bank Details</a>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
               <a href="{{ route('availability.show', $user->id) }}" class="btn btn-default ">Availabilities</a>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
               <a href="{{ route('un-availability.show', $user->id) }}" class="btn btn-default ">Un-availability</a>
              </div>
            </div>
            </div>
            </div>
          </div>
          <hr>
          @endforeach
        <center>{{$users->links()}}</center>
        </div>
    </div>
</div>
</div>
</div>
</section>

@endsection

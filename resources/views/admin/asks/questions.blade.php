@extends('layouts.admin')
@section('title') | Ask-us @endsection
@section('content')



<style type="text/css">
    .mt70{
        margin-top: 70px;
    }
    .brdrdashed{
        border: 1px dashed;
    }
</style>
<section class="content">
  <div class="container-fluid">


    <div class="row">
      <div class="col-lg-12">
        <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Ask Us</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Questions</a></li>
      <li><a href="#">Notifications</a></li>
    </ul>
    <form class="navbar-form navbar-left"  action="{{ route('admin.questions.search') }}" method="POST" role="search">
     {{ csrf_field() }}
  <div class="input-group">
    <input type="text" name="q" class="form-control" placeholder="Search" required>
    <div class="input-group-btn">
      <button class="btn btn-default" style="height: 34px;" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
</form>
    <button class="btn btn-danger pull-right navbar-btn">Ask Quetion</button>
  </div>
</nav>
      </div>
    </div>



    <div class="row">
      <div class="col-lg-12">
        <div class="basicdetail" style="border: 0;padding: 20px">
          <img src="images/user.png" style="width:3%;border-radius: 30px;margin-right: 10px" alt="user"><label>Shahid Saifi</label><br>
          <label style="font-size: 18px;color: #999;"><a href="#"> What is your questions?</a></label>
        </div>
      </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            @if(isset($query))
    		<p> The Search results for your query <b> {{ $query }} </b> are :</p>
    		@endif
    			@if(isset($message))
    			<p style="color:#dd4b39">{{ $message }}</p>
    			@endif
        </div>
    </div>


    <div class="row">
    @foreach($asks as $ask)
      <div class="col-lg-12">
        <div class="box box-default">
                        <div class="box-header with-border heading">
                          <img src="{{ asset('images/user.png') }}" class="pull-left" style="width:3%;border-radius: 30px;margin-right: 10px" alt="user">
                          @if($ask->show_name == '1')
                          @if(isset($ask->user->basicDetail))
                          <label>{{ $ask->user->basicDetail->firstname }} {{ $ask->user->basicDetail->lastname }}</label>
                          @endif
                          @else
                          <label>Unknown</label>
                          @endif
                          <div class="pull-right">
                          <label>Category: <span style="font-size:11px;color:#999;">{{$ask->category->name}}</span> | Sub-category: <span style="font-size:11px;color:#999;">{{$ask->subcategory}}</span></label><br>
                          </div>
                        </div>
                 <div class="box-body">
                   <h3><a href="{{route('admin.questions.show', $ask->id)}}" style="color:black">{{$ask->question}}</a></h3>
                 <div>
          <label style="font-size:11px;color:#999;line-height:1px;">{{ date('jS M, Y', strtotime($ask->created_at)) }}</label>
        </div>
          <p class="mt20">{{ substr(strip_tags($ask->detail), 0, 150) }}{{ strlen(strip_tags($ask->detail)) > 150 ? '...' : '' }}</p>
          <div class="form-group mt20">
          <a href=""> <i class="fa fa-thumbs-up "></i></a>
          <a href="" class="ml10"> <i class="fa fa-share "></i></a>
          <a href="" class="ml10"> Comments <i class="fa fa-comments "></i></a>
          </div>
                 </div>
      </div>
                 </div>

    @endforeach
    </div>


  </div>
</section>


@endsection

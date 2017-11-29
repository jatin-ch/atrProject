@extends('layouts.adviser')
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
    <form class="navbar-form navbar-left"  action="{{ route('adviser.questions.search') }}" method="POST" role="search">
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
    <button class="btn btn-danger pull-right navbar-btn" data-target="#addpop2" data-toggle="modal">Ask Question</button>
  </div>
</nav>
      </div>
    </div>



    <div class="row">
      <div class="col-lg-12">
        <div class="basicdetail" style="border: 0;padding: 20px">
          <img src="{{asset('images/user.png')}}" style="width:3%;border-radius: 30px;margin-right: 10px" alt="user">
          <label>{{ Auth::user()->basicDetail->firstname }} {{ Auth::user()->basicDetail->lastname }}</label><br>
          <label style="font-size: 18px;color: #999;"><a href="#" data-target="#addpop2" data-toggle="modal"> What is your questions?</a></label>
        </div>
      </div>
    </div>


    <div class="modal fade" id="addpop2" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p><h4 class="modal-title">Ask Your Query?</h4>Our expert will answer you within 24 hrs maximum</p>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                              {!! Form::open(['route' => ['asks.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label for="category">Choose Your Category</label>
                                    <select class="form-control" name="category" id="categoryAs1">
                                        <option value="">-- Select --</option>
                                      @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{$category->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Choose Your Sub-Category</label>
                                    <select class="form-control" name="sub_category" id="subcategoryAs1">
                                      <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('question', 'Title') }}
                                    {{ Form::text('question', null, ['class' => 'form-control', 'placeholder' => 'Query?', 'required' => '']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('detail', 'Explain your query in detail') }}
                                    {{ Form::textarea('detail', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => "Query?"]) }}
                                </div>
                                <div class="form-group">
                                    <label for="category">Do you Want to answer from Experts only or anyone can answer?</label><br />
                                    <label> <input type="radio" name="only_expert" value="1" /> Only Experts </label>
                                    <label>  <input type="radio" name="only_expert" value="0" checked /> Anyone can Answer </label>
                                </div>
                                <div class="form-group">
                                    <label for="category">Do you Want to show your name on site?</label><br />
                                    <label> <input type="radio" name="show_name" value="1" checked /> Yes </label>
                                    <label>  <input type="radio" name="show_name" value="0" /> No </label>
                                </div>
                                <div class="text-center">
                                  {{ Form::submit('Ask Question', ['class' => 'text-center btn btn-success']) }}
                                  <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
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
                   <h3><a href="{{route('adviser.questions.show', $ask->id)}}" style="color:black">{{$ask->question}}</a></h3>
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


<script type="text/javascript">
       $('#categoryAs1').on('change', function(e){
         console.log(e);
         var cat_id = e.target.value;

         $.get('http://testserver.adviceli.com/public/newGet?cat_id=' + cat_id, function(data){
           $('#subcategoryAs1').empty();
           $.each(data, function(index, subcatObj){
             $('#subcategoryAs1').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>')
           });
         });
       });
     </script>


@endsection

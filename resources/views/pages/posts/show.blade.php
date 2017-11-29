@extends('layouts.website')
@section('title') | Blog-posts | {{$post->title}} @endsection
@section('content')

<div class="container">
<div class="row">
<div class="col-md-9">
<div class="panel panel-default">
  <div class="panel-body">

    <div class="row">
     <div class="col-md-12"><h3><strong>{{ $post->title }}</strong></h3></div>
     <div class="col-md-1" style="border-right:2px solid silver">
       <center>
       @if(isset($post->user->basicDetail->image))
       <img src="{{ asset('images/' .$post->user->basicDetail->image) }}" class="img-circle" style="width:50px">
       @else
       <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:50px">
       @endif
       <center>
     </div>
     <div class="col-md-4">
       <strong>by : <a>{{ $post->user->basicDetail->firstname }} {{ $post->user->basicDetail->lastname }}</a></strong> <br>
       <small>{{ date('jS M Y, h:i A', strtotime($post->created_at)) }}</small>
     </div>
     <div class="col-md-7">
       <p>Category : {{ $post->category->name }} | Sub-category : </p>
     </div>
    </div>

   <div class="row">
     <div class="col-md-12">
       <p>{!! $post->body !!}</p>
       @if(isset($post->featured_image))
       <center><img src="{{ asset('posts/' .$post->featured_image) }}" style="width:100%"></center>
       @endif
     </div>
   </div>

   <div class="row mt20">
     <div class="col-md-1">
       {!! Form::open(['route' => ['like'], 'method' => 'POST', 'id' => 'form-id']) !!}
       {{ Form::hidden('postId', $post->id) }}
       <input type="hidden" name="isLike" value=true>
       @if(Auth::user()->likes()->where('post_id', $post->id)->first())
       <a href="#"><i class="fa fa-heart" aria-hidden="true" onclick="document.getElementById('form-id').submit();"></i></a> {{$post->likes()->count()}}
         <!-- count()-1 will also work -->
       <!-- <a href="#" class="like1" onclick="document.getElementById('form-id').submit();">Like</a> | <a href="#" class="like1">Share</a> -->
       @else
       <a href="#" style="color:silver"><i class="fa fa-heart" aria-hidden="true" onclick="document.getElementById('form-id').submit();"></i></a> {{$post->likes()->count()}}
       <!-- <a href="#" class="like1" onclick="document.getElementById('form-id').submit();">Like</a> | <a href="#" class="like1">Share</a> -->
       @endif
       {!! Form::close() !!}
     </div>
     <div class="col-md-7">
        <i class="fa fa-commenting-o" aria-hidden="true"></i> {{ $post->comments->count() }}
     </div>
        <div class="col-md-2 pull-right" data-toggle="tooltip" data-placement="left" title="{{$post->comments->count()}} comment">
            <i class="fa fa-angle-down fa-2x" style="cursor:pointer;color:grey" aria-hidden="true" onclick="document.getElementById('cmt{{$post->id}}').style.display='block'"></i>
            <i class="fa fa-angle-up fa-2x" style="cursor:pointer;color:grey" aria-hidden="true" onclick="document.getElementById('cmt{{$post->id}}').style.display='none'"></i>
        </div>
   </div>
   <hr>

   <div class="row" id="cmt{{$post->id}}" style="display:none">
   <div class="col-md-12">
    <div class="col-md-12">
      @foreach($post->comments as $comment)
      <div class="row">
        <div class="col-md-1">
          @if(isset($comment->user->basicDetail->image))
          <img src="{{ asset('images/' .$comment->user->basicDetail->image) }}" class="img-circle" style="width:34px">
          @else
          <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:34px">
          @endif
          <p>
            {!! Form::open(['route' => ['clike'], 'method' => 'POST', 'id' => 'c-id'.$comment->id]) !!}
            {{ Form::hidden('commentId', $comment->id) }}
            <input type="hidden" name="isLike" value=true>
            @if(Auth::user()->clikes()->where('post_comment_id', $comment->id)->first())
            <a href="#" onclick="document.getElementById('c-id{{$comment->id}}').submit();"><i class="fa fa-heart"></i></a> {{$comment->clikes()->count()}}
            @else
            <a href="#" onclick="document.getElementById('c-id{{$comment->id}}').submit();" style="color:silver"><i class="fa fa-heart"></i></a> {{$comment->clikes()->count()}}
            @endif
            {!! Form::close() !!}
          </p>
        </div>
        <div class="col-md-10">
          <span style="font-size:12px"><a>{{ $comment->user->basicDetail->firstname }} {{ $comment->user->basicDetail->lastname }}</a> on {{ date('j M Y' ,strtotime($comment->created_at)) }}</span>
          <p>{{ $comment->comment }}</p>

          <div class="row" id="{{$comment->id}}" style="display:none">

          <div class="col-md-12">
           {!!  Form::open(['route' => ['reply.store', $comment->id], 'method' => 'POST']) !!}
              <div class="input-group col-md-10">
                <div class="input-group-btn" style="background-color:silver">
                   @if(isset(Auth::user()->basicDetail->image))
                   <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" class="img-circle" style="width:20px">
                   @else
                   <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:20px">
                   @endif
                </div>

               {{ Form::text('reply',null, ['class' => 'form-control', 'style' => 'height:25px;', 'placeholder' => 'Write a reply...', 'required'=>'']) }}
               <div class="input-group-btn">
                   <button type="submit" class="btn btn-primary btn-xs" style="height:25px">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
             </div>
           {!! Form::close() !!} <br>
         </div>

          @foreach($comment->replies as $reply)
          <div class="col-md-12">
            <div class="col-md-1" style="border-right:1px solid silver">
              @if(isset($reply->user->basicDetail->image))
              <img src="{{ asset('images/' .$reply->user->basicDetail->image) }}" class="img-circle" style="width:20px">
              @else
              <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:20px">
              @endif
            </div>

            <div class="col-md-9">
              <p style="font-size:12px"><a>{{$reply->user->basicDetail->firstname}} {{$reply->user->basicDetail->lastname}}</a> {{ $reply->reply }}</p>
            </div>

            <div class="col-md-2">
                {!! Form::open(['route' => ['rlike'], 'method' => 'POST', 'id' => 'r-id'.$reply->id]) !!}
                  {{ Form::hidden('replyId', $reply->id) }}
                  <input type="hidden" name="isLike" value=true>
                  @if(Auth::user()->rlikes()->where('comment_reply_id', $reply->id)->first())
                  <a href="#" onclick="document.getElementById('r-id{{$reply->id}}').submit();"><i class="fa fa-heart"></i></a> {{$reply->rlikes()->count()}}
                  @else
                  <a href="#" onclick="document.getElementById('r-id{{$reply->id}}').submit();" style="color:silver"><i class="fa fa-heart"></i></a> {{$reply->rlikes()->count()}}
                  @endif
                {!! Form::close() !!}
            </div>

          </div>
          @endforeach

         </div>

         </div>

        <div class="col-md-1" data-toggle="tooltip" data-placement="left" title="{{$comment->replies->count()}} reply">
            <i class="fa fa-angle-down" style="cursor:pointer" aria-hidden="true" onclick="document.getElementById('{{$comment->id}}').style.display='block'"></i>
            <i class="fa fa-angle-up" style="cursor:pointer" aria-hidden="true" onclick="document.getElementById('{{$comment->id}}').style.display='none'"></i>
        </div>


      </div>
      <hr>
      @endforeach
    </div>
  </div>

   <div class="col-md-12">
     <div class="col-md-1">
       @if(isset(Auth::user()->basicDetail->image))
       <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" class="img-circle" style="width:34px">
       @else
       <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:34px">
       @endif
     </div>

     {!!  Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) !!}
     <div class="col-md-8">
       {{ Form::text('comment',null, ['class' => 'form-control' ,'placeholder' => 'Write a comment...', 'required'=>'']) }} <br>
     </div>
     <div class="col-md-2">
       {{ Form::submit('COMMENT', ['class' => 'btn btn-primary']) }}
     </div>
     {!! Form::close() !!}
   </div>

   </div>



 </div>

</div>
</div>
</div>
</div>

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="{{ asset('js/like.js') }}"></script>

<script>
   var token = '{{ Session::token() }}';
   var urlLike = '{{ route('like') }}';
</script>

@endsection

@extends('layouts.website')
@section('title') | Ask-us | {{$ask->question}} @endsection
@section('content')

<div class="col-md-11">



   <div class="row">
     <div class="col-md-8 col-md-offset-2">
       <div class="panel panel-default">
           <div class="panel-body">
             <div class="row">
               <div class="col-md-1">
                 <img src="{{asset('images/user.png')}}" class="img-circle" style="width:50px">
               </div>
               <div class="col-md-11">
                 <h3 style="margin:2px">{{ $ask->question }}</h3>
                 <p style="font-size:13px;color:grey">
                 @if($ask->show_name =='1')
                  <a>{{ $ask->user->basicDetail->firstname }} {{ $ask->user->basicDetail->lastname }}</a>
                 @endif
                 Asked: {{ date('jS M,  Y', strtotime($ask->created_at)) }}
                 <span class="pull-right">Category: {{ $ask->category->name }} | Sub-category: {{ $ask->subcategory }}</span>
                 </p>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12">
                 <p style="margin-top:10px">{{ $ask->detail }}</p>
               </div>
             </div>
           </div>
       </div>
     </div>
   </div>

  @if($ask->only_expert == 0)
  @if($ask->answers->where('user_id',Auth::user()->id)->first())
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
       <p><a>You already answered this question.</a></p>
    </div>
  </div>
  @else
   <div class="row">
     <div class="col-md-8 col-md-offset-2">
       <div class="panel panel-default">
           <div class="panel-body">
             <div class="row">
               <div class="col-md-1">
                 <img src="{{asset('images/user.png')}}" class="img-circle" style="width:50px">
               </div>
               {!! Form::open(['route' => ['asks.answer'], 'method' => 'POST']) !!}
               {{ Form::hidden('ask_id', $ask->id) }}
               <div class="col-md-9">
                {{ Form::textarea('answer', null, ['class' => 'form-control', 'rows' => '2']) }}
               </div>
               <div class="col-md-2">
                {{ Form::submit('Answer', ['class' => 'btn btn-primary']) }}
               </div>
               {!! Form::close() !!}
             </div>
           </div>
       </div>
     </div>
   </div>
   @endif
   @endif



   <div class="row">
     <div class="col-md-8 col-md-offset-2">
       <div class="panel panel-default">
         <div class="panel-heading">
           <h4 style="color:#262626;font-weight:bold">{{ $ask->answers->count() }} + Answers</h4>
         </div>
         @foreach($ask->answers as $answer)
           <div class="panel-body" style="border-bottom:1px solid silver">
             <div class="row">
               <div class="col-md-1">
                 <img src="{{asset('images/user.png')}}" class="img-circle" style="width:40px">
               </div>
               <div class="col-md-9">
                <a>{{$answer->user->basicDetail->firstname}} {{$answer->user->basicDetail->lastname}}</a> Answered: {{ date('j M Y, g:i A', strtotime($answer->created_at)) }}
               </div>
               <div class="col-md-1">
                   {!! Form::open(['route' => ['answer.like'], 'method' => 'POST', 'id' => 'a-id'.$answer->id]) !!}
                   {{ Form::hidden('answerId', $answer->id) }}
                   <input type="hidden" name="isLike" value=true>
                   @if(Auth::user()->alikes()->where('answer_id', $answer->id)->first())
                   <a href="#"><i class="fa fa-heart" aria-hidden="true" onclick="document.getElementById('a-id{{$answer->id}}').submit();"></i></a> <strong>{{$answer->likes()->count()}}</strong>
                   @else
                   <a href="#" style="color:silver"><i class="fa fa-heart" aria-hidden="true" onclick="document.getElementById('a-id{{$answer->id}}').submit();"></i></a> <strong>{{$answer->likes()->count()}}</strong>
                   @endif
                   {!! Form::close() !!}
                </div>
                <div class="col-md-1">
                     <i class="fa fa-commenting-o" aria-hidden="true"></i>
                     <strong> {{ $answer->comments->count() }} </strong>
                 </div>
             </div>
             <div class="row">
               <div class="col-md-12">
                 <p style="margin-top:10px">{!! $answer->answer !!}</p>
                 <div class="pull-right" data-toggle="tooltip" data-placement="left" title="{{$answer->comments->count()}} comment">
                     <i class="fa fa-angle-down fa-2x" style="cursor:pointer;color:grey" aria-hidden="true" onclick="document.getElementById('cmt{{$answer->id}}').style.display='block'"></i>
                     <i class="fa fa-angle-up fa-2x" style="cursor:pointer;color:grey" aria-hidden="true" onclick="document.getElementById('cmt{{$answer->id}}').style.display='none'"></i>
                  </div>

                <div class="row" id="cmt{{$answer->id}}" style="display:none">
                @foreach($answer->comments as $comment)
                 <div class="col-md-12">
                   <div class="col-md-1">
                     <img src="{{asset('images/user.png')}}" class="img-circle" style="width:25px">
                   </div>
                   <div class="col-md-9">
                    <p><a>{{$comment->user->basicDetail->firstname}} {{$comment->user->basicDetail->lastname}}</a> {{ $comment->comment }}</p>
                    <div class="row" id="{{$comment->id}}" style="display:none">
                    <div class="col-md-12">
                      <div class="col-md-1">
                        <img src="{{asset('images/user.png')}}" class="img-circle" style="width:25px">
                      </div>
                      {!! Form::open(['route' => ['answer.reply'], 'method' => 'POST']) !!}
                      {{ Form::hidden('comment_id', $comment->id) }}
                      <div class="col-md-10">
                       <div class="input-group">
                          {{ Form::text('reply', null, ['class' => 'form-control', 'style' => 'height:25px;', 'placeholder' => 'Write a reply...', 'required'=>'']) }}
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-xs" style="height:25px">
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </button>
                          </div>
                       </div>
                      </div>
                      {!! Form::close() !!}
                    </div>
                    <br><br>

                    @foreach($comment->replies as $reply)
                    <div class="col-md-12">
                      <div class="col-md-1">
                        <img src="{{asset('images/user.png')}}" class="img-circle" style="width:20px">
                      </div>
                      <div class="col-md-9">
                       <p style="font-size:12px"><a>{{$reply->user->basicDetail->firstname}} {{$reply->user->basicDetail->lastname}}</a> {{ $reply->reply }}</p>
                      </div>
                    </div>
                    @endforeach
                    </div>
                    <hr>
                   </div>
                   <div class="col-md-1" data-toggle="tooltip" data-placement="left" title="{{$comment->replies->count()}} reply">
                     <i class="fa fa-angle-down" style="cursor:pointer" aria-hidden="true" onclick="document.getElementById('{{$comment->id}}').style.display='block'"></i>
                     <i class="fa fa-angle-up" style="cursor:pointer" aria-hidden="true" onclick="document.getElementById('{{$comment->id}}').style.display='none'"></i>
                  </div>
                 </div>
                 @endforeach

                 <div class="col-md-12">
                   <div class="col-md-1">
                     <img src="{{asset('images/user.png')}}" class="img-circle" style="width:30px">
                   </div>
                   {!! Form::open(['route' => ['answer.comment'], 'method' => 'POST']) !!}
                   {{ Form::hidden('answer_id', $answer->id) }}
                   <div class="col-md-9">
                      {{ Form::text('comment', null, ['class' => 'form-control', 'placeholder' => 'Write a comment...', 'required'=>'']) }}
                   </div>
                   <div class="col-md-1">
                       {{ Form::submit('Comment',['class' => 'btn btn-primary']) }}
                    </div>
                   {!! Form::close() !!}
                 </div>

                 </div>


               </div>
             </div>
           </div>
           @endforeach
       </div>
     </div>
   </div>



</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

@endsection

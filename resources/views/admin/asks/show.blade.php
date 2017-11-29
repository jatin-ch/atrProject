@extends('layouts.admin')
@section('title') | Ask-us | {{$ask->question}} @endsection
@section('content')


<div class="col-md-12">


<br>
   <div class="row">
     <div class="col-md-10 col-md-offset-1">
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


   <div class="row">
     <div class="col-md-10 col-md-offset-1">
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
                   <i class="fa fa-heart" aria-hidden="true" style="color:silver"></i> <strong>{{$answer->likes()->count()}}</strong>
                </div>
                <div class="col-md-1">
                     <i class="fa fa-commenting-o" aria-hidden="true"></i>
                     <strong> {{ $answer->comments->count() }} </strong>
                 </div>
             </div>
             <div class="row">
               <div class="col-md-12">
                 <p style="margin-top:10px">{!! $answer->answer !!}</p>
                 <div class="col-md-12">
                     {{ Form::open(['route' => ['admin.questions.answer.delete', $answer->id], 'method' => 'DELETE', 'id' => 'ad'.$answer->id]) }}
                        {{ Form::close() }}
                        <a onclick="
                    if(confirm('Are you sure, You Want to delete this answer?'))
                        {
                          event.preventDefault();
                          document.getElementById('ad{{ $answer->id }}').submit();
                        }
                        else{
                          event.preventDefault();
                        }" class="btn">
                    <i class="fa fa-trash" aria-hidden="true" style="cursor:pointer;color:#a94442"></i>
                       </a>
                 <div class="pull-right" data-toggle="tooltip" data-placement="left" title="{{$answer->comments->count()}} comment">
                     <i class="fa fa-angle-down fa-2x" style="cursor:pointer;color:grey" aria-hidden="true" onclick="document.getElementById('cmt{{$answer->id}}').style.display='block'"></i>
                     <i class="fa fa-angle-up fa-2x" style="cursor:pointer;color:grey" aria-hidden="true" onclick="document.getElementById('cmt{{$answer->id}}').style.display='none'"></i>
                  </div>
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
                    @foreach($comment->replies as $reply)
                    <div class="col-md-12">
                      <div class="col-md-1">
                        <img src="{{asset('images/user.png')}}" class="img-circle" style="width:20px">
                      </div>
                      <div class="col-md-9">
                       <p style="font-size:12px"><a>{{$reply->user->basicDetail->firstname}} {{$reply->user->basicDetail->lastname}}</a> {{ $reply->reply }}</p>
                      </div>
                      <div class="col-md-1">
                        {{ Form::open(['route' => ['admin.questions.reply.delete', $reply->id], 'method' => 'DELETE', 'id' => 'rd'.$reply->id]) }}
                        {{ Form::close() }}
                        <a onclick="
                    if(confirm('Are you sure, You Want to delete this reply?'))
                        {
                          event.preventDefault();
                          document.getElementById('rd{{ $reply->id }}').submit();
                        }
                        else{
                          event.preventDefault();
                        }" class="btn">
                    <i class="fa fa-trash" aria-hidden="true" style="cursor:pointer;color:#a94442"></i>
                       </a>
                      </div>
                    </div>
                    @endforeach
                    </div>
                    <hr>
                   </div>
                   <div class="col-md-1">
                        {{ Form::open(['route' => ['admin.questions.comment.delete', $comment->id], 'method' => 'DELETE', 'id' => 'cmtd'.$comment->id]) }}
                        {{ Form::close() }}
                        <a onclick="
                    if(confirm('Are you sure, You Want to delete this comment?'))
                        {
                          event.preventDefault();
                          document.getElementById('cmtd{{ $comment->id }}').submit();
                        }
                        else{
                          event.preventDefault();
                        }" class="btn">
                    <i class="fa fa-trash" aria-hidden="true" style="cursor:pointer;color:#a94442"></i>
                       </a>
                    </div>
                   <div class="col-md-1" data-toggle="tooltip" data-placement="left" title="{{$comment->replies->count()}} reply">
                     <i class="fa fa-angle-down" style="cursor:pointer" aria-hidden="true" onclick="document.getElementById('{{$comment->id}}').style.display='block'"></i>
                     <i class="fa fa-angle-up" style="cursor:pointer" aria-hidden="true" onclick="document.getElementById('{{$comment->id}}').style.display='none'"></i>
                  </div>
                 </div>
                 @endforeach

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

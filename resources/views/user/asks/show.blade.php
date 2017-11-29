@extends('layouts.user')
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
                 <h3 style="margin:2px"><a href="{{ route('asks.questions.show',$ask->id) }}" style="color:black">{{ $ask->question }}</a></h3>
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
            <a href="{{ route('asks.questions.show',$ask->id) }}" style="color:black;font-weight:bold">
            {{ $ask->answers->count() }}+ Answers <i class="fa fa-external-link" aria-hidden="true"></i>
            </a>

          @if(isset($answer))
         <button class="btn btn-success btn-sm pull-right" data-target="#edit1" data-toggle="modal">Edit answer</button>
        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="edit1"  role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit your answer</h4>
                </div>
                <div class="modal-body">
                {!! Form::model($answer, ['route' => ['asks.answer.update', $answer->id], 'method' => 'PUT']) !!}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                            {{ Form::textarea('answer', null, ['class' => 'form-control','id'=>'editor1', 'rows' => '5']) }}
                            {{ Form::submit('Update answer', ['class' => 'btn btn-success mt20']) }}
                            </div>
                        </div>
                    </div>
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endif

         </div>
           <div class="panel-body">
             <div class="row">
               <div class="col-md-1">
                 <img src="{{asset('images/user.png')}}" class="img-circle" style="width:50px">
               </div>

               @if(isset($answer))
               <div class="col-md-11">
               <p>{!! $answer->answer !!}</p>
               <p><i class="fa fa-heart"></i> {{ $answer->likes()->count() }} |
                <i class="fa fa-commenting-o"></i> {{ $answer->comments->count() }}</p>

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
                   <p><a>{{$comment->user->basicDetail->firstname}} {{$comment->user->basicDetail->lastname}}</a>
                   {{ $comment->comment }}
                   </p>
                   <div class="row" id="{{$comment->id}}" style="display:none">
                   <div class="col-md-12">
                     {!! Form::open(['route' => ['answer.reply'], 'method' => 'POST']) !!}
                     {{ Form::hidden('comment_id', $comment->id) }}
                     <div class="col-md-11">
                      <div class="input-group">
                          {{ Form::text('reply', null, ['class' => 'form-control', 'style' => 'height:25px;', 'placeholder' => 'Write a reply...', 'required'=>'']) }}
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-success btn-xs" style="height:25px">
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
                <hr>
                <div class="col-md-12">
                  {!! Form::open(['route' => ['answer.comment'], 'method' => 'POST']) !!}
                  {{ Form::hidden('answer_id', $answer->id) }}
                  <div class="col-md-10">
                   {{ Form::text('comment', null, ['class' => 'form-control', 'placeholder' => 'Write a comment...', 'required'=>'']) }}
                  </div>
                  <div class="col-md-2">
                   {{ Form::submit('Comment', ['class' => 'btn btn-success btn-sm']) }}
                  </div>
                  {!! Form::close() !!}
                </div>
                </div>
               </div>
               @else
               <div class="col-md-11">
               {!! Form::open(['route' => ['asks.answer'], 'method' => 'POST']) !!}
               {{ Form::hidden('ask_id', $ask->id) }}
                {{ Form::textarea('answer', null, ['class' => 'form-control','id'=>'editor1', 'rows' => '5']) }} <br>
                {{ Form::submit('Answer', ['class' => 'btn btn-success']) }}
               {!! Form::close() !!}
               </div>
               @endif
             </div>
           </div>
       </div>
     </div>
   </div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();

     CKEDITOR.replace( 'editor1' );
});
</script>


@endsection

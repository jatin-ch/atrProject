@extends ('layouts.adviser')
@section('title') | Gallery @endsection
@section('content')

<!-- page content -->
<div class="panel panel-default">
  <div class="panel-heading">
    Gallery
    <span class="pull-right">Profile {{$pw}}% complete</span>
  </div>
  <div class="panel-body">
    {!! Form::open(['route' => ['adviser.galleries.store'], 'method' => 'POST', 'files' => true]) !!}

    <div class="col-md-4 col-sm-12 col-xs-12">
      {{ Form::label('image_video', 'UPLOAD IMAGE / VIDEO', ['style' => 'margin-top:20px']) }}
      {{ Form::file('image_video') }}
    </div>

    <div class="col-md-8 col-sm-12 col-xs-12">
      {{ Form::label('video_url', 'ADD VIDEO URL', ['style' => 'margin-top:20px']) }}
      {{ Form::text('video_url', null, ['class' => 'form-control', 'placeholder' => 'Insert video URL']) }}
    </div>

   {{ Form::submit('SUBMIT', ['class' => 'btn btn-success btn-lg', 'style' => 'margin-top:20px']) }}
    {!! Form::close() !!}

  </div>
</div>


<div class="panel panel-default">
  <div class="panel-heading">
    My Gallery Uploads
  </div>
  <div class="panel-body">
    <div class="col-md-12 col-sm-12 col-xs-12">
    @foreach($galleries as $gallery)
    @if($gallery->image_video)
    <iframe src="{{ asset('uploads/' . $gallery->image_video) }}" width="280" height="170"> </iframe>
    @endif
    @endforeach
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
    @foreach($galleries as $gallery)
    @if($gallery->video_url)
    <p><a href="{{ $gallery->video_url }}">{{$gallery->video_url}}</a></p>
    @endif
    @endforeach
    </div>
  </div>
</div>



       <!-- /page content -->

@endsection

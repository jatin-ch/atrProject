@extends('layouts.website')
@section('content')

<style>
.panel-body a:hover{
  text-decoration: none;
}
#more a{
  text-decoration: underline;
}
.panel-body img{
  width: 30px;
}
.mylabel{
  margin-left: 10px;
}
</style>

<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                <p>Results for your search query <strong>{{$q}}</strong></p>

                  @if(isset($message))
            			<p style="color:#a94442">{{ $message }}</p>
            			@endif
                </div>

                <div class="panel-body">
                 @foreach($advisers as $adviser)
                 <div class="row">
                  <div class="col-md-2">
                    @if(isset($adviser->user->basicDetail->image))
                    <img src="{{ asset('images/' .$adviser->user->basicDetail->image) }}" style="width:130px">
                    @else
                    <img src="{{ asset('website/images/Rectangle.png') }}" style="width:130px">
                    <p style="position:absolute;top:40%;left:35%;color:#33ccff">Image Not Available</p>
                    @endif
                  </div>
                  <div class="col-md-8">
                    <p>
                      <strong>{{ $adviser->user->basicDetail->firstname }} {{ $adviser->user->basicDetail->lastname }}</strong>
                      @if(isset($adviser->qualification))( {{$adviser->qualification}} ) @endif
                    </p>
                    <p>{{ $adviser->cp }} - {{ $adviser->coc }}</p>
                    <p>Experience : {{ $adviser->experience }} yrs | Location : @foreach($adviser->user->locations->where('default_address', true) as $location){{ $location->city }}, @endforeach</p>
                    <p><span class="label label-info">{{ $adviser->major_subcat }}</span> <span class="label label-info">{{ $adviser->other_subcat }}</span></p>
                </div>
                  <div class="col-md-2">
                    @if($adviser->user->ratings)
                    <p><small>Rating : </small> <i class="fa fa-star" aria-hidden="true" style="color:yellow"></i> {{round($adviser->user->ratings->avg('rating'),1)}} </p>
                    @endif
                    <a href="{{ route('advisers-category.show', $adviser->user_id) }}" class="btn btn-primary btn-sm">VIEW</a>
                  </div>
                </div>
                <hr>
                  @endforeach
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

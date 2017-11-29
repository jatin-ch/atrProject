@extends('layouts.website')
@section('title') | Advisers @endsection
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
<link href="{{asset('css/website.css')}}" rel="stylesheet" type="text/css">
<div class="container">
  <div class="row">
                <div class="col-lg-12">
                    <label>Popular Search: ENT, Oncology, Ayurvada</label>
                </div>
            </div>
    <div class="row">
        <div class="col-md-3">
          <form action="{{route('advisers.cat')}}", method="POST" role="search">
          {{ csrf_field() }}

              <div id="Expertise" class="form-group expertise padt20">
                        <strong class="mr20px">Categories</strong>
                        <hr style="margin:10px">
                        <ul class="mt20 ml20">
                          @foreach($categories as $category)
                          <li ><label for="Bronchscopy"><input type="checkbox" name="cats[]" value="{{$category->name}}" {{in_array($category->name, $cats ) ? 'checked' :'' }} onchange='this.form.submit();'> {{ $category->name }}</label>
                           <span class="ml40">{{$advisers->where('major_cat',$category->name)->count()}}</span></li>
                          @endforeach
                        </ul>
                        <div class="form-group">
                            <input type="button" class="btn btn-sm btn-outline-primary ml20" value="View More" />
                        </div>
              </div>

               <div id="Expertise" class="form-group expertise padt20">
                        <strong class="mr20px">Experience</strong>
                         <hr style="margin:10px">
                        <ul class="mt20 ml20">
                          <li ><label for="exps"><input type="checkbox" name="exps[]" value="5" onchange='this.form.submit();' {{in_array('5', $exps ) ? 'checked' :'' }}> 5+ yrs ({{$advisers->where('experience','>=','5')->count()}})</label></li>
                          <li ><label for="exps"><input type="checkbox" name="exps[]" value="10" onchange='this.form.submit();' {{in_array('10', $exps ) ? 'checked' :'' }}> 10+ yrs ({{$advisers->where('experience','>=','10')->count()}})</label></li>
                          <li ><label for="exps"><input type="checkbox" name="exps[]" value="15" onchange='this.form.submit();' {{in_array('15', $exps ) ? 'checked' :'' }}> 15+ yrs ({{$advisers->where('experience','>=','15')->count()}})</label></li>
                          <li ><label for="exps"><input type="checkbox" name="exps[]" value="20" onchange='this.form.submit();' {{in_array('20', $exps ) ? 'checked' :'' }}> 20+ yrs ({{$advisers->where('experience','>=','20')->count()}})</label></li>
                        </ul>
                        <div class="form-group">
                            <input type="button" class="btn btn-sm btn-outline-primary ml20" value="View More" />
                        </div>
              </div>

              <div id="Expertise" class="form-group expertise padt20">
                        <strong class="mr20px">Type of Expert</strong>
                         <hr style="margin:10px">
                        <ul class="mt20 ml20">

                            <li ><label for="Bronchscopy"><input type="checkbox" name="types[]" value="individual" onchange='this.form.submit();' {{in_array('individual', $types ) ? 'checked' :'' }}> Individual ({{$advisers->where('type','individual')->count()}})</label></li>
                            <li ><label for="Bronchscopy"><input type="checkbox" name="types[]" value="professional" onchange='this.form.submit();' {{in_array('professional', $types ) ? 'checked' :'' }}> Professional ({{$advisers->where('type','professional')->count()}})</label></li>
                        </ul>

              </div>

          </form>
        </div>


         <div class="col-lg-9">
                    <div id="Expertise" class="row pad10 form-group expertise">
                        <div class="col-lg-3">
                            <span style="font-size: 20px;">Advisers </span><span>({{ $advisers->count() }})</span>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search within category">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-inline">
                                <label style="margin-top:10px;margin-right:10px">Sort By</label>
                               <select class="form-control" style="width: 75%">
                                   <option value="Price">Price</option>
                               </select>
                            </div>
                        </div>
                        <div class="col-lg-12 expertise pad10 mt10">

                          @if(isset($cats))
                          @foreach($cats as $query)
                           <span class="tag label label-info">
                                <span>{{ $query }}</span>
                                <a><i class="remove fa fa-window-close" aria-hidden="true"></i></a>
                            </span>
                          @endforeach
                          @endif

                            @if(isset($types))
                    @foreach($types as $type)
                    <span class="tag label label-info">
                                <span>{{ $type }}</span>
                                <a><i class="remove fa fa-window-close" aria-hidden="true"></i></a>
                            </span>
                    @endforeach
                  @endif

                  @if(isset($exps))
                    @foreach($exps as $exp)
                    <span class="tag label label-info">
                                <span>{{ $exp }} yrs</span>
                                <a><i class="remove fa fa-window-close" aria-hidden="true"></i></a>
                            </span>
                    @endforeach
                  @endif

                  @if(isset($message))
                  <p style="color:#a94442">{{ $message }}</p>
                  @endif

                  <button class="btn btn-sm btn-danger ">Clear All </button>
                        </div>

                        <div class="col-lg-12">
                            <hr />
                           @foreach($advisers as $adviser)
                           @if($adviser->user->approved == '1')
                            <div class="row">
                                <div class="col-lg-2">
                                   @if(isset($adviser->user->basicDetail->image))
                    <img src="{{ asset('images/' .$adviser->user->basicDetail->image) }}" style="width:140px">
                    @else
                    <img src="{{ asset('website/images/Rectangle.png') }}" style="width:140px">
                    <p style="position:absolute;top:40%;left:35%;color:#33ccff">Image Not Available</p>
                    @endif
                                </div>
                                <div class="col-lg-6 pad10">
                                        <div class="col-lg-12">
                                            <strong>{{ $adviser->user->basicDetail->firstname }} {{ $adviser->user->basicDetail->lastname }}</strong><span> @if(isset($adviser->qualification))( {{$adviser->qualification}} ) @endif</span>
                                            <p>{{ $adviser->cp }} - {{ $adviser->coc }}</p>
                                            <p>Experience : {{ $adviser->experience }} yrs | Location : @foreach($adviser->user->locations->where('default_address', true) as $location){{ $location->city }}, @endforeach</p>
                                            <span class="tag label label-info tags">
                                                <span>{{ $adviser->major_subcat }}</span>
                                            </span>
                                            <span class="tag label label-info tags">
                                                <span>{{ $adviser->other_subcat }}</span>
                                            </span>
                                       </div>
                                </div>
                                <div class="col-lg-4 bdrleft">

                                    {!! Form::open(['route' => ['author.follow'], 'method' => 'POST', 'id' => 'authorFollow'.$adviser->user_id]) !!}
                                       {{ Form::hidden('authorId', $adviser->user_id) }}
                                       <input type="hidden" name="isFollow" value=true>
                                       @if(Auth::user()->authorLikes()->where('author_id', $adviser->user_id)->first())
                                       <a href="#" style="margin-right:10px;"><i class="pull-right fa fa-share-alt" onclick="document.getElementById('authorFollow{{$adviser->user_id}}').submit();"></i></a>
                                       @else
                                       <a href="#" style="color:silver;margin-right:10px;"><i class="pull-right fa fa-share-alt" onclick="document.getElementById('authorFollow{{$adviser->user_id}}').submit();"></i></a>
                                       @endif
                                   {!! Form::close() !!}

                                    {!! Form::open(['route' => ['author.like'], 'method' => 'POST', 'id' => 'authorLike'.$adviser->user_id]) !!}
                                       {{ Form::hidden('authorId', $adviser->user_id) }}
                                       <input type="hidden" name="isLike" value=true>
                                       @if(Auth::user()->authorLikes()->where('author_id', $adviser->user_id)->first())
                                       <a href="#" style="margin-right:10px;"><i class="pull-right fa fa-thumbs-up" onclick="document.getElementById('authorLike{{$adviser->user_id}}').submit();"></i></a>
                                       @else
                                       <a href="#" style="color:silver;margin-right:10px;"><i class="pull-right fa fa-thumbs-up" onclick="document.getElementById('authorLike{{$adviser->user_id}}').submit();"></i></a>
                                       @endif
                                   {!! Form::close() !!}


                                     @if(App\Models\Page\UserRating::where('adviser_id',$adviser->user_id)->get())
                                    <p class="pull-left mt10 mb0"><strong>Rating : </strong>
                                      {{round(App\Models\Page\UserRating::where('adviser_id',$adviser->user_id)->avg('rating'),1)}}
                                      <i class="fa fa-star" style="color:#34a853"></i></p><br>
                                      @else
                                      <p class="mt10 mb0"><strong>Rating : </strong>
                                      <img src="{{asset('website/images/adviserratting.png')}}" style="width:25%;" />
                                      </p>
                                     @endif
                                    <p class=" mt10 mb0"><strong>Likes : </strong><i style="color:#34a853" class="fa fa-thumbs-up"></i><span class="ml10">{{App\Models\Page\AuthorLike::where('author_id',$adviser->user_id)->count()}}</span></p>
                                    <p class=" mt10 mb0"><strong>Feeds : </strong>INR<span class="ml10">1500/-</span></p>
                                    <p class=" mt10 mb0"><strong>Appointment Slots : </strong>20<span class="ml10">Min</span></p>
                                    <div class="mt20">
                                     <a href="{{ route('author.show', $adviser->user_id) }}" class="btn btn-primary btn-sm">View Adviser</a>
                                     </div>
                                </div>
                            </div>
                            <hr />
                            @endif
                             @endforeach
                       </div>
                       <center>  {{$advisers->links()}} </center>
                </div>

            </div>

    </div>
</div>


@endsection

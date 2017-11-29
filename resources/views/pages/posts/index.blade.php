@extends('layouts.website')
@section('title') | Blog-posts @endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12" style="margin-top:10px">
           <div class="input-group">
              <span class="input-group-btn">
                 <button class="btn btn-secondary" type="button" style="background-color: black;color: white;">TRENDING NOW</button>
              </span>
                 <input type="text" class="form-control">
           </div>
        </div>

         <div class="col-lg-8" style="margin-top:10px">
             <div id="Expertise" class="row pad10 form-group expertise">
               {!! Form::open(['route' => ['blog-posts.sort'], 'method' => 'POST']) !!}
                 <div class="form-group col-lg-4">
                        <select name="category" class="form-control" id="bcategory">
                          <option value="" selected>Select Category</option>
                          @foreach($categories as $category)
                           <option value="{{$category->id}}">{{$category->name}}</option>
                           @endforeach
                         </select>
                 </div>
                 <div class="col-lg-4">
                      <select name="subcategory" class="form-control" id="bsubcategory">
                        <option value=""></option>
                      </select>
                 </div>
                 <div class="col-lg-3">
                   {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                 </div>
                 {!! Form::close() !!}
              </div>

              @if(isset($message))
    		  <p style="color:#dd4b39">{{ $message }}</p>
    		  @endif

                 @foreach($posts as $post)
              <div id="Expertise" class="row pad10 form-group expertise">
                            <div class="col-lg-3">
                                @if(isset($post->featured_image))
                                 <img src="{{ asset('posts/' .$post->featured_image) }}" style="width:180px">
                                @endif
                            </div>
                            <div class="col-lg-9" style="margin-top:10px">
                                  <strong> <label>{{ $post->title }}</label></strong>
                                  <br>
                                  <strong>
                                      <label style="font-size:11px">by : <a>{{ $post->user->basicDetail->firstname }} {{ $post->user->basicDetail->lastname }}</a> on {{ date('jS M Y', strtotime($post->created_at)) }}</label>
                                  </strong>
                                <p style="font-size:12px;min-height:90px;">
                                    {{ substr(strip_tags($post->body), 0, 250) }}{{ strlen(strip_tags($post->body)) > 250 ? '...' : '' }}
                                    <a href="{{route('blog-posts.show', $post->id)}}">read more</a>
                                    <br>
                                    <label><i class="fa fa-eye" style="color:silver"></i> 1599   &nbsp;  &nbsp;  &nbsp;  &nbsp;<i class="fa fa-heart" style="color:silver"></i> {{ $post->likes->count() }}  &nbsp;  &nbsp;  &nbsp;  &nbsp;<i class="fa fa-comment" style="color:silver"></i> {{ $post->comments->count() }}</label>
                                </p>

                                </div>
              </div>
                         @endforeach

                         <div class="text-center">
                         {!! $posts->links() !!}
                         </div>
         </div>
            <div class="col-lg-4">
                        <div id="Expertise" class="row pad10 form-group expertise" style="margin:10px;">
                            <div class="col-lg-3 text-center" style="margin-top:10px">
                                <img class="" src="{{asset('website/images/FacebookIcon.png')}}" />
                                <span> 1k </span><i class="fa fa-thumbs-up"></i>
                            </div>
                            <div class="col-lg-3 text-center" style="margin-top:10px">
                                <img class="" src="{{asset('website/images/TwitterIcon.png')}}" />
                                <span> 1k </span><i class="fa fa-users"></i>
                            </div>

                            <div class="col-lg-3 text-center" style="margin-top:10px">
                                <img src="{{asset('website/images/Google.png')}}" />
                                <span> 1k </span><i class="fa fa-compress"></i>
                            </div>
                            <div class="col-lg-3" style="margin-top:10px">
                                <img class="" src="{{asset('website/images/InstagramIcon.png')}}" />
                                <span> 1k </span><i class="fa fa-users"></i>
                            </div>
                            <div class="col-lg-12 mt20">
                              <form>
                                <div class="form-group">
                                    <strong>Subscribe for News Letter:</strong>
                                    <div class="" style="margin-top:10px">
                                        <input type="text" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="" style="margin-top:10px">
                                        <input type="text" class="form-control" placeholder="Email ID">
                                    </div>
                                    <div class="text-center mt20">
                                        <button type="Submit" class="btn btn-primary">SUBSCRIBE</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#popular">Popular</a></li>
                                    <li><a data-toggle="tab" href="#recent">Recent</a></li>
                                    <li><a data-toggle="tab" href="#tags">Tags</a></li>
                                </ul>
                                <div class="tab-content sidblog">
                                  <div id="popular" class="tab-pane fade in active">
                                      <div class=" pad10">
                                          <img class="pull-left" style="width: 25%; margin-right:10px;max-height:75px;" src="{{asset('website/images/Rectangle 12.png')}}" />
                                          <a href="#">6 Diagnostic Tests to Have  Every Year (Age Group 27-355 Years)</a>
                                          <label class="mt20" style="font-size:10px">24th April 2017,9:00 AM</label>
                                          <hr style="margin-top:0;margin-bottom:0;" />
                                      </div>
                                 </div>
                                    <div id="recent" class="tab-pane fade">
                                        <div class=" pad10">
                                            <img class="pull-left" style="width: 25%; margin-right:10px;max-height:75px;" src="{{asset('website/images/Rectangle 12.png')}}" />
                                            <a href="#">6 Diagnostic Tests to Have  Every Year (Age Group 27-355 Years)</a>
                                            <label class="mt20" style="font-size:10px">24th April 2017,9:00 AM</label>
                                            <hr style="margin-top:0;margin-bottom:0;" />
                                        </div>

                                    </div>
                                    <div id="tags" class="tab-pane fade">
                                        <div class=" pad10">
                                            <img class="pull-left" style="width: 25%; margin-right:10px;max-height:75px;" src="{{asset('website/images/Rectangle 12.png')}}" />
                                            <a href="#">6 Diagnostic Tests to Have  Every Year (Age Group 27-355 Years)</a>
                                            <label class="mt20" style="font-size:10px">24th April 2017,9:00 AM</label>
                                            <hr style="margin-top:0;margin-bottom:0;" />
                                        </div>

                                    </div>
                                </div>
                        </div>
                    </div>

    </div>
</div>

<script type="text/javascript">
       $('#bcategory').on('change', function(e){
         console.log(e);
         var cat_id = e.target.value;

         $.get('http://testserver.adviceli.com/public/newGet?cat_id=' + cat_id, function(data){
           $('#bsubcategory').empty();
           $.each(data, function(index, subcatObj){
             $('#bsubcategory').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>')
           });
         });
       });
     </script>

@endsection

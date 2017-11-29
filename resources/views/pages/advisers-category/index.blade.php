@extends('layouts.website')
@section('title') | Adviser-category | {{ $category->name }} @endsection
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
.paneldiv, .flipdiv {
    padding: 5px;
    text-align: center;
      background-color: #3aab58;
    border: solid 1px #f5f5f5;
    color: white;
        cursor: pointer;
}

.paneldiv {
    padding: 20px;
    display: none;
       cursor: text;
}
.container-fluid{
    padding-left:0px!important;
     padding-right:0px!important;
}
.subcathead{
        font-size: 16px;
    font-family: "Arial";
}
.subhead2{
    font-size: 18px;
    font-family: "Arial";
}
.subcat{
        margin-bottom: 10px;
    font-size: 18px;
}
.paneldiv a {
    color: black!important;
}
.paneldiv a:hover {
    color: white!important;
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
          <form action="{{route('filter', $category->slug)}}", method="POST" role="search">
          {{ csrf_field() }}

              <div id="Expertise" class="form-group expertise padt20">
                        <strong class="mr20px">Sub-category</strong>
                        <hr style="margin:10px">
                        <ul class="mt20 ml20">
                           @foreach($category->subCategories as $subcategory)
                            <li ><label for="Bronchscopy">
                                <div class="w">
                                <input type="checkbox" name="brands[]" value="{{$subcategory->name}}" {{in_array($subcategory->name, $brands ) ? 'checked' :'' }} onchange='this.form.submit();'> </div> <div class="content2">{{ $subcategory->name }}
                              <span>{{$advisers->where('major_subcat',$subcategory->name)->count()}}</span></div></label></li>
                             @endforeach
                        </ul>
                        <div class="form-group">
                            <input type="button" class="btn btn-sm btn-outline-primary ml20" value="View More" />
                        </div>
              </div>

             <div id="Expertise" class="form-group expertise padt20">
                        <strong class="mr20px">Qualification</strong>
                         <hr style="margin:10px">
                        <ul class="mt20 ml20">
                           @foreach($category->qualifications as $qualification)
                            <li ><label for="qfs">
                                <div class="w">
                                <input type="checkbox" name="qfs[]" value="{{$qualification->name}}" {{in_array($qualification->name, $qfs ) ? 'checked' :'' }} onchange='this.form.submit();' ></div><div class="content2"> {{ $qualification->name }}<span class="ml40">12</span></div></label></li>
                             @endforeach
                        </ul>
                        <div class="form-group">
                            <input type="button" class="btn btn-sm btn-outline-primary ml20" value="View More" />
                        </div>
              </div>

           <div id="Expertise" class="form-group expertise padt20">
                        <strong class="mr20px">Hospital/Clinic</strong>
                         <hr style="margin:10px">
                        <ul class="mt20 ml20">

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
                        <strong class="mr20px">Availability</strong>
                         <hr style="margin:10px">
                        <ul class="mt20 ml20">

                        </ul>
                        <div class="form-group">
                            <input type="button" class="btn btn-sm btn-outline-primary ml20" value="View More" />
                        </div>
              </div>

               <div id="Expertise" class="form-group expertise padt20">
                        <strong class="mr20px">Consultation Mode</strong>
                         <hr style="margin:10px">
                        <ul class="mt20 ml20">

                        </ul>
                        <div class="form-group">
                            <input type="button" class="btn btn-sm btn-outline-primary ml20" value="View More" />
                        </div>
              </div>

              <div id="Expertise" class="form-group expertise padt20">
                        <strong class="mr20px">Advisor Location</strong>
                         <hr style="margin:10px">
                        <ul class="mt20 ml20">

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

             <div id="Expertise" class="form-group expertise padt20">
                        <strong class="mr20px">Gender</strong>
                         <hr style="margin:10px">
                        <ul class="mt20 ml20">
                            <li ><label for="Bronchscopy"><input type="checkbox" name="gender[]" value="M"> Male</label></li>
                            <li ><label for="Bronchscopy"><input type="checkbox" name="gender[]" value="F"> Female</label></li>
                        </ul>
              </div>
          </form>
        </div>


         <div class="col-lg-9">
                    <div id="Expertise" class="row pad10 form-group expertise">
                        <div class="col-lg-3">
                            <span style="font-size: 20px;"> {{ $category->name }} </span><span>({{ $advisers->count() }})</span>
                        </div>
                        <div class="col-lg-5">
                            <form class="navbar-form navbar-left"  action="{{ route('advisers-category.search') }}" method="POST">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="slug" value="{{$category->slug}}">
                              <div class="input-group">
                                <input type="text" name="name" class="form-control" placeholder="Search within category" required>
                                <div class="input-group-btn">
                                  <button class="btn btn-default" style="height: 34px;" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                  </button>
                                </div>
                              </div>
                            </form>
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

                          @if(isset($brands))
                          @foreach($brands as $query)
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

                  @if(isset($qfs))
                    @foreach($qfs as $qf)
                    <span class="tag label label-info">
                        <span>{{ $qf }}</span>
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

                  @if($brands || $types || $qfs || $exps)
                  <button class="btn btn-sm btn-danger ">Clear All </button>
                  @endif

            </div>

                        <div class="col-lg-12">
                            <hr />
                           @foreach($advisers as $adviser)

                        @if($adviser->user->approved == 1)
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
<div class="container-fluid footerbg pad0">
      <div class="row pad35">
            <div class="col-lg-12 subcat text-center">
               <strong> Information About Sub-Categoris </strong>
            </div>

            @foreach($category->subcategories as $subcategory)
            <div class="col-lg-6">
                <div class="flipdiv"><strong class="subcathead">{{ $subcategory->name }}</strong></div>
                 <div class="paneldiv">
                     @if(isset($subcategory->description))
                    <p>{!! $subcategory->description !!}</p>
                    @endif
                <a href="#">
                Book an appointment with the best Re-constructive Surgery Specialist.
                </a>
                 </div>
            </div>
            @endforeach

        </div>
</div>

<script>
$(document).ready(function(){
    $(".flipdiv").click(function(){
        $(this).next('div').slideToggle("slow");

    });
});
</script>
<style>
    .content2{ padding-left: 20px;
    margin-top: -23px;}
    .w{display: block;
    width: 20px;}
</style>
@endsection

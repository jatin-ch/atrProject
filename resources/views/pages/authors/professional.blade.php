@extends('layouts.website')
@section('title') | Adviser | {{ $author->basicDetail->firstname }} {{ $author->basicDetail->lastname }} @endsection
@section('content')

<style>
.panel-body a:hover{
  text-decoration: none;
}
.panel-body img{
  width:150px;
}

td{border:none;}
tr{border:none;}
.menu{
      margin-left: 100px;
    margin-right: 180px;
    font-weight: 600;
    font-size: 18px;
}

.imageContainer span {
    position: absolute;
    top: 18px;
    left: 178px;
    width: 10%;
    color: white;
}
.heading{
  font-size: 18px;
    color: #888080;
}
.ulstyle{
  list-style-type: square;
    margin-left: 50px;
    font-size: 15px;
    font-weight: 500;
    margin-top: 10px;
}
.dateHeader{
    padding: 5px;
    background-color: #ddd;
    text-align: center;
    border-bottom: 1px solid gray;
}
.selectFrom{
    margin-left: 40px;
    margin-top: -25px;
}
.selectTo{
    margin-left: 25px;
    margin-top: -25px;
}
.preferBdr{
    border: 1px solid #ddd;
    background-color:#F5F5F8;
    margin-right: 66px;
}
.timeSlot{
    border: 1px solid #ddd;
    background-color:#F5F5F8;
    margin: 5px;
}
.preferBdrMeet{
    border: 1px solid #ddd;
    background-color:#F5F5F8;
    height: 60px;
    margin-right: 80px;
}
.preferBdrTime{
    border: 1px solid #ddd;
    background-color:#F5F5F8;
    height: 60px;
    margin-right: 80px;
}
.forAddr{
    height: 60px;
    padding: 20px;
    margin-top:20px;
}
.forAddrs{
    height: 60px;
    padding: 20px;
}

.nav-tabs { border-bottom: 2px solid #DDD!important;
    background: #f5f5f5; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #666; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
        .nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }
.tab-pane { padding: 15px 0; }
.tab-content{padding:20px}

.card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }


.jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }


        .jssorb057 .i {position:absolute;cursor:pointer;}
        .jssorb057 .i .b {fill:none;stroke:#fff;stroke-width:2000;stroke-miterlimit:10;stroke-opacity:0.4;}
        .jssorb057 .i:hover .b {stroke-opacity:.7;}
        .jssorb057 .iav .b {stroke-opacity: 1;}
        .jssorb057 .i.idn {opacity:.3;}

        .jssora073 {display:block;position:absolute;cursor:pointer;}
        .jssora073 .a {fill:#ddd;fill-opacity:.7;stroke:#000;stroke-width:160;stroke-miterlimit:10;stroke-opacity:.7;}
        .jssora073:hover {opacity:.8;}
        .jssora073.jssora073dn {opacity:.4;}
        .jssora073.jssora073ds {opacity:.3;pointer-events:none;}

</style>
<link href="{{ asset('css/rating.css') }}" rel="stylesheet">

<div class="container-fluid">

  <div class="container mt30">
            <div class="cont-wrap">
                <div class="row">
                    <div class="col-md-2">
                        <div class="pic">
                      @if(isset($author->basicDetail->image))
                        <img class="img-responsive height25" src="{{ asset('images/' .$author->basicDetail->image) }}">
                      @else
                        <img class="img-responsive height25" src="{{ asset('website/images/Rectangle.png') }}">
                      @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="name">
                            Adviser Name <br />
                            <span>{{ $author->basicDetail->firstname }} {{ $author->basicDetail->lastname }}</span>
                        </div>
                        <div class="name mt10">
                            Qualification <br />
                            <span> {{ $author->expertDetail->qualification }}</span>
                        </div>

                        <div class="name mt10">
                            Current Hospital / Clinic <br />
                            <span>Sir Ganga Ram Hospital</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="name">
                            Experience<br />
                            <span> 10 Yrs.</span>
                        </div>
                        <div class="name mt10">
                            Current Profile
                            <br />
                            <span>  HOD (Oncology)</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="name">
                            Experience<br />
                            <span> {{ $author->expertDetail->experience }} yrs</span>
                        </div>
                        <div class="name mt10">
                            Current Profile
                            <br />
                            <span>  HOD (Oncology)</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="name">
                            Location<br />
                             <span>{{ $author->locations->first()->city }}</span>
                        </div>
                        <div class="text-center">
                          <a href="#" data-target="#chatModal" data-toggle="modal" class="btn mt60 btn-success"> <b>CHAT </b><br />({{$chat->consultation_fee}} for {{$chat->consultation_question}} questions)</a>
                        </div>

                    </div>
                    <div class="col-md-1">
                        <div class="icons">
                            <div class="pull-left">
                               {!! Form::open(['route' => ['author.like'], 'method' => 'POST', 'id' => 'authorLike'.$author->id]) !!}
                                   {{ Form::hidden('authorId', $author->id) }}
                                   <input type="hidden" name="isLike" value=true>
                                   <a href="#"><img src="{{ asset('website/images/like.png') }}" onclick="document.getElementById('authorLike{{$author->id}}').submit();"></a>
                               {!! Form::close() !!}
                            </div>
                            <div class="pull-right">
                                {!! Form::open(['route' => ['author.follow'], 'method' => 'POST', 'id' => 'authorFollow'.$author->id]) !!}
                                   {{ Form::hidden('authorId', $author->id) }}
                                   <input type="hidden" name="isFollow" value=true>
                                   <a href="#" style="margin-right:10px;"><img class="img-responsive" src="{{ asset('website/images/share.png') }}" onclick="document.getElementById('authorFollow{{$author->id}}').submit();"></a>
                               {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

       <div class="container">
           <div class="row">
                                    <div class="col-md-12">
                                    <!-- Nav tabs --><div class="card">
                                    <ul class="nav nav-tabs text-center" role="tablist" style="margin-top:30px">
                                        <li class="menu" role="presentation" class="active"><a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">Overview</a></li>
                                        <li class="menu" role="presentation"><a href="#services" aria-controls="services" role="tab" data-toggle="tab">Services</a></li>
                                        <li class="menu" style="margin-right:0px " role="presentation"><a href="#qa" aria-controls="qa" role="tab" data-toggle="tab">Q&A</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="overview">
                                         <div class="row" style="padding: 20px">
                                          <div class="col-md-offset-1 col-md-4">
                                            <span class="heading">Specialization/Experties</span>
                                            <ul class="ulstyle">

                                               @foreach($author->specializations as $specialization)
                                               <li><strong>{{ $specialization->name }}</strong></li>
                                                @endforeach
                                            </ul>
                                          </div>
                                           <div class="col-md-7">
                                            <span class="heading">Education</span>
                                            <ul class="ulstyle">
                                               @foreach($author->educations as $education)
                        <li>{{ $education->degree }} - {{ $education->college }} - {{ $education->year }}</li>
                        @endforeach
                                            </ul>
                                          </div>
                                           </div>
                                           <div class="row" style="padding: 20px">
                                          <div class="col-md-offset-1 col-md-4">
                                            <span class="heading">Work Experience</span>
                                            <ul class="ulstyle">
                                               @foreach($author->WorkExperiences as $workexperience)
                                               <li>{{ $workexperience->from_year }} - {{ $workexperience->to_year }}, {{ $workexperience->profile }}, {{ $workexperience->office }}</li>
                                                        @endforeach
                                            </ul>
                                          </div>
                                          <div class="col-md-7">
                                            <span class="heading">Awards & Recognition</span>
                                            <ul class="ulstyle">
                                               @foreach($author->awards as $award)
                        <li>{{ $award->award_name }} - {{ $award->award_year }},  by {{ $award->award_by }}</li>
                        @endforeach
                                            </ul>
                                          </div>
                                            </div>
                                              <div class="row" style="padding: 20px">
                                           <div class="col-md-offset-1 col-md-11">
                                            <span class="heading">Services</span>
                                            <ul class="ulstyle">

                                               @foreach($author->specializations as $specialization)
                                               <li><strong>{{ $specialization->name }}</strong></li>
                                                @endforeach
                                            </ul>
                                          </div>
                                           </div>
                                            <div class="row" style="padding: 20px">
                                             <div class="col-md-offset-1 col-md-10">
                                            <span class="heading">Expertise Detail / About me</span>
                                            <p><strong>{{ $author->expertDetail->about }}</strong></p>
                                             </div>
                                            </div>
                                            <div class="row" style="padding: 20px">
                                              <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:150px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="{{ asset('website/img/spin.svg') }}" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:150px;overflow:hidden;">
            <div>
                <img data-u="image" src="{{ asset('website/img/001.jpg') }}" />
            </div>
            <div>
                <img data-u="image" src="{{ asset('website/img/005.jpg') }}" />
            </div>
            <div>
                <img data-u="image" src="{{ asset('website/img/006.jpg') }}" />
            </div>
            <div>
                <img data-u="image" src="{{ asset('website/img/007.jpg') }}" />
            </div>
            <div>
                <img data-u="image" src="{{ asset('website/img/008.jpg') }}" />
            </div>
            <div>
                <img data-u="image" src="{{ asset('website/img/009.jpg') }}" />
            </div>
            <div>
                <img data-u="image" src="{{ asset('website/img/010.jpg') }}" />
            </div>
            <div>
                <img data-u="image" src="{{ asset('website/img/025.jpg') }}" />
            </div>
            <div>
                <img data-u="image" src="{{ asset('website/img/024.jpg') }}" />
            </div>
            <div>
                <img data-u="image" src="{{ asset('website/img/026.jpg') }}" />
            </div>
            <div>
                <img data-u="image" src="{{ asset('website/img/027.jpg') }}" />
            </div>
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb057" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5000"></circle>
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora073" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="a" d="M4037.7,8357.3l5891.8,5891.8c100.6,100.6,219.7,150.9,357.3,150.9s256.7-50.3,357.3-150.9 l1318.1-1318.1c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3L7745.9,8000l4216.4-4216.4 c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3l-1318.1-1318.1c-100.6-100.6-219.7-150.9-357.3-150.9 s-256.7,50.3-357.3,150.9L4037.7,7642.7c-100.6,100.6-150.9,219.7-150.9,357.3C3886.8,8137.6,3937.1,8256.7,4037.7,8357.3 L4037.7,8357.3z"></path>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora073" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="a" d="M11962.3,8357.3l-5891.8,5891.8c-100.6,100.6-219.7,150.9-357.3,150.9s-256.7-50.3-357.3-150.9 L4037.7,12931c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3L8254.1,8000L4037.7,3783.6 c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3l1318.1-1318.1c100.6-100.6,219.7-150.9,357.3-150.9 s256.7,50.3,357.3,150.9l5891.8,5891.8c100.6,100.6,150.9,219.7,150.9,357.3C12113.2,8137.6,12062.9,8256.7,11962.3,8357.3 L11962.3,8357.3z"></path>
            </svg>
        </div>
    </div>
    <script type="text/javascript">jssor_1_slider_init();</script>
                                            </div>
              <div class="row">
             <div class="col-md-12">
                                  <div class="text-center font20">
                                    <strong>Please Select the Mode of Consultation</strong>
                                  </div>
                                  <div class="card mt10">

                                     <ul class="nav nav-tabs text-center" role="tablist">
                                        <li class="menu" role="presentation" class="active"><a href="#phone" aria-controls="phone" role="tab" data-toggle="tab">Phone Call</a></li>
                                        <li class="menu" role="presentation"><a href="#video" aria-controls="video" role="tab" data-toggle="tab">Video Call</a></li>
                                        <li class="menu" role="presentation" style="margin-right:0px"><a href="#personal" aria-controls="Personal" role="tab" data-toggle="tab">Personal Meeting</a></li>
                                    </ul>

                                     <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="phone">
                                            <div class="row">
                                             <div class="text-center font20">
                                                 <strong>Consultation Fees: Rs {{$pc->consultation_fee}}/ Per slot</strong>
                                             </div>

                                            {!! Form::open(['route' => ['booking.consultation'], 'method' => 'POST', 'id' => $pc->id]) !!}
                                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">

                                            {{ Form::hidden('availability_id', $pc->id, ['id'=>'pcId']) }}
                                            {{ Form::hidden('user_id', $author->id) }}

                                            <div class="container" style="margin-top: 20px;">
                                                 <div class="preferBdr">
                                                 <div class="col-lg-12">
                                                     <div class="col-lg-4">
                                                     <div class="card" style="border:1px solid gray;margin-top:10px;">
                                                        <div class="card-header dateHeader"><b>Date</b></div>
                                                        <div class="card-body " style="padding: 7px;">
                                                            {{ Form::date('date', null, ['class' => 'form-control', 'id'=>'pcd', 'required'=>'', 'min'=>Carbon\Carbon::today()->format('Y-m-d')]) }}
                                                            </div>
                                                     </div>
                                                     </div>
                                                     <div class="col-lg-8">
                                                        <div class="card" style="border:1px solid gray;margin-top:10px;">
                                                            <div class="card-header dateHeader"><b>Time</b></div>
                                                            <div class="card-body row" id="pct">
                                                                <!--<select class="form-control" name="time" id="fst">-->
                                                                <!--    <option value=""></option>-->
                                                                <!--</select>-->
                                                              </div>
                                                        </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             </div>

                                             {{ Form::hidden('total_pay', $pc->consultation_fee) }}

                                            <div class="col-lg-12 text-center ">
                                              <button class="btn btn-primary mt10" onclick="document.getElementById({{ $pc->id }}).submit();">BOOK APPOINTMENT</button>
                                            </div>
                                            {!! Form::close() !!}


                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane " id="video">
                                            <div class="row">
                                             <div class="text-center font20">
                                                 <strong>Consultation Fees: Rs {{$vc->consultation_fee}}/ Per slot</strong>
                                             </div>

                                             {!! Form::open(['route' => ['booking.consultation'], 'method' => 'POST', 'id' => $vc->id]) !!}

                                            {{ Form::hidden('availability_id', $vc->id, ['id'=>'vcId']) }}
                                            {{ Form::hidden('user_id', $author->id) }}

                                            <div class="container" style="margin-top: 20px;">
                                                 <div class="preferBdr">
                                                 <div class="col-lg-12">

                                                      <div class="col-lg-4">
                                                         <div class="card" style="border:1px solid gray;margin-top:10px;">
                                                        <div class="card-header dateHeader"><b>Date</b></div>
                                                        <div class="card-body " style="padding: 7px;">
                                                            {{ Form::date('date', null, ['class' => 'form-control', 'id'=>'vcd', 'required'=>'', 'min'=>Carbon\Carbon::today()->format('Y-m-d')]) }}
                                                            </div>
                                                     </div>
                                                     </div>

                                                      <div class="col-lg-8">
                                                        <div class="card" style="border:1px solid gray;margin-top:10px;">
                                                            <div class="card-header dateHeader"><b>Time</b></div>
                                                            <div class="card-body row" id="vct">

                                                            </div>
                                                        </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             </div>


                                             {{ Form::hidden('total_pay', $vc->consultation_fee) }}

                                            <div class="col-lg-12 text-center ">
                                              <button class="btn btn-primary mt10" onclick="document.getElementById({{ $vc->id }}).submit();">BOOK APPOINTMENT</button>
                                            </div>

                                            {!! Form::close() !!}
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane " id="personal">
                                            <div class="row">
                                             <div class="text-center font20">
                                                 <strong>Consultation Fees: Rs {{$pm->consultation_fee}}/ Per slot</strong>
                                             </div>

                                             {!! Form::open(['route' => ['booking.consultation'], 'method' => 'POST', 'id' => $pm->id]) !!}

                                            {{ Form::hidden('availability_id', $pm->id, ['id'=>'pmId']) }}
                                            {{ Form::hidden('user_id', $author->id) }}

                                             <div class="text-center font20" style="margin-top: 20px;">
                                                 <strong>Adviser Locations</strong>
                                             </div>
                                             <div class="container" style="margin-top: 20px;">
                                                @foreach($author->locations as $location)
                                                 <div class="row preferBdr" style="padding:6px;margin-top:10px ">
                                                     <b>{{$location->address}}, {{$location->city}} - {{$location->pin}}</b>
                                                     <input type="radio" style="float:right " name="location_id" value="{{$location->id}}" checked>
                                                 </div>
                                                @endforeach
                                             </div>
                                            <div class="container" style="margin-top: 20px;">
                                                 <div class="preferBdr">
                                                 <div class="col-lg-12">

                                                      <div class="col-lg-4">
                                                         <div class="card" style="border:1px solid gray;margin-top:10px;">
                                                        <div class="card-header dateHeader"><b>Date</b></div>
                                                        <div class="card-body " style="padding: 7px;">
                                                            {{ Form::date('date', null, ['class' => 'form-control', 'id'=>'pmd', 'required'=>'', 'min'=>Carbon\Carbon::today()->format('Y-m-d')]) }}
                                                            </div>
                                                     </div>
                                                     </div>

                                                      <div class="col-lg-8">
                                                        <div class="card" style="border:1px solid gray;margin-top:10px;">
                                                            <div class="card-header dateHeader"><b>Time</b></div>
                                                            <div class="card-body row" id="pmt">

                                                            </div>
                                                        </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             </div>

                                             {{ Form::hidden('total_pay', $pm->consultation_fee) }}

                                            <div class="col-lg-12 text-center ">
                                              <button class="btn btn-primary mt10" onclick="document.getElementById({{ $pm->id }}).submit();">BOOK APPOINTMENT</button>
                                            </div>

                                            {!! Form::close() !!}
                                            </div>
                                        </div>
                                     </div>



                                  </div>
                                </div>
                              </div>

                              <div class="row mt30">
                                @foreach($blogs as $blog)
                                  <div class="col-lg-3">
                                      <div class="itemblog">
                                          <div class="text-center">
                                              @if($blog->featured_image)
                                              <img class="wd100" src="{{asset('posts/'.$blog->featured_image)}}" />
                                              @else
                                               <img style="width:180px;height:150px" src="{{asset('website/images/Rectangle.png')}}" />
                                              @endif
                                              @if($blog->user->basicDetail->image)
                                              <img class="mtn35 img-circle" style="width:78px" src="{{asset('images/'.$blog->user->basicDetail->image)}}" />
                                              @else
                                              <img class="mtn35 img-circle" style="width:78px" src="{{asset('images/user.png')}}" />
                                              @endif
                                          </div>
                                          <div class="text-center">
                                              <p>
                                                @if($blog->user->basicDetail->gender == 'M')
                                                Mr.
                                                @else
                                                Ms.
                                                @endif
                                                  {{ $blog->user->basicDetail->firstname }} {{ $blog->user->basicDetail->lastname }}
                                              </p>
                                              <p>
                                                  <strong>{{ $blog->title }}</strong>
                                              </p>
                                          </div>
                                          <div>
                                              {!! substr(strip_tags($blog->body), 0, 50) !!} {!! strlen(strip_tags($blog->body)) > 50 ? "..." : "" !!}
                                          </div>
                                          <div class="text-center mt10"><i class="fa fa-eye" aria-hidden="true"></i> <strong>1599</strong> | <i class="fa fa-heart clrred" aria-hidden="true"></i> <strong>{{ $blog->likes->count()}}</strong> | <i class="fa fa-comments-o" aria-hidden="true"></i> <strong>{{ $blog->comments->count() }}</strong> </div>
                                          <div class="text-center mb15 mt15">
                                              <a href="{{route('blog-posts.show',$blog->id)}}"><img src="{{asset('website/images/readmorebtn.png')}}" /></a>
                                          </div>
                                      </div>
                                  </div>
                                 @endforeach
                              </div>

                <div class="row ">
                  <div class="col-md-12 pad10" style="background: #f5f5f5;">
                  <div class="pull-left col-md-12">
                  <strong class="font20">Rating and Review</strong>
                  </div>
                  <div  class="col-md-4 mt10">
                    <strong class="font20">3.5/5</strong><br>
                    <img src="{{asset('website/images/adviserratting.png')}}" style="width:25%;"  /><br>
                    <strong>Total Ratings</strong><br>
                    <strong class="font20">3455</strong>
                  </div>
                   <div  class="col-md-4" style="border-left:1px solid #8a7f7f;">
                    <img src="{{ asset('website/images/like.png') }}" /> <strong class="font20">{{App\Models\Page\AuthorLike::where('author_id',$author->id)->count()}}</strong><br>
                  </div>
                   <div  class="col-md-4 text-center" style="border-left:1px solid #8a7f7f;">
                      @if(Auth::user())
                      @if($rcount > 0)
                        <p>Want to give a review / feedback?</p><br>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ratingModel" href="#">Review</a>
                       @endif
                       @endif
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 pad10">
                    <strong class="font20">Customer Reviews</strong>
                    <hr>
                    <div class="col-md-12">
                     @if($ratings->count() > 0)
                      @foreach($ratings as $rating)
                      @if($rating->review)
                      <div class="row">
                        <div class="col-md-1">
                          @if($rating->user->basicDetail->image)
                            <img src="{{ asset('images/' .$rating->user->basicDetail->image) }}" style="width:80px">
                          @else
                            <img src="{{ asset('images/user.png') }}" style="width:80px">
                          @endif
                        </div>
                        <div class="col-md-10">
                            <small>{{$rating->rating}} <i class="fa fa-star" style="color:yellow"></i></small>
                          <strong>by : </strong><a>{{$rating->user->basicDetail->firstname}} {{$rating->user->basicDetail->lastname}}</a> <small>on {{date('j M Y', strtotime($rating->created_at))}}</small>
                          <p>{{ $rating->review }}</p>
                        </div>
                        <div class="col-md-1">
                        </div>
                      </div>
                      @endif
                      <hr>
                      @endforeach
                      @endif
                    </div>
                  </div>
                </div>

                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="services">

                                            <div class="row">
                                              <div class="col-md-12">
                                                 <div class="pull-left">
                                                   <button class="btn btn-success"><strong>SELECTED</strong>
                                                      <small id="total"></small>
                                                    </button>
                                                 </div>
                                                 <div class="pull-right">
                                                      <button id="btnGetSelectedServices" class="btn btn-success" data-target="#loginModal" data-toggle="modal" style="display:none">PROCEED TO PAY</button>
                                                 </div>
                                              </div>
                                            </div>

                                        <hr>
                                        <div class="row">
                                          @foreach($author->services as $service)
                           <div class="col-md-offset-1 col-lg-4">
                                <div class="box box-default" style="border-top-color: #5a8dff;">
                                    <div class="box-header serbg with-border heading">
                                        <label> <input type="checkbox" name="services[]" value="{{ $service->id }}">
                            {{ $service->name }}</label>
                                    </div>
                                    <!-- ng-repeat start here -->
                                    <div class="box-body" style="padding: 25px;">
                                        <label class="pull-left">About Service / Package</label>
                                        <div class="imageContainer">
                                            <img src="{{asset('website/images/offer-bench.png')}}" />
                                        <span>25% Off</span></div>
                                        <ul style="margin-top:-24px!important">
                                            <li>
                                                  <p>{{ $service->details }}</p>
                                            </li>
                                        </ul>

                                        <label>Feature/Benifits of the Package</label>
                                        <ul>
                                            <li>
                                               @foreach($service->benifits as $benifit)
                                                <p>{{ $benifit->benifit }}</p>
                                              @endforeach
                                            </li>
                                        </ul>

                                        <label>Package Includes</label>
                                        <ul>
                                            <li>
                                               @foreach($service->packages as $package)
                                                <p>{{ $package->include }}</p>
                                              @endforeach
                                            </li>
                                        </ul>

                                        <label class="pull-left mr10">Service Time Duration:</label>
                                        <p>30 Min</p>
                                        <label class="pull-left mr10">Validity:</label>
                                        <p>{{ $service->validity }} days</p>
                                        <label class="pull-left mr10">Frequency:</label>
                                        <p>{{ $service->frequency }}</p>
                                        <label class="pull-left mr10">Price(INR):</label>
                                        <p>@if($service->commision)
                              <span style='text-decoration:line-through'>INR {{ $service->payout }}/-</span> INR {{ $service->payout }}/-
                              @else
                              INR {{ $service->payout }}/-
                              @endif</p>
                                    </div>
                                    <div class="box-footer servfooter">
                                         <img src="{{asset('website/images/adviserratting.png')}}" style="width:25%;"  />
                                        <a class="footercontent"  href="">
                                          <a  class="btn btn-primary pull-right" data-toggle="modal" data-target="#service{{$service->id}}" name="">View
                                        </a>

                                        <!-- View Service Modal -->
                                        <div class="modal fade" id="service{{$service->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content" style="top:-110px">
                                                        <div class="modal-header" style="background:#1189f1;color: white;">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title" >{{$service->name}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <strong>About Service / Package</strong>
                                                                        <p>{{$service->details}}</p>
                                                                        <strong class="mt10">Feature of this Package:</strong>
                                                                        <ul>
                                                                          @foreach($service->benifits as $benifit)
                                                                           <li>{{ $benifit->benifit }}</li>
                                                                         @endforeach
                                                                        </ul>
                                                                         <strong class="mt10">Expected outcomes of the Package:</strong>
                                                                         @foreach($service->packages as $package)
                                                                          <p>{{ $package->include }}</p>
                                                                        @endforeach
                                                                        <div class="col-md-12 viewservice mt10" >
                                                                          <div class="col-md-4">
                                                                              <strong>Frequency : </strong><span>{{$service->frequency}}</span>
                                                                          </div>
                                                                          <div class="col-md-4">
                                                                              <strong>Validity : </strong><span>{{$service->validity}} days</span>
                                                                          </div>
                                                                          <div class="col-md-4">

                                                                              <strong>Price : </strong>
                                                                              <span>
                                                                                <p>@if($service->commision)
                                                                      <span style='text-decoration:line-through'>INR {{ $service->payout }}/-</span> INR {{ $service->payout }}/-
                                                                      @else
                                                                      INR {{ $service->payout }}/-
                                                                      @endif</p>
                                                                              </span>
                                                                          </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        <!-- View Service Modal -->
                                    </div>
                                </div>
                            </div>
                    @endforeach
                                        </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="qa">

                                          <div class="row">
                                            <div class="col-md-12">

                                                 <div class="mt30">
                @foreach($author->answers as $answer)
                <div class="wrap ">
                    <div class="row">
                        <div class="col-md-4 bdrlft">
                            <div class="text26  w500">
                                <p>Asked by :
                                  @if($answer->ask->show_name == '1')
                                  {{ $answer->ask->user->basicdetail->firstname }} {{ $answer->ask->user->basicdetail->lastname }}
                                  @else
                                  Unknown
                                  @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 bdrlft">
                            <div class="text26  w500">
                                <img src="{{asset('website/images/time.png')}}" class="pull-left pdr15" /><p> {{ date('jS M Y', strtotime($answer->ask->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text26  w500">
                                <img src="{{asset('website/images/location.png')}}" class="pull-left pdr15" />  <p>{{$answer->user->locations->first()->city}}</p>
                            </div>
                        </div>

                    </div>
                    <div class="q mt20">
                        <a href="{{route('asks.questions.show', $answer->ask->id)}}"><span>Q. {{$answer->ask->question}} </span></a>
                    </div>
                    <div class="a mt10">
                        <span>
                            {!! substr(strip_tags($answer->answer), 0, 200) !!}{!! strlen(strip_tags($answer->answer)) > 200 ? '...' : '' !!}
                            <a href="{{route('asks.questions.show', $answer->ask->id)}}">read more</a>
                        </span>
                    </div>
                    <div class="row mt30">
                        <div class="col-md-2">
                            <div class="text20 text-center w500 bdrlft">
                                <b><i class="fa fa-reply" style="color:#00a65a" aria-hidden="true"></i>12</b>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text20 text-center w500 bdrlft">
                                <b><i class="fa fa-thumbs-up" style="color:#3c8dbc" aria-hidden="true"></i>{{$answer->likes->count()}}</b>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text20 text-center w500 bdrlft">
                                <b><i class="fa fa-commenting-o" aria-hidden="true"></i>{{$answer->comments->count()}}</b>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text20 text-center w500 ">
                                <b><i class="fa fa-eye" style="color:#337ab7" aria-hidden="true"></i>125</b>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
                                            </div>
                                          </div>

                                        </div>

                                    </div>
                                </div>
                                </div>


  </div>
</div>

</div>


    <div class="modal fade" id="ratingModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    @if(isset(Auth::user()->clientDetail->image))
                      <img src="{{ asset('images/' .Auth::user()->clientDetail->image) }}" class="im-circle" style="width:50px">
                      @else
                        <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:50px">
                     @endif
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12" style="text-decoration:none">

                                    @if(Auth::user()->ratings()->where('adviser_id', $author->id)->first())

                                    {!! Form::model(Auth::user()->ratings()->where('user_id',$author->id)->first(), ['route' => ['rating.update', Auth::user()->ratings()->where('adviser_id',$author->id)->first()->id], 'method' => 'PUT']) !!}
                                      <div class="stars">
                                        <input class="star star-5" id="star-5" type="radio" name="star" value='5'/ {{Auth::user()->ratings()->where('adviser_id',$author->id)->first()['rating'] == 5?'checked':''}}>
                                        <label class="star star-5" for="star-5"></label>
                                        <input class="star star-4" id="star-4" type="radio" name="star" value='4'/ {{Auth::user()->ratings()->where('adviser_id',$author->id)->first()['rating'] == 4?'checked':''}}>
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="star star-3" id="star-3" type="radio" name="star" value='3'/ {{Auth::user()->ratings()->where('adviser_id',$author->id)->first()['rating'] == 3?'checked':''}}>
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="star star-2" id="star-2" type="radio" name="star" value='2'/ {{Auth::user()->ratings()->where('adviser_id',$author->id)->first()['rating'] == 2?'checked':''}}>
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="star star-1" id="star-1" type="radio" name="star" value='1'/ {{Auth::user()->ratings()->where('adviser_id',$author->id)->first()['rating'] == 1?'checked':''}}>
                                        <label class="star star-1" for="star-1"></label>
                                      </div> <br>
                                      {{ Form::text('review', Auth::user()->ratings()->where('adviser_id',$author->id)->first()['review'], ['class' =>'form-control', 'placeholder' =>'Write a review']) }}

                                     <div class="text-center" style="margin-top:20px">
                                          {{ Form::submit('submit', ['class' => 'btn btn-success']) }}
                                          <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        </div>

                                    {!! Form::close() !!}

                                    @else

                                    {!! Form::open(['route' => ['rating.store'], 'method' => 'POST']) !!}
                                      {{ Form::hidden('adviserId', $author->id) }}
                                      <div class="stars">
                                        <input class="star star-5" id="star-5" type="radio" name="star" value='5'/>
                                        <label class="star star-5" for="star-5"></label>
                                        <input class="star star-4" id="star-4" type="radio" name="star" value='4'/>
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="star star-3" id="star-3" type="radio" name="star" value='3'/>
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="star star-2" id="star-2" type="radio" name="star" value='2'/>
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="star star-1" id="star-1" type="radio" name="star" value='1'/>
                                        <label class="star star-1" for="star-1"></label>
                                      </div> <br>
                                      {{ Form::text('review', null, ['class' =>'form-control', 'placeholder' =>'Write a review']) }}

                                       <div class="text-center" style="margin-top:20px">
                                          {{ Form::submit('submit', ['class' => 'btn btn-success']) }}
                                          <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        </div>

                                    {!! Form::close() !!}

                                  @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!--Chat Modal-->
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="chatModal" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header" style="background-color:#1189f1">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Chat Fees: Rs {{$chat->consultation_fee}}/- Per slot</h4>
</div>
<div class="modal-body">
    <div class="row">
    {!! Form::open(['route' => ['booking.consultation'], 'method' => 'POST', 'id' => $chat->id]) !!}
    <input type="hidden" name="_token" value="{!!csrf_token()!!}">

    {{ Form::hidden('availability_id', $chat->id, ['id'=>'chatId']) }}
    {{ Form::hidden('user_id', $author->id) }}

     <div class="col-lg-12">
         <div class="col-lg-4">
         <div class="card" style="border:1px solid gray;margin-top:10px;">
            <div class="card-header dateHeader"><b>Date</b></div>
            <div class="card-body " style="padding: 7px;">
              {{ Form::date('date', null, ['class' => 'form-control', 'id'=>'chatd', 'required'=>'', 'min'=>Carbon\Carbon::today()->format('Y-m-d')]) }}
            </div>
         </div>
         </div>
         <div class="col-lg-8">
            <div class="card" style="border:1px solid gray;margin-top:10px;">
                <div class="card-header dateHeader"><b>Time</b></div>
                <div class="card-body row" id="chatt">
                  </div>
            </div>
         </div>
     </div>

     {{ Form::hidden('total_pay', $chat->consultation_fee) }}

    <div class="col-lg-12 text-center ">
      <button class="btn btn-primary mt10" onclick="document.getElementById({{ $chat->id }}).submit();">BOOK APPOINTMENT</button>
    </div>
    {!! Form::close() !!}


    </div>
</div>
</div>
</div>
</div>








<!--Service Booking Modal-->
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="loginModal" tabindex="-1">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Service Booking Details</h4>
</div>
 {!! Form::open(['route' => ['booking.service'], 'method' => 'POST']) !!}
<div class="modal-body">
 <div class="form-group">
    {{ Form::hidden('user_id', $author->id)}}
    <div id="doit"></div>
   {{ Form::label('availability_id', 'Mode Of Service') }}
   <select name="availability_id" class="form-control" id="sId">
     @foreach($author->availabilities as $availability)
     <option value="{{ $availability->id }}">{{ $availability->consultation_mode }}</option>
     @endforeach
   </select>

     <select name="location_id" class="form-control mt20">
        <option value="">-- CHOOSE LOCATION --</option>
       @foreach($author->locations as $location)
       <option value="{{ $location->id }}">{{ $location->address }}</option>
       @endforeach
     </select>
 </div>

  <div class="form-group">
        <div class="row" style="margin-top:20px;">
        <div class="col-lg-12" style="margin-top: 20px;">
            <div class="col-lg-4">
            <div class="card" style="border:1px solid gray">
                <div class="card-header dateHeader"><b>Date</b></div>
                <div class="card-body" style="height: 42px;">
                    {{ Form::date('date', null, ['class' => 'form-control', 'id'=>'sd', 'style' => 'margin-top: 8px;', 'required' => '', 'min'=>Carbon\Carbon::today()->format('Y-m-d')]) }}
                </div>
             </div>
             </div>
             <div class="col-lg-8">
                <div class="card" style="border:1px solid gray">
                    <div class="card-header dateHeader"><b>Time</b></div>
                    <div class="card-body row" id="st">

                    </div>
                </div>
             </div>
        </div>
        </div>
 </div>
</div>
<div class="modal-footer">
{{ Form::submit('BOOK APPOINTMENT', ['class' => 'btn btn-primary btn-sm']) }}
<button class="btn btn-default btn-sm" data-dismiss="modal" onclick="window.location = '{{route('author.show', $author->id)}}'">Cancel</button>
</div>
{!! Form::close() !!}
</div>
</div>
</div>


@endsection

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>-->
<!--<script type="text/javascript">-->

<!-- </script>-->



  <script src="{{asset('Content/jquery.min.js')}}"></script>
 <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script type="text/javascript">

  $(document).ready(function(){

    var $checkboxes = $('input[type="checkbox"]');
   $checkboxes.change(function(){
       var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
       var countservices = "(you have added " + countCheckedCheckboxes  + " services)";
       $('#total').text(countservices);
       if(countCheckedCheckboxes > 0){
         $("#btnGetSelectedServices").css("display", "block");
       } else {
         $("#btnGetSelectedServices").css("display", "none");
         $("#doit").remove();
       }
   });

    $('#btnGetSelectedServices').click(function(){
      getCheckedCheckBoxes();
    });

    var getCheckedCheckBoxes = function(){
      var result = $('input[type="checkbox"]:checked');
      if(result.length > 0){
        var resultString = result.length + " checkboxes checked<br/>";
        var service2id = [];
        result.each(function(){
          resultString += $(this).val() + "<br/>";
          service2id.push($(this).val()) ;
        $("#doit").append('<input type="text" value="'+$(this).val()+'" name="services[]" style="display:none">');
        });

        $('#divResult').html(resultString);
        $('#ir').val(service2id);
        $('#sids').val(service2id);
      }
      else {
        $('#divResult').html("No checkbox checked");
      }

    };

  });
</script>


<script src="{{asset('js/jssor.slider-26.3.0.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_options = {
              $AutoPlay: 1,
              $AutoPlaySteps: 5,
              $SlideDuration: 160,
              $SlideWidth: 200,
              $SlideSpacing: 3,
              $Cols: 5,
              $Align: 390,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $Steps: 5
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <script>
        var date = new Date();
$(function () {
    $('#datefield').text(date.toDateString());

    $('#prev').click(function () {
        date.setDate(date.getDate() - 1);
        $('#datefield').text(date.toDateString())
    });
    $('#next').click(function () {
        date.setDate(date.getDate() + 1);
        $('#datefield').text(date.toDateString())
    });


    $('#sd').on('change', function(e){
     var sd = e.target.value;
     var sId = $('#sId').val();
     $.get('http://testserver.adviceli.com/public/newTime?fsd=' + sd +'&fsId='+ sId, function(data){
       $('#st').empty();
       $.each(data, function(index, fsObj){
       $('#st').append('<div class="col-lg-6"><div class="timeSlot "><label style="padding:4px;"><input type="radio" name="time" value="'+fsObj.time_from+'" checked>'+ fsObj.time_from +' - '+ fsObj.time_to +' </label></div></div>')
       });
     });
   });

   $('#pcd').on('change', function(e){
     var pcd = e.target.value;
     var pcId = $('#pcId').val();
     $.get('http://testserver.adviceli.com/public/newTime?fsd=' + pcd +'&fsId='+ pcId, function(data){
       $('#pct').empty();
       $.each(data, function(index, fsObj){
       $('#pct').append('<div class="col-lg-4"><div class="timeSlot "><label style="padding:4px;"><input type="radio" name="time" value="'+fsObj.time_from+'" checked>'+ fsObj.time_from +' - '+ fsObj.time_to +' </label></div></div>')
       });
     });
   });

   $('#vcd').on('change', function(e){
     var vcd = e.target.value;
     var vcId = $('#vcId').val();
     $.get('http://testserver.adviceli.com/public/newTime?fsd=' + vcd +'&fsId='+ vcId, function(data){
       $('#vct').empty();
       $.each(data, function(index, fsObj){
       $('#vct').append('<div class="col-lg-4"><div class="timeSlot "><label style="padding:4px;"><input type="radio" name="time" value="'+fsObj.time_from+'" checked>'+ fsObj.time_from +' - '+ fsObj.time_to +' </label></div></div>')
       });
     });
   });

   $('#pmd').on('change', function(e){
     var pmd = e.target.value;
     var pmId = $('#pmId').val();
     $.get('http://testserver.adviceli.com/public/newTime?fsd=' + pmd +'&fsId='+ pmId, function(data){
       $('#pmt').empty();
       $.each(data, function(index, fsObj){
       $('#pmt').append('<div class="col-lg-4"><div class="timeSlot "><label style="padding:4px;"><input type="radio" name="time" value="'+fsObj.time_from+'" checked>'+ fsObj.time_from +' - '+ fsObj.time_to +' </label></div></div>')
       });
     });
   });

   $('#chatd').on('change', function(e){
     var chatd = e.target.value;
     var chatId = $('#chatId').val();
     $.get('http://testserver.adviceli.com/public/newTime?fsd=' + chatd +'&fsId='+ chatId, function(data){
       $('#chatt').empty();
       $.each(data, function(index, fsObj){
       $('#chatt').append('<div class="col-lg-4"><div class="timeSlot "><label style="padding:4px;"><input type="radio" name="time" value="'+fsObj.time_from+'" checked>'+ fsObj.time_from +' - '+ fsObj.time_to +' </label></div></div>')
       });
     });
   });


});
    </script>

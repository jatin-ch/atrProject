@extends('layouts.website')
@section('content')

<!--<link href="{{asset('css/website.css')}}" rel="stylesheet" type="text/css">-->
<style>
    .tabSty{
      border: 1px solid #d8d4d4;
      text-align: center;
      padding: 10px;
      background: white;
    }
    .tabSty a{
      font-size: 14px;
      font-weight: 600;
      color: black!important;
    }
    .tabSty a:hover{
      color: #3c8dbc!important;
    }
</style>
<div class="container-fluid mt30>

       <div class="row">
           <div class="col-lg-3">
               <ul id='nav'>
                   <h4 class="submenu">Category</h4>
                   @foreach($categories as $category)
                   <li class='button'>
                       <a href="{{route('advisers-category.index', $category->slug)}}"> <img src="{{asset('website/images/menuimg.png')}}" /> <span style="text-transform:capitalize"> {{ $category->name }} </span></a>
                       <ul class="zindex">
                           <li>
                             <div class="col-lg-6" style="padding: 20px;">
                                 <h4 class="submenu">EXPERTISE</h4>
                                 @foreach($category->subcategories as $subcategory)
                                 <form action="{{route('filter', $category->slug)}}", method="POST" role="search" id="sbCatform1{{$subcategory->id}}">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="brands[]" value="{{$subcategory->name}}">
                                 <a onclick='document.getElementById("sbCatform1{{$subcategory->id}}").submit();' style="text-transform:capitalize;cursor:pointer;line-height: 1;">{{ $subcategory->name }}</a>
                                 </form>
                                 @endforeach
                                 <a style="color:#3c8dc2!important" href="{{route('advisers-category.index', $category->slug)}}">View All ></a>
                                 <h4 class="submenu">QUALIFICATION</h4>
                                 @foreach($category->qualifications as $qualification)
                                 <form action="{{route('filter', $category->slug)}}", method="POST" role="search" id="sbCatform2{{$subcategory->id}}">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="qfs[]" value="{{$qualification->name}}">
                                 <a onclick='document.getElementById("sbCatform2{{$subcategory->id}}").submit();' style="cursor:pointer">{{ $qualification->name }}</a>
                                 </form>
                                 @endforeach
                                 <a style="color:#3c8dc2!important" href="{{route('advisers-category.index', $category->slug)}}">View All ></a>
                             </div>
                               <div class="col-lg-6" style="border-left: 2px solid #bdb9b9;padding: 20px;">
                                   <h4 class="submenu">ORGANIZATION/ OFFICE</h4>
                                   <a href="#">Medanta</a>
                                   <a href="#">AIIMS</a>
                                   <a href="#">Fortis</a>
                                   <a href="#">Appllo</a>
                                   <a href="#">Medanta</a>
                                   <a href="#">AIIMS</a>
                                   <a style="color:#3c8dc2!important" href="#">View All ></a>
                                   <h4 class="submenu">LOCATION</h4>
                                   <a href="#">Delhi</a>
                                   <a href="#">Gurgaon</a>
                                   <a href="#">Chennai</a>
                                   <a href="#">Banglore</a>
                                   <a href="#">Mumbai</a>
                                   <a href="#">Kolkata</a>
                                   <a style="color:#3c8dc2!important" href="{{route('advisers-category.index', $category->slug)}}">View All ></a>
                               </div>
                                <!--<div class="col-lg-4" style="border-left: 2px solid #bdb9b9;padding: 20px;">-->
                                <!--    <img src="{{asset('website/images/menuimage.jpg')}}" />-->
                                <!--</div>-->
                           </li>
                       </ul>
                   </li>
                   @endforeach
               </ul>
           </div>
           <div class="col-lg-9">
               <div class="tab">

                   <div class="col-lg-2 tabSty">
                           <a href="{{ route('blog-posts.index') }}"> Blog</a>
                   </div>
                       <div class="col-lg-4 tabSty">
                           <a data-toggle="modal" data-target="#companysignup" href="#">Register As An Organization/Company</a>
                       </div>

                      <div class="col-lg-3 tabSty">
                           <a data-toggle="modal" data-target="#expertsignup" href="#"> Register As An Expert</a>
                       </div>
                     <div class="col-lg-3 tabSty">
                           <a href="#"> Suggest Adviceli to Your Adviser</a>
                      </div>

               </div>

               <div class="container-fluid" style="padding:0!important;margin-top: 44px;">
                   <div id="myCarousel" class="carousel slide" data-ride="carousel">
                       <!-- Indicators -->
                       <ol class="carousel-indicators" style="margin-bottom:40px;">
                           <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                           <li data-target="#myCarousel" data-slide-to="1"></li>
                           <li data-target="#myCarousel" data-slide-to="2"></li>
                       </ol>

                       <!-- Wrapper for slides -->
                       <div class="carousel-inner" >
                           <div class="item active">
                               <img src="{{asset('website/images/banner.jpg')}}" alt="Los Angeles">
                           </div>

                           <div class="item">
                               <img src="{{asset('website/images/banner.jpg')}}" alt="Chicago">
                           </div>

                           <div class="item">
                               <img src="{{asset('website/images/banner.jpg')}}" alt="New york" >
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-lg-9 mt15 item" style="margin-left: 15px;">
                           <p><strong>Q. Are sore things normal during pregnancy ?</strong></p>
                           <p>
                           Is it typical for women to have sort thighs when they are pregnant? I am 26 and pregnant with my first child, so i don't really know what to expect, but my thighs are extremely tender when I stand or walk .Is it typical for women to have sort thighs when they are pregnant? I am 26 and pregnant with my first child, so i don't really know what to expect, but my thighs are extremely tender when I stand or walkIs it typical for women to have sort thighs when they are pregnant? I am 26 and pregnant with my first child, so i don't really know what to expect, but my thighs are extremely tender when I stand or walk
                           .What shoud....
                           <a href=""><strong class="clrgreen ml10">show answer</strong></a>
                           </p>

                              <div class="col-lg-12">
                               <span>Asked by : Asha Negi | <i class="fa fa-clock-o" aria-hidden="true"></i> 25th June 2017 | <i class="fa fa-map-marker" aria-hidden="true"></i> Mumbai</span>
                             </div>
                             <div class="col-lg-6">
                               <a href=""><img class="pull-left crsr" src="{{asset('website/images/prevbtn.png')}}" /></a>
                           </div>
                              <div class="col-lg-6">
                               <a href=""><img class="pull-right crsr" src="{{asset('website/images/nextbtn.png')}}" /></a>
                           </div>

                       </div>
                       <div class="col-lg-1 text-center">
                           <a href="{{route('asks.questions')}}"><img class="crsr" style="margin-top: 95px;" src="{{asset('website/images/askbtn.png')}}" /></a>
                       </div>
                   </div>
               </div>
           </div>
           <div class="container mt30 item1">
               <div class="row">
                   <div class="col-lg-12 text-center">
                       <h3><strong class="bb">HOW ITS WORKS ?</strong></h3>
                   </div>

               </div>
               <div class="row mt30">
                   <div class="col-lg-6 text-center crblue clrwhite" style="padding:10px;font-size:20px"><a href="#" id="usertab"> User</a></div>
                   <div class="col-lg-6 text-center bgwhite" style="padding:10px;font-size:20px"><a href="#" id="advisortab"> Advisor</a></div>
               </div>

               <div id="user" class="row mt30 mb30">
                   <div class="col-lg-6">
                       <div class="mt10">
                           <img class="img-responsive" src="{{asset('website/images/searchblock.png')}}" />
                       </div>
                       <div class="mt10">
                           <img class="img-responsive" src="{{asset('website/images/selectblock.png')}}" />
                       </div>
                       <div class="mt10">
                           <img class="img-responsive" src="{{asset('website/images/scheduleblock.png')}}" />
                       </div>
                       <div class="mt10">
                           <img class="img-responsive" src="{{asset('website/images/connect block.png')}}" />
                       </div>


                   </div>
                   <div class="col-lg-6">
                   <iframe width="90%" height="399" src="https://www.youtube.com/embed/9oFQzvPUzeU" frameborder="0" gesture="media" allowfullscreen></iframe>
                       <!-- <img style="width:90%" src="{{asset('website/images/laptopimg.png')}}" /> -->
                   </div>

               </div>
               <div id="advisor" class="row mt30 mb30" style="display:none;">
                   <div class="col-lg-6">
                       <div class="mt10">
                           <img class="img-responsive" src="{{asset('website/images/signup.png')}}" />
                       </div>
                       <div class="mt10">
                           <img class="img-responsive" src="{{asset('website/images/live.png')}}" />
                       </div>
                       <div class="mt10">
                           <img class="img-responsive" src="{{asset('website/images/appointment.png')}}" />
                       </div>
                       <div class="mt10">
                           <img class="img-responsive" src="{{asset('website/images/connect.png')}}" />
                       </div>


                   </div>
                   <div class="col-lg-6">
                       <!-- <img style="width:90%" src="{{asset('website/images/laptopimg.png')}}" /> -->
                       <iframe width="90%" height="399" src="https://www.youtube.com/embed/9oFQzvPUzeU" frameborder="0" gesture="media" allowfullscreen></iframe>
                   </div>

               </div>
           </div>
           <div class="container">
               <div class="row">
                   <div class="col-lg-12 text-center">
                       <span class="bb">BLOGS</span>
                   </div>
               </div>
               <div class="row mt30">

                   <div id="blogs" class="col-lg-12 text-center" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="{{ asset('website/img/spin.svg') }}" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:10px;left:70px;width:1300px;min-height:500px;overflow:visible!important;">
        <!-- Any HTML Content Here -->
      @foreach($blogs as $blog)
                   <div class="col-lg-3" style="position: relative; top: 125px; left: 245px!important; margin-top:10px; overflow: unset;">
                       <div class="itemblog">
                           <div class="text-center">
                                 @if($blog->featured_image)
                               <img class="wd85" src="{{asset('posts/'.$blog->featured_image)}}" />
                               @else
                               <img class="wd85" style="height:180px;" src="{{asset('website/images/Rectangle.png')}}"  />
                               @endif

                               @if($blog->user->basicDetail->image)
                               <img class="mtn35 img-circle" style="width:30%" src="{{asset('images/'.$blog->user->basicDetail->image)}}" />
                               @else
                               <img class="mtn35 img-circle" style="width:30%" src="{{asset('images/user.png')}}" />
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
                                   <strong>{{substr($blog->title,0,40) }}
                                   ...
                                   </strong>
                               </p>
                           </div>
                           <div>
                               {!! substr(strip_tags($blog->body), 0, 40) !!} {!! strlen(strip_tags($blog->body)) > 40 ? "..." : "" !!}
                           </div>
                           <div class="text-center mt10"><i class="fa fa-eye" aria-hidden="true"></i> <strong>1599</strong> | <i class="fa fa-heart clrred" aria-hidden="true"></i> <strong>{{ $blog->likes->count()}}</strong> | <i class="fa fa-comments-o" aria-hidden="true"></i> <strong>{{ $blog->comments->count() }}</strong> </div>
                           <div class="text-center mb15 mt15">
                               <a href="{{route('blog-posts.show',$blog->id)}}"><img src="{{asset('website/images/readmorebtn.png')}}" /></a>
                           </div>
                       </div>
                   </div>
                  @endforeach

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
               </div>
               <div class="text-center mt30">
                   <a href="{{route('blog-posts.index')}}" class="btn btn-success" style="border-radius: 0px!important;">View All Blogs</a>

               </div>
           </div>
       </div>
       <div>
           <div class="row mt30 bgblue">
               <div class="col-lg-6 mtb50">
                   <img src="{{asset('')}}website/images/says.png" />
               </div>
               <div class="col-lg-6 mtb50">
                   <div class="col-lg-4 text-center brdrright">
                       <img src="{{asset('')}}website/images/saysimg.png" />
                       <p class="clrwhite mt10"><strong>ARUN NAYAK</strong></p>
                   </div>
                   <div class="col-lg-8">
                       <h4 class="clrwhite">Thanks for your guidance</h4>
                       <p class="clrwhite">
                           I was misguided from a local doctor since 1 year which affect my health issues. Its been really helpful for me to choose right checkups & medicines. Thanks Adviseli to giving us such a lovely platform where we can find all the solution of our problems.
                       </p>
                       <img src="{{asset('website/images/rating.png')}}" />
                   </div>
               </div>

           </div>
           <div class="row mt30">
               <div class="col-lg-12 text-center">
                   <span class="bb">POPULAR ADVISERS</span>
               </div>
           </div>
           <div class="row mt30">
            <div id="advisers" class="col-lg-12 text-center" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="{{ asset('website/img/spin.svg') }}" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:10px;left:70px;width:1300px;min-height:450px;overflow:visible!important;">
        <!-- Any HTML Content Here -->
                  <div class="col-lg-3" style="position: relative; top: 125px; left: 245px!important; margin-top:30px; overflow: unset;">

                   <div class="row">
                       <div class="col-lg-12" style="margin-top:30px;">
                           <div class="itemblog">
                               <div class="text-center">

                                   <img class="mtn35 docimg" src="{{asset('website/images/blogusr.png')}}" />

                               </div>
                               <div class="text-center"><img src="{{asset('website/images/adviserratting.png')}}" /></div>
                               <div class="row mt10" style="margin:0px;">

                                   <div class="col-lg-5" style="text-align:left">
                                       Advisor Name
                                       <br />
                                       Designation
                                       <br />
                                       Experties
                                       <br />
                                       Experience
                                       <br />
                                       Location
                                       <br />
                                       Fees
                                   </div>
                                   <div class="col-lg-7" style="text-align:left">
                                       : Dr. Neetu Sharma
                                       <br />
                                       : HOD (Oncology)
                                       <br />
                                       : Oncology (Cancer)
                                       <br />
                                       : 10 yrs.
                                       <br />
                                       : Gurugram, Haryana
                                       <br />
                                       : Rs.1000/-

                                   </div>

                               </div>
                               <div class="text-center mt30">
                                   <a href="#">
                                   <img  src="{{asset('website/images/viewadvbtn.png')}}" />
                                   </a>
                              </div>
                           </div>

                       </div>

               </div>

                   </div>

                   <div class="col-lg-3" style="position: relative; top: 125px; left: 245px!important; margin-top:30px; overflow: unset;">

                   <div class="row">
                       <div class="col-lg-12" style="margin-top:30px;">
                           <div class="itemblog">
                               <div class="text-center">

                                   <img class="mtn35 docimg" src="{{asset('website/images/blogusr.png')}}" />

                               </div>
                               <div class="text-center"><img src="{{asset('website/images/adviserratting.png')}}" /></div>
                               <div class="row mt10" style="margin:0px;">

                                   <div class="col-lg-5" style="text-align:left">
                                       Advisor Name
                                       <br />
                                       Designation
                                       <br />
                                       Experties
                                       <br />
                                       Experience
                                       <br />
                                       Location
                                       <br />
                                       Fees
                                   </div>
                                   <div class="col-lg-7" style="text-align:left">
                                       : Dr. Neetu Sharma
                                       <br />
                                       : HOD (Oncology)
                                       <br />
                                       : Oncology (Cancer)
                                       <br />
                                       : 10 yrs.
                                       <br />
                                       : Gurugram, Haryana
                                       <br />
                                       : Rs.1000/-

                                   </div>

                               </div>
                               <div class="text-center mt30">
                                   <a href="#">
                                   <img  src="{{asset('website/images/viewadvbtn.png')}}" />
                                   </a>
                              </div>
                           </div>

                       </div>

               </div>

                   </div>

                   <div class="col-lg-3" style="position: relative; top: 125px; left: 245px!important; margin-top:30px; overflow: unset;">

                   <div class="row">
                       <div class="col-lg-12" style="margin-top:30px;">
                           <div class="itemblog">
                               <div class="text-center">

                                   <img class="mtn35 docimg" src="{{asset('website/images/blogusr.png')}}" />

                               </div>
                               <div class="text-center"><img src="{{asset('website/images/adviserratting.png')}}" /></div>
                               <div class="row mt10" style="margin:0px;">

                                   <div class="col-lg-5" style="text-align:left">
                                       Advisor Name
                                       <br />
                                       Designation
                                       <br />
                                       Experties
                                       <br />
                                       Experience
                                       <br />
                                       Location
                                       <br />
                                       Fees
                                   </div>
                                   <div class="col-lg-7" style="text-align:left">
                                       : Dr. Neetu Sharma
                                       <br />
                                       : HOD (Oncology)
                                       <br />
                                       : Oncology (Cancer)
                                       <br />
                                       : 10 yrs.
                                       <br />
                                       : Gurugram, Haryana
                                       <br />
                                       : Rs.1000/-

                                   </div>

                               </div>
                               <div class="text-center mt30">
                                   <a href="#">
                                   <img  src="{{asset('website/images/viewadvbtn.png')}}" />
                                   </a>
                              </div>
                           </div>

                       </div>

               </div>

                   </div>

                   <div class="col-lg-3" style="position: relative; top: 125px; left: 245px!important; margin-top:30px; overflow: unset;">

                   <div class="row">
                       <div class="col-lg-12" style="margin-top:30px;">
                           <div class="itemblog">
                               <div class="text-center">

                                   <img class="mtn35 docimg" src="{{asset('website/images/blogusr.png')}}" />

                               </div>
                               <div class="text-center"><img src="{{asset('website/images/adviserratting.png')}}" /></div>
                               <div class="row mt10" style="margin:0px;">

                                   <div class="col-lg-5" style="text-align:left">
                                       Advisor Name
                                       <br />
                                       Designation
                                       <br />
                                       Experties
                                       <br />
                                       Experience
                                       <br />
                                       Location
                                       <br />
                                       Fees
                                   </div>
                                   <div class="col-lg-7" style="text-align:left">
                                       : Dr. Neetu Sharma
                                       <br />
                                       : HOD (Oncology)
                                       <br />
                                       : Oncology (Cancer)
                                       <br />
                                       : 10 yrs.
                                       <br />
                                       : Gurugram, Haryana
                                       <br />
                                       : Rs.1000/-

                                   </div>

                               </div>
                               <div class="text-center mt30">
                                   <a href="#">
                                   <img  src="{{asset('website/images/viewadvbtn.png')}}" />
                                   </a>
                              </div>
                           </div>

                       </div>

               </div>

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

               <div class="col-lg-12 text-center mt30">
                   <a href="{{route('advisers.index')}}" style="border-radius: 0px!important;" class="btn btn-success">View All Advisors</a>
               </div>
           </div>
           <div class="row mt30">
               <div class="col-lg-12 text-center">
                   <h3><strong class="bb">WHY ADVICELI ?</strong></h3>

               </div>
           </div>
           <div class="row mt30">
               <div class="col-lg-3">
                   <div class="bggreen">
                       <div class="text-center">
                           <img class="mt30" src="{{asset('website/images/adviserimg.png')}}" />
                       </div>

                       <div class="text-center mt30 clrwhite" style="padding:20px">
                           <h4 class="pb30">ADVICE FOR ALL YOUR QUERY</h4>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3">
                   <div class="bggreen">
                       <div class="text-center">
                           <img class="mt30" src="{{asset('website/images/expert.png')}}" />
                       </div>

                       <div class="text-center mt30 clrwhite" style="padding:20px">
                           <h4 class="pb30">VERIFIED EXPERTS</h4>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3">
                   <div class="bggreen">
                       <div class="text-center">
                           <img class="mt30" src="{{asset('website/images/3waycom.png')}}" />
                       </div>
                       <div class="text-center mt30 clrwhite" style="padding:20px">
                           <h4 class="pb30">3 WAY OF COMMUNICATION</h4>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3">
                   <div class="bggreen">
                       <div class="text-center">
                           <img class="mt30" src="{{asset('website/images/refund.png')}}" />
                       </div>

                       <div class="text-center mt30 clrwhite" style="padding:10px">
                           <h4 class="pb30">100% SECURE AND REFUNDABLE MONEY</h4>
                       </div>
                   </div>
               </div>
           </div>
           <div class="row mt30">
               <div class="col-lg-3">

               </div>
           </div>
       </div>
   </div>
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-6 bgblue brdrright">
               <div class="text-center mt15 clrwhite">
                   <h2>ADD YOUR ADVISER HERE</h2>
               </div>
               <div class="text-center mt15">
                   <a href="#"><img src="{{asset('website/images/addbtn.png')}}" /></a>
               </div>
               <div class="text-center mt15">
                   <p class="clrwhite">
                       Every adviser you recommend, if join us we will reward you with a free consuation on anything
                   </p>
               </div>
           </div>
           <div class="col-lg-6 tophead">
               <div class="text-center clrwhite">
                   <h2 >REGISTER AS AN EXPERT</h2>
               </div>
               <div class="text-center mt15" style="margin: 45px;">
                   <a href="#" data-toggle="modal" data-target="#expertsignup"><img src="{{asset('website/images/itsfreebtn.png')}}" /></a>
               </div>
           </div>

       </div>
   </div>
   <div class="modal fade" id="expertsignup" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign Up As An Expert</h4>Create an account for Adviceli
                </div>
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="form-group">
                    <div class="modal-title"><h4 class="col-lg-10">Sign Up As An Expert</h4></div>
                    <p class="col-lg-10" style="margin-top:10px">Create an account for Adviceli</p>
                     </div>
                </div> -->
                <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row">
                         <div class="col-lg-12">
                            <div class="col-lg-6">
                               <div class="form-group">
                                <label for="adviserType">TYPE OF ADVISER</label>
                                  <select id="adviserType" placeholder="type of adviser"  class="form-control">
                                    <option>CHOOSE HERE</option>
                                    <option>EXPERIENCED & QUALIFIED INDIVIDUAL</option>
                                    <option>PROFESSIONAL</option>
                                  </select>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">

                                <label for="adviserGender">GENDER</label>
                                <select id="adviserGender" placeholder="gender"  class="form-control">
                                <option>gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-6">
                               <div class="form-group">
                             <label for="mobile">FIRST NAME</label>
                                <input id="fname" type="text" class="form-control" name="fname" placeholder="First Name" required autofocus>
                                </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                              <label for="mobile">LAST NAME</label>
                                <input id="lname" type="text" class="form-control" name="name" placeholder="Last Name" required autofocus>
                              </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                              <label for="mobile">MOBILE NUMBER</label>
                                <input id="mobile" type="number" class="form-control" name="mobile" placeholder="Mobile number" required autofocus>
                             </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                              <label for="landline">LANDLINE NUMBER</label>
                                <input id="landline" type="number" class="form-control" name="landline" placeholder="landline number" required autofocus>
                             </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                              <label for="mail">EMAIL ID</label>
                                <input id="mail" type="email" class="form-control" name="mail" placeholder="Email Id" required autofocus>
                              </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                               <label for="pass">PASSWORD</label>
                                <input id="pass" type="password" class="form-control" name="pass" placeholder="Password" required autofocus>
                             </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                              <label for="confirmPass">CONFIRM PASSWORD</label>
                                <input id="confirmPass" type="password" class="form-control" name="confirmPass" placeholder="Confirm Password" required autofocus>
                             </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                              <label for="confirmPass">CONFIRM PASSWORD</label>
                                <input id="confirmPass" type="password" class="form-control" name="confirmPass" placeholder="Confirm Password" required autofocus>
                             </div>
                            </div>
                            <!-- <div class="col-lg-6">
                              <div class="form-group">
                                <label for="adviserCategory">CATEGORY</label>
                                <select id="adviserCategory" placeholder="category"  class="form-control">
                                <option>gender</option>
                                </select>
                             </div>
                            </div> -->
                            <div class="col-lg-6">
                             <div class="form-group">
                                <label for="country">CATEGORY</label>
                                <select id="adviserCategory" placeholder="category"  class="form-control">
                                  <option>gender</option>
                                </select>
                             </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                                <label for="country">COUNTRY</label>
                                <select id="country" placeholder="select country"  class="form-control">
                                  <option>select country</option>
                                </select>
                             </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                                <label for="state">STATE</label>
                                <select id="state" placeholder="select state"  class="form-control">
                                <option>select state</option>
                                </select>
                             </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                                <label for="city">CITY</label>
                                <select id="city" placeholder="select city"  class="form-control">
                                <option>Select City</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                             <label for="postal">POSTAL CODE</label>
                                <input id="postal" type="number" class="form-control" name="fname" placeholder="Postal Code" required autofocus>
                             </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                               <label for="companyname">ORGANIZATION/COMPANY NAME</label>
                                <input id="companyname" type="text" class="form-control" name="fname" placeholder="Organization/Company Name" required autofocus>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <input type="checkbox" id="chk">
                                <label style="margin-left:23px;margin-top:-20px">BY CLICKING ON CHECKBOX, YOU HEREBY AGREE TO THE TERMS AND CONDITIONS OF ADVICELI.COM</label>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label><input type="checkbox" id="chk">NEWSLETTER/OFFERS SUBSCRIPTION</label>
                              </div>
                            </div>
                         </div>
                            <div class="col-lg-12">
                                 <div class="text-center">
                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">SIGN UP</button>
                                 </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
   </div>
   <div class="modal fade" id="companysignup" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign Up As An Organization/Company</h4>Create an account for Adviceli
                </div>
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="form-group">
                    <div class="modal-title"><h4 class="col-lg-10">Sign Up As An Organization/Company</h4></div>
                    <p class="col-lg-10" style="margin-top:10px">Create an account for Adviceli</p>
                     </div>
                </div> -->
                <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row">
                         <div class="col-lg-12">

                            <div class="col-lg-6">
                               <div class="form-group">
                             <label for="mobile">ORGANIZATION NAME</label>
                                <input id="fname" type="text" class="form-control" name="fname" placeholder="ORGANIZATION Name" required autofocus>
                                </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                              <label for="mobile">MOBILE NUMBER</label>
                                <input id="lname" type="text" class="form-control" name="name" placeholder="MOBILE NUMBER" required autofocus>
                              </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                              <label for="mobile">MOBILE/LANDLINE NUMBER</label>
                                <input id="mobile" type="number" class="form-control" name="mobile" placeholder="MOBILE/LANDLINE NUMBER" required autofocus>
                             </div>
                            </div>


                            </div>

                         </div>
                         <div class="col-lg-12">
                         <label>CENTER NAME</label>
                         </div>
                         <div class="borderOrg">
                                <div class="col-lg-6">
                                <div class="form-group">
                                <label for="landline">CENTER NAME 1</label>
                                    <input id="landline" type="text" class="form-control" name="landline" placeholder="CENTER NAME 1" required autofocus>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                <label for="mail">CENTER NAME 2</label>
                                    <input id="mail" type="text" class="form-control" name="mail" placeholder="CENTER NAME 2" required autofocus>
                                </div>

                         </div>
                            <div class="col-lg-12" style="margin-top:7%">
                                 <div class="text-center">
                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">SIGN UP</button>
                                 </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
   </div>
  <style>
  .borderOrg{
    border: 1px solid #ddd;
    height: 100px;
    margin-top: 22px;
    margin-left: 16px;
    margin-right: 16px;
  }
  </style>
  <script src="{{asset('js/jssor.slider-26.3.0.min.js')}}" type="text/javascript"></script>
<script>
    $(function () {
        $("#usertab").click(function (e) {
            $(this).parent("div").addClass('crblue');
            $(this).parent("div").removeClass('bgwhite');
            $("#advisortab").parent("div").removeClass('crblue');
            $("#advisortab").parent("div").addClass('bgwhite');
            e.preventDefault();
            $("#user").show();
            $("#advisor").hide();
        });
        $("#advisortab").click(function (e) {
            e.preventDefault();
            $("#usertab").parent("div").removeClass('crblue');
            $("#usertab").parent("div").addClass('bgwhite');
            $(this).parent("div").addClass('crblue');
            $(this).parent("div").removeClass('bgwhite');
            $("#advisor").show();
            $("#user").hide();
        });


         jssor_1_slider_init = function(id) {

            var jssor_1_options = {
              $AutoPlay: 1,
              $AutoPlaySteps: 3,
              $SlideDuration: 160,
              $SlideWidth: 380,
              $SlideSpacing: 5,
              $Cols: 3,
              $Align: 390,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $Steps: 3
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$(id, jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 1600;

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
         jssor_1_slider_init("blogs");
          jssor_1_slider_init("advisers");


          $('.button').hover(function (e) {

         var scrollTop = $(window).scrollTop();
       var elementOffset = $('.zindex').offset().top;
        var distance= (elementOffset - scrollTop);

    var d=$(this).offset().top-200;

   if(distance<0)
   {
       $('.zindex').css('top',d+'px');
   }
   else
   {
        $('.zindex').css('top','0px');
   }
});

    });


</script>
@endsection

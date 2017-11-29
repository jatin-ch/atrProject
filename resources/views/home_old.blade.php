@extends('layouts.website')
@section('content')

<link href="{{asset('css/website.css')}}" rel="stylesheet" type="text/css">

<div class="container-fluid mt30">

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
                                <form action="{{route('filter', $category->slug)}}", method="POST" role="search" id="sc1{{ $subcategory->id }}">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="brands[]" value="{{$subcategory->name}}">
                                </form>
                                <a onclick="document.getElementById('sc1{{ $subcategory->id }}').submit();" style='cursor:pointer;text-transform:capitalize'>
                                    {{ $subcategory->name }}
                                </a>
                                 @endforeach
                                 <a href="#">View All ></a>
                                 
                                 <h4 class="submenu">QUALIFICATION</h4>
                                 @foreach($category->qualifications as $qualification)
                                 <form action="{{route('filter', $category->slug)}}", method="POST" role="search" id="qu1{{ $qualification->id }}">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="qfs[]" value="{{$qualification->name}}">
                                </form>
                                <a onclick="document.getElementById('qu1{{ $qualification->id }}').submit();" style='cursor:pointer;text-transform:capitalize'>
                                    {{ $qualification->name }}
                                </a>
                                 @endforeach
                                 <a href="#">View All ></a>
                             </div>
                               <div class="col-lg-6" style="border-left: 2px solid #bdb9b9;padding: 20px;">
                                   <h4 class="submenu">HOSPITAL/ CLINIC</h4>
                                   <a href="#">Medanta</a>
                                   <a href="#">AIIMS</a>
                                   <a href="#">Fortis</a>
                                   <a href="#">Appllo</a>
                                   <a href="#">Medanta</a>
                                   <a href="#">AIIMS</a>
                                   <a href="#">View All ></a>
                                   <h4 class="submenu">LOCATION</h4>
                                   <a href="#">Delhi</a>
                                   <a href="#">Gurgaon</a>
                                   <a href="#">Chennai</a>
                                   <a href="#">Banglore</a>
                                   <a href="#">Mumbai</a>
                                   <a href="#">Kolkata</a>
                                   <a href="#">View All ></a>
                               </div>
                           </li>
                       </ul>
                   </li>
                   @endforeach
               </ul>
           </div>
           <div class="col-lg-9">
               <div class="tab">
                   <ul>
                       <li style="width:16%;">
                           <a href="{{ route('asks.index') }}"> Ask Us</a>
                       </li>
                       <li style="width:16%;">
                           <a href="{{ route('blog-posts.index') }}"> Blog</a>
                       </li>

                       <li>
                           <a href="#"> Register As An Expert</a>
                       </li>
                       <li>
                           <a href="#"> Suggest Adviceli to Your Adviser</a>
                       </li>
                   </ul>
               </div>
               <div class="container-fluid" style="padding:0!important;">
                   <div id="myCarousel" class="carousel slide" data-ride="carousel">
                       <!-- Indicators -->
                       <ol class="carousel-indicators" style="margin-bottom:40px;">
                           <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                           <li data-target="#myCarousel" data-slide-to="1"></li>
                           <li data-target="#myCarousel" data-slide-to="2"></li>
                       </ol>

                       <!-- Wrapper for slides -->
                       <div class="carousel-inner" style="height: 500px;">
                           <div class="item active">
                               <img src="{{asset('website/images/la.jpg')}}" alt="Los Angeles" style="width:100%;">
                           </div>

                           <div class="item">
                               <img src="{{asset('website/images/chicago.jpg')}}" alt="Chicago" style="width:100%;">
                           </div>

                           <div class="item">
                               <img src="{{asset('website/images/ny.jpg')}}" alt="New york" style="width:100%;">
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-lg-9 mt15 item">
                           <p><strong>Q. Are sore things normal during pregnancy ?</strong></p>
                           Is it typical for women to have sort thighs when they are pregnant? I am 26 and pregnant with my first child, so i don't really know what to expect, but my thighs are extremely tender when I stand or walk.What shoud....<a href=""><strong class="clrgreen ml10">show answer</strong></a>
                           <div class="mt15 text-center">
                               <a href=""><img class="pull-left crsr" src="{{asset('website/images/prevbtn.png')}}" /></a>
                               <span>Asked by : Asha Negi | <i class="fa fa-clock-o" aria-hidden="true"></i> 25th June 2017 | <i class="fa fa-map-marker" aria-hidden="true"></i> Mumbai</span>
                               <a href=""><img class="pull-right crsr" src="{{asset('website/images/nextbtn.png')}}" /></a>
                           </div>

                       </div>
                       <div class="col-lg-1 mt15">
                           <a href=""><img class="crsr mt40" src="{{asset('website/images/askbtn.png')}}" /></a>
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
                           <img src="{{asset('website/images/searchblock.png')}}" />
                       </div>
                       <div class="mt10">
                           <img src="{{asset('website/images/selectblock.png')}}" />
                       </div>
                       <div class="mt10">
                           <img src="{{asset('website/images/scheduleblock.png')}}" />
                       </div>
                       <div class="mt10">
                           <img src="{{asset('website/images/connect block.png')}}" />
                       </div>


                   </div>
                   <div class="col-lg-6">
                       <img style="width:90%" src="{{asset('website/images/laptopimg.png')}}" />
                   </div>

               </div>
               <div id="advisor" class="row mt30 mb30" style="display:none;">
                   <div class="col-lg-6">
                       <div class="mt10">
                           <img src="{{asset('website/images/searchblock.png')}}" />
                       </div>
                       <div class="mt10">
                           <img src="{{asset('website/images/selectblock.png')}}" />
                       </div>
                       <div class="mt10">
                           <img src="{{asset('website/images/scheduleblock.png')}}" />
                       </div>
                       <div class="mt10">
                           <img src="{{asset('website/images/connect block.png')}}" />
                       </div>


                   </div>
                   <div class="col-lg-6">
                       <img style="width:90%" src="{{asset('website/images/laptopimg.png')}}" />
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
                 @foreach($blogs as $blog)
                   <div class="col-lg-3">
                       <div class="itemblog">
                           <div class="text-center">
                               <img class="wd100" src="{{asset('posts/'.$blog->featured_image)}}" />
                               @if($blog->user->basicDetail->image)
                               <img class="mtn35 img-circle" style="width:78px" src="{{asset('images/'.$blog->user->basicDetail->image)}}" />
                               @else
                               <img class="mtn35" src="{{asset('website/images/Rectangle.png')}}" />
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
               <div class="text-center mt30">
                   <a href="{{route('blog-posts.index')}}" class="btn btn-success">View All Blogs</a>

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

               <div class="col-lg-4">
                   <div class="row">
                       <div class="col-lg-12">
                           <div class="itemblog">
                               <div class="text-center">

                                   <img class="mtn35 docimg" src="{{asset('website/images/blogusr.png')}}" />

                               </div>
                               <div class="text-center"><img src="{{asset('website/images/adviserratting.png')}}" /></div>
                               <div class="row mt10">

                                   <div class="col-lg-4">
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
                                   <div class="col-lg-8">
                                       : Dr. Neetu Sharma
                                       <br />
                                       : HOD (Oncology), Max Hospital
                                       <br />
                                       : Oncology (Cancer), Lung,Neuro
                                       <br />
                                       : 10 yrs.
                                       <br />
                                       : Gurugram, Haryana
                                       <br />
                                       : Rs.1000/-

                                   </div>

                               </div>
                               <div class="text-center mt30"><a href="#"><img src="{{asset('website/images/viewadvbtn.png')}}" /></a></div>


                           </div>

                       </div>

                   </div>


               </div>
               <div class="col-lg-4">
                   <div class="row">
                       <div class="col-lg-12">
                           <div class="itemblog">
                               <div class="text-center">

                                   <img class="mtn35 docimg" src="{{asset('website/images/blogusr.png')}}" />

                               </div>
                               <div class="text-center"><img src="{{asset('')}}website/images/adviserratting.png" /></div>
                               <div class="row mt10">

                                   <div class="col-lg-4">
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
                                   <div class="col-lg-8">
                                       : Dr. Neetu Sharma
                                       <br />
                                       : HOD (Oncology), Max Hospital
                                       <br />
                                       : Oncology (Cancer), Lung,Neuro
                                       <br />
                                       : 10 yrs.
                                       <br />
                                       : Gurugram, Haryana
                                       <br />
                                       : Rs.1000/-

                                   </div>

                               </div>
                               <div class="text-center mt30"> <a href="#"><img src="{{asset('website/images/viewadvbtn.png')}}" /></a></div>


                           </div>
                       </div>
                   </div>


               </div>
               <div class="col-lg-4">
                   <div class="row">
                       <div class="col-lg-12">
                           <div class="itemblog">
                               <div class="text-center">

                                   <img class="mtn35 docimg" src="{{asset('website/images/blogusr.png')}}" />

                               </div>
                               <div class="text-center"><img src="{{asset('website/images/adviserratting.png')}}" /></div>
                               <div class="row mt10">

                                   <div class="col-lg-4">
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
                                   <div class="col-lg-8">
                                       : Dr. Neetu Sharma
                                       <br />
                                       : HOD (Oncology), Max Hospital
                                       <br />
                                       : Oncology (Cancer), Lung,Neuro
                                       <br />
                                       : 10 yrs.
                                       <br />
                                       : Gurugram, Haryana
                                       <br />
                                       : Rs.1000/-

                                   </div>

                               </div>
                               <div class="text-center mt30"><a href="#"><img src="{{asset('website/images/viewadvbtn.png')}}" /></a></div>


                           </div>
                       </div>
                   </div>


               </div>
               <div class="col-lg-12 text-center mt30">
                   <a href="{{route('advisers.index')}}" class="btn btn-success">View All Advisors</a>
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

                       <div class="text-center mt30 clrwhite" style="padding:10px">
                           <h4 class="pb30">Advice for all your query</h4>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3">
                   <div class="bggreen">
                       <div class="text-center">
                           <img class="mt30" src="{{asset('website/images/adviserimg.png')}}" />
                       </div>

                       <div class="text-center mt30 clrwhite" style="padding:10px">
                           <h4 class="pb30">Verified Experts</h4>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3">
                   <div class="bggreen">
                       <div class="text-center">
                           <img class="mt30" src="{{asset('website/images/adviserimg.png')}}" />
                       </div>
                       <div class="text-center mt30 clrwhite" style="padding:10px">
                           <h4 class="pb30">3 Way of Communication</h4>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3">
                   <div class="bggreen">
                       <div class="text-center">
                           <img class="mt30" src="{{asset('website/images/adviserimg.png')}}" />
                       </div>

                       <div class="text-center mt30 clrwhite" style="padding:10px">
                           <h4 class="pb30">100% Secure and Refundable Money</h4>
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
                   <h2>REGISTER AS AN EXPERT</h2>
               </div>
               <div class="text-center mt15" style="margin: 45px;">
                   <a href="#"><img src="{{asset('website/images/itsfreebtn.png')}}" /></a>
               </div>
           </div>

       </div>
   </div>

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
    });
</script>

@endsection

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Adviceli @yield('title')</title>
 <link rel="stylesheet" href="{{asset('css/advisorCss.css')}}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('Content/bootstrap/css/bootstrap.min.css')}}">
   <link href="{{asset('Content/plugins/timepicker/bootstrap-timepicker.min.css')}}" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link href="{{asset('css/website.css')}}" rel="stylesheet" type="text/css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('Content/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('Content/dist/css/skins/_all-skins.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('Content/plugins/iCheck/flat/blue.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('Content/plugins/morris/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('Content/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('Content/plugins/datepicker/datepicker3.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('Content/plugins/daterangepicker/daterangepicker.css')}}">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('Content/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('bower_components/angular-material/angular-material.min.css')}}">
        <link rel="stylesheet" href="{{asset('bower_components/mdPickers/dist/mdPickers.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/mdPickers/dist/mdPickers.css')}}">
   <!-- Icheck -->
   <link rel="stylesheet" href="{{asset('Content/plugins/iCheck/flat/green.css')}}">

    <link rel="stylesheet" href="{{asset('bower_components/slick-carousel/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/slick-carousel/slick/slick-theme.css')}}">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery 2.2.3 -->
  <script src="{{asset('Content/jquery.min.js')}}"></script>
<script src="{{asset('Content/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Icheck -->


   <!-- <script src="{{asset('bower_components/angular/angular.min.js')}}"></script>
    <script src="{{asset('bower_components/angular-animate/angular-animate.min.js')}}"></script>
    <script src="{{asset('bower_components/angular-aria/angular-aria.min.js')}}"></script>
    <script src="{{asset('bower_components/angular-messages/angular-messages.min.js')}}"></script>
    <script src="{{asset('bower_components/angular-ui-router/release/angular-ui-router.min.js')}}"></script>
    <script src="{{asset('bower_components/angular-tooltips/dist/angular-tooltips.min.js')}}"></script>
    <script src="{{asset('bower_components/oclazyload/dist/ocLazyLoad.js')}}"></script>
    <script src="{{asset('bower_components/angular-material/angular-material.min.js')}}"></script>
    <script src="{{asset('bower_components/mdPickers/dist/mdPickers.js')}}"></script>
    <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('bower_components/jquery-validation/dist/jquery.validate.min.js')}}"></script>

   <script src="{{asset('bower_components/slick-carousel/slick/slick.js')}}"></script>
   <script src="{{asset('bower_components/angular-slick/dist/slick.js')}}"></script>
    <script src="{{asset('bower_components/angular-slick-carousel/dist/angular-slick.min.js')}}"></script> -->

</head>
<body id="app" class="" ng-controller="mainCtrl">
<div class="">
 <a data-toggle="modal" data-target="#askusModel" href="#" id="askus">
           <img style="width: 40%;" src="{{asset('website/images/As.png')}}" />
       </a>
  <div class="">
    @include('partials.website.header')
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid">
    @yield('content')
    @include('_includes._messages')
  </div>
  <!-- <div class="content-wrapper" ui-view="ad_container"></div> -->
  <!-- /.content-wrapper -->

  <footer>
   @include('partials.website.footer')
  </footer>
</div>
<!-- ./wrapper -->

<script src="{{asset('Content/plugins/iCheck/icheck.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap 3.3.6 -->
<script src="{{asset('Content/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('Content/plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('Content/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('Content/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('Content/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('Content/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{asset('Content/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('Content/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('Content/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('Content/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('Content/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('Content/dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('Content/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('Content/dist/js/demo.js')}}"></script>
<script src="{{asset('Content/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('Content/plugins/ckeditor/ckeditor.js')}}"></script>






 <!--Modals-->

    <div class="modal fade" id="askusModel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p><h4 class="modal-title">Ask Your Query?</h4>Our expert will answer you within 24 hrs maximum</p>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                              {!! Form::open(['route' => ['asks.store'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label for="category">Choose Your Category</label>
                                    <select class="form-control" name="category" id="category">
                                      @foreach(App\Models\Admin\Category::all() as $category)
                                        <option value="{{ $category->id }}">{{$category->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Choose Your Sub-Category</label>
                                    <select class="form-control" name="sub_category" id="category">
                                      @foreach(App\Models\Admin\Category::all() as $category)
                                      @foreach($category->subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{$subcategory->name}}</option>
                                      @endforeach
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('question', 'Title') }}
                                    {{ Form::text('question', null, ['class' => 'form-control', 'placeholder' => 'Query?', 'required' => '']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('detail', 'Explain your query in detail') }}
                                    {{ Form::textarea('detail', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => "Query?"]) }}
                                </div>
                                <div class="form-group">
                                    <label for="category">Do you Want to answer from Experts only or anyone can answer?</label><br />
                                    <label> <input type="radio" name="only_expert" value="1" /> Only Experts </label>
                                    <label>  <input type="radio" name="only_expert" value="0" checked /> Anyone can Answer </label>
                                </div>
                                <div class="form-group">
                                    <label for="category">Do you Want to show your name on site?</label><br />
                                    <label> <input type="radio" name="show_name" value="1" checked /> Yes </label>
                                    <label>  <input type="radio" name="show_name" value="0" /> No </label>
                                </div>
                                <div class="text-center">
                                  {{ Form::submit('Ask Question', ['class' => 'text-center btn btn-success']) }}
                                  <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="callbackModel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p><h4 class="modal-title">Need Help?</h4>Call at +99656515541 or allows us to call back you</p>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="category">Explain your query in detail</label>
                                    <textarea style="min-height:300px" class="form-control" placeholder="Query?"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<!-- Signup Model -->
     <div class="modal fade" id="signupModel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign Up On Adviceli</h4>Create an account for Adviceli
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                     <input id=name class="form-control" type="text" placeholder="Name *" />
                                </div>
                                <div class="form-group">
                                     <input id=email class="form-control" type="text" placeholder="Email *" />
                                </div>
                                <div class="form-group">
                                    <input id="mobile" class="form-control" type="text" placeholder="Mobile Number *" />
                                </div>
                                 <div class="form-group">
                                    <input id="Password" class="form-control" type="text" placeholder="Password *" />
                                </div>
                                 <div class="form-group">
                                    <input id="Confirm" class="form-control" type="text" placeholder="Confirm Password *" />
                                </div>
                                <div class="form-group">
                                  <select id="Country" placeholder="Country" class="form-control">
                                    <option>Select Country</option>
                                  </select>
                                </div>
                                 <div class="form-group">
                                  <select id="City" placeholder="City" class="form-control">
                                    <option>Select City</option>
                                  </select>
                                </div>
                                 <div class="form-group">
                                  <select id="state" placeholder="State"  class="form-control">
                                    <option>Select State</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label >Gender</label><br />
                                    <label> <input type="radio" name="gender" value="" /> Male </label>
                                    <label>  <input type="radio" name="gender" value="" /> Female </label>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Signup Model -->
<script type="text/javascript">
   $('.timepicker').timepicker({
      showInputs: false
    });
</script>
</body>
</html>

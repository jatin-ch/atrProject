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


</head>
<body id="app" class="" ng-controller="mainCtrl">
<div class="">
  <div class="">
    @include('partials.website.header_login')
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid">
    @yield('content')
  </div>
  <!-- <div class="content-wrapper" ui-view="ad_container"></div> -->
  <!-- /.content-wrapper -->

  <footer>
    <div class="container-fluid">
        <div class="row footerbg1 pad35">
            <div class="col-lg-4">
                <label class="mt40" style="color:white">Copyright 2017</label>
            </div>
            <div class="col-lg-5">
                <img src="{{asset('website/images/Facebookicon.png')}}" />
                <img class="ml20" src="{{asset('website/images/Google.png')}}" />
                <img class="ml20" src="{{asset('website/images/InstagramIcon.png')}}" />
                <img class="ml20" src="{{asset('website/images/LinkedIn.png')}}" />
                <img class="ml20" src="{{asset('website/images/TwitterIcon.png')}}" />
            </div>
            <div class="col-lg-3">
                <label class="mt40 ml20" style="color:white">Made with Love and Pride of India</label>
            </div>
        </div>
    </div>
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



<script type="text/javascript">
   $('.timepicker').timepicker({
      showInputs: false
    });
</script>
</body>
</html>

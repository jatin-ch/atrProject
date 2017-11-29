<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Adviceli | Admin @yield('title')</title>
 <link rel="stylesheet" href="{{asset('css/advisorCss.css')}}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('Content/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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
    <link href="{{asset('Content/plugins/timepicker/bootstrap-timepicker.min.css')}}" />
    <link rel="stylesheet" href="{{asset('bower_components/slick-carousel/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/slick-carousel/slick/slick-theme.css')}}">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery 2.2.3 -->
<script src="{{asset('Content/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Icheck -->


   <script src="{{asset('bower_components/angular/angular.min.js')}}"></script>
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
    <script src="{{asset('bower_components/angular-slick-carousel/dist/angular-slick.min.js')}}"></script>


    <!-- <script src="{{asset('js/core/app.module.js')}}"></script>
    <script src="{{asset('js/core/app.controller.js')}}"></script>
    <script src="{{asset('js/core/app.route.js')}}"></script> -->
    <!--  <script src="js/controller/advisor.controller.js"></script> -->
    <!-- <script src="{{asset('js/controller/adviser/askus.controller.js')}}"></script>
    <script src="{{asset('js/controller/adviser/blog.controller.js')}}"></script>
    <script src="{{asset('js/controller/adviser/availability.controller.js')}}"></script>
    <script src="{{asset('js/controller/adviser/unavailability.controller.js')}}"></script>
    <script src="{{asset('js/controller/adviser/offer.controller.js')}}"></script>
    <script src="{{asset('js/controller/adviser/profile.controller.js')}}"></script>
    <script src="{{asset('js/controller/adviser/appointment.controller.js')}}"></script>
    <script src="{{asset('js/controller/adviser/service.controller.js')}}"></script>
     <script src="{{asset('js/controller/adviser/sidebar.controller.js')}}"></script>
    <script src="{{asset('js/controller/adviser/invoice.controller.js')}}"></script>
     <script src="{{asset('js/controller/adviser/dashboard.controller.js')}}"></script>
     <script src="{{asset('js/services/advisorService.js')}}"></script> -->


<!-- AdminAdvisor -->
<!-- <script src="{{ asset('js/controller/adminAdvisor.controller.js') }}"></script> -->
 <!-- <script src="{{ asset('js/controller/adminadvisor/blog.controller.js') }}"></script>
<script src="{{asset('js/controller/adminadvisor/availability.controller.js')}}"></script>
<script src="{{asset('js/controller/adminadvisor/unavailability.controller.js')}}"></script>
<script src="{{asset('js/controller/adminadvisor/offer.controller.js')}}"></script>
<script src="{{asset('js/controller/adminadvisor/profile.controller.js')}}"></script>
<script src="{{asset('js/controller/adminadvisor/appointment.controller.js')}}"></script>
<script src="{{asset('js/controller/adminadvisor/service.controller.js')}}"></script>
<script src="{{asset('js/controller/adminadvisor/invoice.controller.js')}}"></script>
 <script src="{{asset('js/controller/adminadvisor/dashboard.controller.js')}}"></script> -->

<!-- AdminAdvisor -->



</head>
<body id="app" class=" layout-boxed skin-green-light sidebar-mini" ng-controller="mainCtrl">
<div class="wrapper">

  <header class="main-header">
    @include('partials.admin.header')
  </header>
  <!-- <aside class="main-sidebar" data-ng-include="'views/adminadvisor/sidebar.html'"></aside> -->
  <aside class="main-sidebar">
      @include('partials.admin.sidebar')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
    @include('_includes._messages')
  </div>
  <!-- <div class="content-wrapper" ui-view="ad_container"></div> -->
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="#">Adviceli</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<script src="{{asset('Content/plugins/iCheck/icheck.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- <script src="Content/jquery.min.js"></script> -->
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

</body>
</html>

<!-- Delete Modal -->

<!-- Add new Comment -->
<!-- <script type="text/ng-template" id="Delete.html">
<style>
.header-color{
    background-color: #00a65a!important;
}
.md-datepicker-input-container {
    width: 250px;
    margin-top:10px;
}
 .fnt18 {
        font-size: 14px !important;
    }
</style>

<md-dialog  aria-label='' style="width:50%">
    <form name='userForm' id='chatform' ng-cloak novalidate>
      <md-toolbar class="header-color">
        <div class='md-toolbar-tools'>
          <h2>Delete</h2>
          <span flex></span>
          <md-button class='md-icon-button' ng-click='cancel()'>
                        <i class='fa fa-times closeIcon'></i>
         </md-button>
        </div>
      </md-toolbar>
      <md-dialog-content>
       <section class="content">
       <img src="/images/delimg.png" />
            <p class="pull-right popText">Do you really want to delete this post?</p>
            <div>
                <button type="button" class="btn btn-success pull-right mrtop-45 yesbtn">Yes</button>
                <button type="button" class="btn btn-default pull-right mrtop-45 mr80 notnow">Not Now</button>
            </div>
       </section>
       </md-dialog-content>
    </form>
  </md-dialog>
</script> -->

@extends ('layouts.main')

@section('title')

@section('stylesheets')

{{ Html::style('vendors/bootstrap/dist/css/bootstrap.min.css') }}
{{ Html::style('vendors/font-awesome/css/font-awesome.min.css') }}
{{ Html::style('vendors/nprogress/nprogress.css') }}
{{ Html::style('vendors/iCheck/skins/flat/green.css') }}
{{ Html::style('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}
{{ Html::style('vendors/jqvmap/dist/jqvmap.min.css') }}
{{ Html::style('vendors/bootstrap-daterangepicker/daterangepicker.css') }}
{{ Html::style('build/css/custom.min.css') }}


@endsection

@section('content')

<!-- page content -->
       <div class="right_col" role="main">
         <div class="">
           <div class="page-title">
             <div class="title_left">
               <h2>Gallery</h2>
             </div>

             <div class="title_right">
               <div class="col-md-5 col-sm-5 col-xs-12 pull-right">

               </div>
             </div>
           </div>
           <div class="clearfix"></div>
           <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                 <div class="x_title">
                   <h2>Options</h2>
                   <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li>
                   </ul>
                   <div class="clearfix"></div>
                 </div>
                 <div class="x_content">

                 <div class="row">

                   {!! Form::open(['route' => ['galleries.store'], 'method' => 'POST', 'files' => true]) !!}

                   <div class="col-md-4 col-sm-12 col-xs-12">

                     {{ Form::hidden('admin_id', Auth::user()->id) }}

                     {{ Form::label('image_video', 'UPLOAD IMAGE / VIDEO', ['style' => 'margin-top:20px']) }}
                     {{ Form::file('image_video') }}

                   </div>

                   <div class="col-md-8 col-sm-12 col-xs-12">

                     {{ Form::label('video_url', 'ADD VIDEO URL', ['style' => 'margin-top:20px']) }}
                     {{ Form::text('video_url', null, ['class' => 'form-control', 'placeholder' => 'Insert video URL']) }}

                   </div>
                  {{ Form::submit('SUBMIT', ['class' => 'btn btn-success btn-lg', 'style' => 'margin-top:20px']) }}
                   {!! Form::close() !!}

                 </div>

                 </div>
               </div>
             </div>
           </div>


           <div class="clearfix"></div>
           <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                 <div class="x_title">
                   <h2>Your Uploads</h2>
                   <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li>
                   </ul>
                   <div class="clearfix"></div>
                 </div>
                 <div class="x_content">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                   @foreach($galleries as $gallery)
                   @if($gallery->image_video)
                   <iframe src="{{ asset('uploads/' . $gallery->image_video) }}" width="280" height="170"> </iframe>
                   @endif
                   @endforeach
                   </div>

                   <div class="col-md-12 col-sm-12 col-xs-12">
                   @foreach($galleries as $gallery)
                   @if($gallery->video_url)
                   <p><a href="{{ $gallery->video_url }}">{{$gallery->video_url}}</a></p>
                   @endif
                   @endforeach
                   </div>
                 </div>
               </div>
             </div>
           </div>

         </div>
       </div>
       <!-- /page content -->

@endsection

@section('scripts')

{!! Html::script('vendors/jquery/dist/jquery.min.js') !!}
{!! Html::script('vendors/bootstrap/dist/js/bootstrap.min.js') !!}
{!! Html::script('vendors/fastclick/lib/fastclick.js') !!}
{!! Html::script('vendors/nprogress/nprogress.js') !!}
{!! Html::script('vendors/Chart.js/dist/Chart.min.js') !!}
{!! Html::script('vendors/gauge.js/dist/gauge.min.js') !!}
{!! Html::script('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') !!}
{!! Html::script('vendors/iCheck/icheck.min.js') !!}
{!! Html::script('vendors/skycons/skycons.js') !!}
{!! Html::script('vendors/Flot/jquery.flot.js') !!}
{!! Html::script('vendors/Flot/jquery.flot.pie.js') !!}
{!! Html::script('vendors/Flot/jquery.flot.time.js') !!}
{!! Html::script('vendors/Flot/jquery.flot.stack.js') !!}
{!! Html::script('vendors/Flot/jquery.flot.resize.js') !!}
{!! Html::script('vendors/flot.orderbars/js/jquery.flot.orderBars.js') !!}
{!! Html::script('vendors/flot-spline/js/jquery.flot.spline.min.js') !!}
{!! Html::script('vendors/flot.curvedlines/curvedLines.js') !!}
{!! Html::script('vendors/DateJS/build/date.js') !!}
{!! Html::script('vendors/jqvmap/dist/jquery.vmap.js') !!}
{!! Html::script('vendors/jqvmap/dist/maps/jquery.vmap.world.js') !!}
{!! Html::script('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') !!}
{!! Html::script('vendors/moment/min/moment.min.js') !!}
{!! Html::script('vendors/bootstrap-daterangepicker/daterangepicker.js') !!}
{!! Html::script('build/js/custom.min.js') !!}

@endsection


@if (Session::has('success'))
<div class="alert alert-success alert-dismissable fade in" role="alert" style="z-index:1;position:fixed;right:0;bottom:0">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Success:</strong> {{ Session::get('success') }}
</div>
@elseif(Session::has('warning'))
<div class="alert alert-warning alert-dismissable fade in" role="alert" style="z-index:1;position:fixed;right:0;bottom:0">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Warning:</strong> {{ Session::get('warning') }}
</div>
@elseif(Session::has('danger'))
<div class="alert alert-danger alert-dismissable fade in" role="alert" style="z-index:1;position:fixed;right:0;bottom:0">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Danger:</strong> {{ Session::get('danger') }}
</div>
@endif

@if (count($errors) > 0)

<div class="alert alert-danger alert-dismissable fade in" role="alert" style="z-index:1;position:fixed;right:0;bottom:0">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Error:</strong>
  <ul>
    @foreach ($errors->all() as $error)
    <li>  {{ $error }}</li>
    @endforeach
  </ul>
</div>

@endif

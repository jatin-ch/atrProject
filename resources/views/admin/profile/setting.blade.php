@extends('layouts.admin')
@section('title') | Profile-settings @endsection
@section('content')



<script>
 $('input').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
</script>
<section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
  <div class="row basicdetail">
    <div class="col-lg-offset-2 col-lg-8">
      <form class="form-horizontal" method="POST" action="{{ route('admin.profile.settings.update') }}">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-4 control-label">Name</label>

              <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" value="{{ $setting->name }}" required>

                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group">
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>

              <div class="col-md-6">
                  <input id="email" type="email" class="form-control" value="{{ $setting->email }}" required readonly>
              </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">New Password</label>

              <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password">

                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group">
              <label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>

              <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-success">
                      Update
                  </button>
              </div>
          </div>
      </form>
    </div>
  </div>
</section>


@endsection

@extends('layouts.website1')

@section('content')
<div class="container">
    <div class="row" style="margin:75px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login Via</div>

                <div class="panel-body">
                    
                    <div class="col-md-5">
                        <div class="social-buttons">
                           <img src="https://u2start.com/images/facebook_login.png" style="width:90%">
                           <br><br>
                           <img src="https://tenants.com/tenant-landlord/images/twitter_login.png" style="width:90%">
                           <br><br>
                           <div class="form-group" style="width:90%">
                               <button type="button" data-toggle="modal" data-target="#signupOTPmodel" class="btn btn-primary btn-lg btn-block">Sign in with OTP</button>
                           </div>
                       </div>
                    </div>
                    
                    <div class="col-md-2" style="position:absolute;left:40%;top:15%;bottom:10%; border-left:1px solid silver;">
                        
                    </div>
                    
                    <div class="col-md-5">
                        <form class="form" role="form" method="POST" action="{{ route('login') }}" accept-charset="UTF-8" id="login-nav">
                           {{ csrf_field() }}
                           <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                               <label class="sr-only" for="exampleInputEmail2">Email address</label>
                               <input id="exampleInputEmail2" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus>
                               @if ($errors->has('email'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('email') }}</strong>
                                   </span>
                               @endif
                           </div>
                           <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                               <label class="sr-only" for="exampleInputPassword2">Password</label>
                               <input id="exampleInputPassword2" type="password" class="form-control" name="password" placeholder="Password" required>
                               @if ($errors->has('password'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('password') }}</strong>
                                   </span>
                               @endif
                               <div class="help-block text-right"><a class="btn btn-link" href="{{ route('password.request') }}">Forget the password ?</a></div>
                           </div>
                           <div class="checkbox">
                               <label>
                                   <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> keep me logged-in
                               </label>
                           </div>
                           
                           <div class="form-group">
                               <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                           </div>
                           <!--<div class="form-group">-->
                           <!--    <button type="button" data-toggle="modal" data-target="#signupOTPmodel" class="btn btn-primary btn-block">Sign in with OTP</button>-->
                           <!--</div>-->
                       </form>
                    </div>
                                       
</div>

                </div>
            </div>
        </div>
    </div>



@endsection

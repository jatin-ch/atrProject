<div class="container-fluid">
        <div class="row tophead">
            <div class="col-lg-8">
                <i class="fa fa-linkedin pull-right clrwhite mt5 crsr" aria-hidden="true"></i>
                <i class="fa fa-twitter pull-right clrwhite plr15 mt5 crsr" aria-hidden="true"></i>
                <i class="fa fa-facebook pull-right clrwhite mt5 crsr" aria-hidden="true"></i>
            </div>
            <div class="col-lg-2 text-center clrwhite crsr">
                <a href="{{ route('faq') }}" class="clrwhite">FAQ's</a>
            </div>
            <div class="col-lg-2 text-center clrwhite crsr">
                <a href="{{ route('howitworks') }}" class="clrwhite">HOW IT WORKS ?</a>
            </div>
        </div>

        <div class="container-fluid">
            <header class="row mt10">
                <!-- Logo -->
                <div class="col-lg-2">
                    <a href="/" class="">
                        <span class="logo-lg">
                            <img style="width:100%" class="img-responsive" src="{{asset('website/images/logo-01.png')}}" />
                        </span>
                    </a>
                </div>
                <div class="col-lg-4">
                    <div class="form-group mt20">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search for expert advice, question asked, blogs & services">
                    <div id="livesearch" style="width:407px;height:auto;position:fixed;z-index:1;background:#ffffff"> </div>
                    </div>
                </div>
                <div class="col-lg-3 p35" style="display: inline-flex;">
                    <div>
                        <a data-toggle="modal" href="#" data-target="#callbackModel"> <img src="{{asset('website/images/callicn.png')}}"  class="mt10" /></a>
                    </div>
                    <div class="mt10 crlgry">
                        <p class="ml10">
                            <strong>Confused</strong><br />
                            Call Us On : 9811 92 9282
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 crlgry text-center">
                    <div class="mt10">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 17px;">
                              @if (Auth::guest())
                                <span> Sign In</span>
                              @else
                              <span> {{ Auth::user()->name }}</span>
                               @endif
                                <img src="{{asset('website/images/userimg.png')}}" />
                            </a>


                            @if(Auth::guest())
                            <ul id="login-dp" class="dropdown-menu">
                                   <li>
                                       <div class="row">
                                           <div class="col-md-12">
                                               Login via
                                               <div class="social-buttons">
                                                   <a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                                                   <a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                                               </div>
                                               or
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
                                                   <div class="form-group">
                                                       <button type="button" data-toggle="modal" data-target="#signupOTPmodel" class="btn btn-primary btn-block">Sign in with OTP</button>
                                                   </div>
                                               </form>
                                           </div>
                                           <div class="bottom text-center">
                                               New here ? <a data-toggle="modal" data-target="#signupModel"  id="joinus"><b>Join Us</b></a>
                                               <!-- href="{{ route('register') }}" -->
                                           </div>
                                       </div>
                                   </li>
                               </ul>
                            @else
                            <ul class="dropdown-menu" style="padding: 10px;background: #f5f5f5;">
                             <!-- User image -->
                             <li class="user-header">
                               @if(isset(Auth::user()->basicDetail->image))
                               <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" class="img-circle" style="width: 50%;margin-left: 50px"  alt="User Image">
                               @else
                               <img src="{{ asset('images/default-user.png') }}" style="width: 50%;margin-left: 50px" class="img-circle" alt="User Image">
                               @endif

                               <p class="text-center">
                                 Adviceli - User <br />
                                 <small>Member since {{ date('M Y', strtotime(Auth::user()->created_at)) }}</small>
                               </p>
                             </li>
                             <!-- Menu Footer-->
                             <li class="user-footer">
                               <div class="pull-left"> 
                                 <a onclick="document.getElementById('dashboard-form').submit();" class="btn btn-default btn-flat">Dashboard</a>
                                 <form id="dashboard-form" action="{{ route('dashboard') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }} 
                                 </form>
                               </div>
                               <div class="pull-right">
                                     <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                                         Sign out
                                     </a>

                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                         {{ csrf_field() }}
                                     </form>
                               </div>
                             </li>
                           </ul>
                          @endif

                        </div>
                    </div>
                </div>
            </header>
        </div>
    </div>
    <div class="modal fade" id="signupOTPmodel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="margin:65px">
                <div class="modal-header" style="background:white;color:black">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="form-group">
                    <h4 class="modal-title col-lg-10">Login/Sign Up On Adviceli</h4>
                    <p class="col-lg-10" style="margin-top:10px"> Please provide your mobile number or Email to Login/Sign Up on Adviceli</p>
                </div></div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                            
                            <div class="form-group">
                                        <input id="mobileOTP" type="number" class="form-control" name="mobile" placeholder="Mobile number/Email" required autofocus>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Enter OTP Here</label>
                                        <input id="mobileOTP" type="number" class="form-control" name="mobile" placeholder="One Time Password" disabled required>
                                            </div
                                 
                                
                               
                                <div class="text-center">
                                    <button type="button" class="text-center btn btn-primary form-control" data-dismiss="modal">CONTINUE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    
    <script type="text/javascript">
      $('#search').on('keyup',function(){
        value = $(this).val();
        if(value.length > 0){
          $.ajax({
            type : 'get',
            url : '{{URL::to('liveSearch')}}',
            data : {'keyword':value},
            success:function(data){
              $('#livesearch').html(data);
            }
          });
        }
        else{
           $('#livesearch').html(''); 
        }
      });
    </script>
   
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
            <div class="col-lg-2 clrwhite crsr">
                <a href="{{ route('howitworks') }}" class="clrwhite">HOW IT WORKS ?</a>
            </div>
        </div>

        <div class="container-fluid">
            <header class="row mt10">
                <!-- Logo -->
                <div class="col-lg-2">
                    <a href="/" class="">
                        <span class="logo-lg">
                            <img style="width:80%" src="{{asset('website/images/logo-01.png')}}" />
                        </span>
                    </a>
                </div>
                <div class="col-lg-4">

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
                <div class="col-lg-3 crlgry">
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
   
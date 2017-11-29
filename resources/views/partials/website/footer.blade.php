 <div class="container-fluid">
        <div class="row pad35 bgwhite">
            <div class="col-lg-2">
                <div class="form-group">
                    <strong class="">COMPANY</strong>
                    <ul class="mt10 linehght2">
                        <li><a href="{{ route('about') }}"> About us</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Career</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <strong class="">SITE TERMS</strong>
                    <ul class="mt10 linehght2">
                        <li><a href="{{route('terms-of-site')}}">Terms of Site Use</a> </li>
                        <li><a href="#">Terms of Advice </a></li>
                        <li><a href="#">Privacy and Policy </a></li>
                        <li><a href="#">Refund and Cancellation Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <strong class="">NEED HELP ?</strong>
                    <ul class="mt10 linehght2">
                        <li><a href="{{ route('faq') }}">FAQ's </a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="{{ route('howitworks') }}">How it Works ?</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="form-group pad35">
                    <strong>Subscribe for News Letter</strong>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Your Email Address...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">SUMBIT</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
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
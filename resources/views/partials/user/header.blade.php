<style>
    .skin-green-light .main-header .logo:hover {
    background-color: #ffffff!important;
}
</style>
<a href="#" class="logo" style="background-color: #ffffff;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><img src="{{asset('images/favicon.png')}}"></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">  <img style="width: 55%;" src="{{asset('website/images/logo-01.jpg')}}" /></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <li>
        <a href="#">
        <span>FAQs </span>
        </a>
        </li>
        <li>
        <a href="#">
        <span>How It Works?</span>
        </a>
        </li>
        <li>
        <a href="#">
        <span><img style="width:48%" src="{{asset('images/fb.png')}}"> </span>
        </a>
        </li>
        <li>
        <a href="#">
        <span><img style="width:48%" src="{{asset('images/twitter.png')}}"> </span>
        </a>
        </li>
        <li>
        <a href="#">
        <span><img style="width:48%" src="{{asset('images/linkdin.png')}}"> </span>
        </a>
        </li>
        <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img style="width:48%" src="{{asset('images/CallIcons.png')}}">
            </a>
            <ul class="dropdown-menu">
              <li class="header text-center"><b> Confused</b></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{asset('images/CallIcons.png')}}" class="img-circle" alt="User Image">
                      </div>
                      <strong>
                        Call Us On:
                      </strong>
                      <p>9811234567</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
            </ul>
          </li>
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{asset('Content/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if(isset(Auth::user()->basicDetail->image))
              <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" class="user-image" alt="User Image">
              @else
               <img src="{{ asset('images/default-user.png') }}" class="user-image" alt="User Image">
              @endif
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                @if(isset(Auth::user()->basicDetail->image))
                <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" class="img-circle" alt="User Image">
                @else
                <img src="{{ asset('images/default-user.png') }}" class="img-circle" alt="User Image">
                @endif

                <p>
                  Adviceli - User
                  <small>User since {{ date('M Y', strtotime(Auth::user()->created_at)) }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('user.profile.settings')}}" class="btn btn-default btn-flat">Settings</a>
                </div>
                <div class="pull-right">
                      <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                          Sign out
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

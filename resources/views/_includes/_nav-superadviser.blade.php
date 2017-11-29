<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="{{ route('admin.dashboard') }}" class="site_title"><i class="fa fa-paw"></i> <span>adviceli</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="{{ asset('images/user.png') }}" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2>{{ Auth::user()->name }}</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a><i class="fa fa-user"></i> Admin Profile <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{ route('basicDetails.index') }}">Basic Details</a></li>
              <li><a href="{{ route('payments.index') }}">Payment Details</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-users"></i> Advisers <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="#">All Doctors</a></li>
              <li><a href="#">Add New</a></li>
            </ul>
          </li>

            <li><a><i class="fa fa-calendar-times-o"></i> Un-availability</a></li>
          <li><a><i class="fa fa-sitemap"></i> Services <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="#">All Services</a></li>
              <li><a href="#">Add New</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-table"></i> Bookings <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a>Consultation<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li class="sub_menu"><a href="level2.html">Consultation Provided</a>
                    </li>
                    <li><a href="#level2_1">Consultation Recieved</a>
                    </li>
                  </ul>
                </li>
                <li><a>Service<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li class="sub_menu"><a href="level2.html">Level Two</a>
                    </li>
                    <li><a href="#level2_1">Level Two</a>
                    </li>
                    <li><a href="#level2_2">Level Two</a>
                    </li>
                  </ul>
                </li>
            </ul>
          </li>
          <li><a><i class="fa fa-bullhorn"></i> Offer <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="#">All Offers</a></li>
              <li><a href="#">Add New</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-inbox"></i> Invoice <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="#">All Appointments</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-camera"></i> Gallery <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{ route('galleries.index') }}">Image / Video</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="menu_section">
        <h3>Live On</h3>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-question-circle"></i> Ask US <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="#">All Schedules</a></li>
              <li><a href="#">Add New</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-user"></i>Blog <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{ route('posts.create') }}">Write Blog</a></li>
              <li><a href="{{ route('posts.index') }}">Posted Blogs</a></li>
            </ul>
          </li>
          <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
          <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <div style="width:60%;height:auto;position:fixed;left:23%">
          @include('_includes._messages')
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('images/user.png') }}" alt="..." />
            {{ Auth::user()->name }}
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li>
              <a href="#">
                <span class="badge bg-red pull-right">50%</span>
                <span>Profile</span>
              </a>
            </li>
            <li><a href="#">Settings </a></li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
          </ul>
        </li>

        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            <span class="badge bg-green">6</span>
          </a>
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <li>
              <a>
                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                <span>
                  <span>John Smith</span>
                  <span class="time">3 mins ago</span>
                </span>
                <span class="message">
                  Film festivals used to be do-or-die moments for movie makers. They were where...
                </span>
              </a>
            </li>
            <li>
              <a>
                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                <span>
                  <span>John Smith</span>
                  <span class="time">3 mins ago</span>
                </span>
                <span class="message">
                  Film festivals used to be do-or-die moments for movie makers. They were where...
                </span>
              </a>
            </li>
            <li>
              <a>
                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                <span>
                  <span>John Smith</span>
                  <span class="time">3 mins ago</span>
                </span>
                <span class="message">
                  Film festivals used to be do-or-die moments for movie makers. They were where...
                </span>
              </a>
            </li>
            <li>
              <a>
                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                <span>
                  <span>John Smith</span>
                  <span class="time">3 mins ago</span>
                </span>
                <span class="message">
                  Film festivals used to be do-or-die moments for movie makers. They were where...
                </span>
              </a>
            </li>
            <li>
              <div class="text-center">
                <a>
                  <strong>See All Alerts</strong>
                  <i class="fa fa-angle-right"></i>
                </a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->

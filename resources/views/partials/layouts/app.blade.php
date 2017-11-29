<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>adviceli MANAGEMENT</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

.sidenav {
    height: 100%;
    width:200px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    background-color: white;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 15px;
    color: #818181;
    display: block;
    transition: 0.3s;
}
.sidenav li{
  list-style: none;
}

.sidenav a:hover {
    /*color: #f1f1f1;*/
    color: #00cc66;
}

.sidenav .closebtn {
    position: absolute;
    top: 22px;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#main {
    transition: margin-left .5s;
    padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
a:active{
  color:red;
}
</style>
</head>
<body>


  <div id="app">
      <nav class="navbar navbar-default navbar-static-top">
          <div class="container">
              <div class="navbar-header">

                  <!-- Collapsed Hamburger -->
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                      <span class="sr-only">Toggle Navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>

                  <!-- Branding Image -->
                  <a class="navbar-brand" href="{{ url('/') }}">
                      <img src="https://www.adviceli.com/wp-content/uploads/2017/06/Advicelilogo.png" style="width:68%">
                  </a>
              </div>

              <div class="collapse navbar-collapse" id="app-navbar-collapse">
                  <!-- Left Side Of Navbar -->
                  <ul class="nav navbar-nav">

                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="nav navbar-nav navbar-right">
                      <!-- Authentication Links -->
                      @if (Auth::guest())
                          <li><a href="{{ route('login') }}">Login</a></li>
                          <li><a href="{{ route('register') }}">Register</a></li>
                      @else
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                @if(isset(Auth::user()->basicDetail))
                                  @if(isset(Auth::user()->basicDetail->image))
                                    <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" class="img-circle" style="width:30px">
                                  @else
                                     @if(Auth::user()->basicDetail->gender == 'M')
                                       <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsRXflGToQBiuslDfqpbRGQYbXOKS_ukUzAeoMImyCtGdpQ8Ra" class="img-circle" style="width:30px">
                                     @else
                                       <img src="https://cdn2.hercampus.com/jane%20doe.jpg" class="img-circle" style="width:30px">
                                     @endif
                                  @endif
                                @else
                                 <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:30px">
                                @endif

                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('profile.settings.get')}}">Settings</a></li>
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
                      @endif
                  </ul>
              </div>
          </div>
      </nav>

        <div class="container">
            <div class="row">
              <div class="col-md-1">
                <div id="mySidenav" class="sidenav">
                <li>
                  <a>
                  @if(isset(Auth::user()->basicDetail))
                    @if(isset(Auth::user()->basicDetail->image))
                      <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" class="img-circle" style="width:70px">
                    @else
                       @if(Auth::user()->basicDetail->gender == 'M')
                         <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsRXflGToQBiuslDfqpbRGQYbXOKS_ukUzAeoMImyCtGdpQ8Ra" class="img-circle" style="width:70px">
                       @else
                         <img src="https://cdn2.hercampus.com/jane%20doe.jpg" class="img-circle" style="width:70px">
                       @endif
                    @endif
                  @else
                   <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:70px">
                  @endif
                </a>
                  <a>Welcome {{ Auth::user()->name }}</a>
                </li>
                <li>
                  {!! Form::open(['route' => ['profile.photo.upload'], 'method' => 'POST', 'files' => 'true']) !!}
                  <input type="file" name="image" id="selectedFile" style="display:none"  required  onchange='this.form.submit();'>
                  <a><img src="http://www.free-icons-download.net/images/edit--file-icon-69715.png" style="width:20px;cursor:pointer" onclick="document.getElementById('selectedFile').click();"></a>
                  {!! Form::close() !!}
                </li>

                <li><a class="{{ Request::is('/admin/users') ? "active" : "" }}" href="{{route('admin.dashboard')}}">Dashboard</a></li>

                @if(Auth::user()->level == 'adviser')
                <li class="dropdown">
                  <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Profile <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('basicDetails.index')}}">Basic Details</a></li>
                    <li><a href="{{route('locations.index')}}">Address</a></li>
                    <li><a href="{{route('payments.index')}}">Payment Details</a></li>
                    <li><a href="{{route('expertDetails.index')}}">Expert Details</a></li>
                    <li><a href="{{route('verifications.index')}}">Verification Details</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Availability <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('availabilities.show', 'Phone Call')}}">Phone Call</a></li>
                    <li><a href="{{route('availabilities.show', 'Video Call')}}">Video Call</a></li>
                    <li><a href="{{route('availabilities.show', 'Personal Meeting')}}">Personal Meeting</a></li>
                    <li><a href="{{route('availabilities.show', 'Chat')}}">Chat</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Un-availability <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('un-availabilities.index')}}">All</a></li>
                  </ul>
                </li>

                @else
                <li class="dropdown">
                  <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Admin Profile <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('basicDetails.index')}}">Basic Details</a></li>
                    <li><a href="{{route('payments.index')}}">Payment Details</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      User <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('users.index') }}">All Users</a></li>
                    <li><a href="{{ route('roles.index') }}">Roles</a></li>
                    <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                  </ul>
                </li>
                <a href="{{route('manage')}}">Advisers</a>
                @endif

                @if(Auth::user()->level == 'superadministrator')
                <li class="dropdown">
                  <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Category <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('categories.index') }}">All</a></li>
                    <li><a href="{{ route('sub-categories.index') }}">Sub-categories</a></li>
                    <li><a href="{{ route('qualifications.index') }}">Qualifications</a></li>
                  </ul>
                </li>
                <li><a href="{{ route('consultations.index') }}">Consultation Modes</a></li>
                @endif

                <li class="dropdown">
                  <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Services <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('services.create')}}">Add Services</a></li>
                    <li><a href="{{route('services.index')}}">Listed services</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Bookings <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('admin.bookings.consultation')}}">Consultations</a></li>
                    <li><a href="{{route('admin.bookings.service')}}">Services</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Offline<span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('bookings.offline.index')}}">Add New</a></li>
                    <li><a href="{{route('bookings.offline.consultation')}}">Consultations</a></li>
                    <li><a href="{{route('bookings.offline.service')}}">Services</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Offers <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('offers.create')}}">Create New Offer</a></li>
                    <li><a href="{{route('offers.index')}}">Existing Offers</a></li>
                  </ul>
                </li>
                <a href="{{route('posts.index')}}">Blog</a>
              </div>
              </div>

                @yield('content')
                @include('_includes._messages')
            </div>

  </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

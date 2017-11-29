<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="text-center image">
          @if(isset(Auth::user()->basicDetail->image))
          <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" class="img-circle" style="max-width:90px;" alt="User Image">
          @elseif(isset(Auth::user()->basicDetail))
             @if(Auth::user()->basicDetail->gender == 'M')
               <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsRXflGToQBiuslDfqpbRGQYbXOKS_ukUzAeoMImyCtGdpQ8Ra" class="img-circle" style="max-width:90px;" alt="User Image">
             @else
               <img src="https://cdn2.hercampus.com/jane%20doe.jpg" class="img-circle" style="max-width:90px;" alt="User Image">
             @endif
          @else
          <img src="{{ asset('images/user.png') }}" class="img-circle" style="max-width:90px;" alt="User Image">
          @endif
        </div>
        <div class="info text-center" style="position:relative;left:0">
          <label>Welcome {{ Auth::user()->name }}</label>
          @if(isset(Auth::user()->expertDetail))
          <p>{{ Auth::user()->expertDetail->cp }}</p>
          @endif
            {!! Form::open(['route' => ['profile.photo.upload'], 'method' => 'POST', 'files' => 'true']) !!}
            <input type="file" name="image" id="selectedFile3" style="display:none"  required  onchange='this.form.submit();'>
            <a><i class="fa fa-2x fa-edit" onclick="document.getElementById('selectedFile3').click();"></i></a>
            {!! Form::close() !!}
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="active">
        <a href="{{route('adviser.dashboard')}}"><i class="fa fa-line-chart"></i> <span>   Dashboard</span></a>
       </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-user"></i>
            <span>Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('adviser.basicDetails.index')}}"><i class="fa fa-circle-o"></i> Basic Details</a></li>
            <li><a href="{{route('adviser.locations.index')}}"><i class="fa fa-circle-o"></i> Address</a></li>
            <li><a href="{{route('adviser.payments.index')}}"><i class="fa fa-circle-o"></i> Payment Details</a></li>
            <li><a href="{{route('adviser.expertDetails.index')}}"><i class="fa fa-circle-o"></i> Expert Details</a></li>
            <li><a href="{{route('adviser.verifications.index')}}"><i class="fa fa-circle-o"></i> Verification Details</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-calendar"></i>
            <span>Availability</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('availabilities.phoneCall')}}" ><i class="fa fa-circle-o"></i> Phone Call</a></li>
            <li><a href="{{route('availabilities.videoCall')}}"><i class="fa fa-circle-o"></i> Video Call</a></li>
            <li><a href="{{route('availabilities.personalMeeting')}}"><i class="fa fa-circle-o"></i> Personal Meeting</a></li>
            <li><a href="{{route('availabilities.chat')}}"><i class="fa fa-circle-o"></i> Chat</a></li>
          </ul>
        </li>
        <li class="">
        <a href="{{route('un-availabilities.index')}}"><i class="fa fa-calendar-times-o"></i> <span>Unavailability</span></a>
       </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-sun-o"></i>
            <span>Services</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('services.create')}}"><i class="fa fa-circle-o"></i> Add Service</a></li>
            <li><a href="{{route('services.index')}}"><i class="fa fa-circle-o"></i> Listed Services</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-calendar-check-o"></i>
            <span>Appointment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
          <a href="">
            <i class="fa fa-circle-o"></i>
            <span>Provided</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('bookings.index')}}"><i class="fa fa-circle-o"></i> All</a></li>
            <li><a href="{{route('adviser.bookings.consultation')}}"><i class="fa fa-circle-o"></i> Consultation</a></li>
            <li><a href="{{route('adviser.bookings.service')}}"><i class="fa fa-circle-o"></i> Services</a></li>
          </ul>
            </li>
            <li class="treeview">
          <a href="">
            <i class="fa fa-circle-o"></i>
            <span>Recieved</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('bookings.recieved.consultation')}}"><i class="fa fa-circle-o"></i> Consultation</a></li>
            <li><a href="{{route('bookings.recieved.service')}}"><i class="fa fa-circle-o"></i> Services</a></li>
          </ul>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-sticky-note-o"></i>
            <span>Blogs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('adviser.posts.create')}}"><i class="fa fa-circle-o"></i> Write Blog</a></li>
            <li><a href="{{route('adviser.posts.index')}}"><i class="fa fa-circle-o"></i> Posted Blogs</a></li>
          </ul>
        </li>
        <li>
        </li>
       <li class="">
        <a href="{{route('adviser.asks.questions')}}"><i class="fa fa-files-o"></i> <span>Ask Us</span></a>
       </li>
        <li class="">
          <a href="#" ui-sref="advisor.Invoice">
            <i class="fa fa-file-o"></i>
            <span>Invoice</span>
          </a>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-file-image-o"></i>
            <span>Offer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('offers.create') }}"><i class="fa fa-circle-o"></i> Create Offer</a></li>
            <li><a href="{{ route('offers.index') }}"><i class="fa fa-circle-o"></i> Existing Offer</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-file-image-o"></i>
            <span>Gallery</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('adviser.galleries.index')}}"><i class="fa fa-circle-o"></i> Images/Video</a></li>
            <li><a href="#" ui-sref="advisor.profileBasicDetail"><i class="fa fa-circle-o"></i> Verification/Document</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->

<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <?php 
           $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            ?>
        <div class="text-center image">
          @if(isset(Auth::user()->basicDetail->image))
          <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" class="img-circle" style="max-width:90px;" alt="User Image">
          @elseif(isset(Auth::user()->basicDetail))
             @if(Auth::user()->basicDetail->gender == 'M')
               <img src="https://cdn-images-1.medium.com/fit/c/100/100/1*-MIXzyZAIS7SYBdFP8lOlw.png" class="img-circle" style="max-width:90px;" alt="User Image">
             @else
               <img src="https://cdn2.hercampus.com/jane%20doe.jpg" class="img-circle" style="max-width:90px;" alt="User Image">
             @endif
          @else
          <img src="{{ asset('images/user.png') }}" class="img-circle" style="max-width:90px;" alt="User Image">
          @endif
        </div>
        <div class="info text-center" style="position:relative;left:0">
          <label>Welcome {{ Auth::user()->name }}</label>
          <p>{{ Auth::user()->level }}</p>
            {!! Form::open(['route' => ['admin.profile.photo.upload'], 'method' => 'POST', 'files' => 'true']) !!}
            <input type="file" name="image" id="selectedFile3" style="display:none"  required  onchange='this.form.submit();'>
            <a><i class="fa fa-2x fa-edit" onclick="document.getElementById('selectedFile3').click();"></i></a>
            {!! Form::close() !!}
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li>
        <a href="{{route('admin.dashboard')}}"><i class="fa fa-line-chart"></i> <span>   Dashboard</span></a>
       </li>
        <li><a href="{{route('admin.profile.index')}}"><i class="fa fa-user" style="margin-right: 10px;"></i> Profile</a></li>
        
        @if(Auth::user()->level == 'superadministrator')
        <li class="treeview">
          <a href="">
            <i class="fa fa-users"></i>
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="treeview-menu active">
            <li><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i> All</a></li>
            @if($actual_link === route('users.create'))
            <li ><a href="{{route('users.create')}}"><i class="fa fa-circle-o "></i> New user </a></li>
            @else
            <li><a href="{{route('users.create')}}"><i class="fa fa-circle-o"></i> New user </a></li>
           @endif
           <li><a href="{{route('commissions.index')}}"><i class="fa fa-circle-o"></i> User Commission </a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="">
            <i class="fa fa-calendar"></i>
            <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('categories.index')}}" ><i class="fa fa-circle-o"></i> All</a></li>
            <li><a href="{{route('sub-categories.index')}}"><i class="fa fa-circle-o"></i> Sub-category</a></li>
            <li><a href="{{route('qualifications.index')}}"><i class="fa fa-circle-o"></i> Qualifications</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="">
            <i class="fa fa-calendar"></i>
            <span>User Access</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i> Roles</a></li>
            <li><a href="{{route('permissions.index')}}"><i class="fa fa-circle-o"></i> Permissions</a></li>
          </ul>
        </li>
        
        <!--<li><a href="{{route('consultations.index')}}"><i class="fa fa-sun-o" style="margin-right: 10px;"></i> Consultation Mode</a></li>-->
        @endif
        
        <li class="">
        <a href="{{route('manage')}}"><i class="fa fa-calendar-times-o"></i> <span>Manage Advisers</span></a>
       </li>
       
       <li class="treeview">
          <a href="">
            <i class="fa fa-circle-o"></i>
            <span>Appointments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--<li><a href="{{route('admin.bookings')}}"><i class="fa fa-circle-o"></i> All</a></li>-->
            <li><a href="{{route('admin.consultations')}}"><i class="fa fa-circle-o"></i> Consultation</a></li>
            <li><a href="{{route('admin.services')}}"><i class="fa fa-circle-o"></i> Services</a></li>
          </ul>
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
            <li><a href="{{route('admin.services.create')}}"><i class="fa fa-circle-o"></i> Add Service</a></li>
            <li><a href="{{route('admin.services.index')}}"><i class="fa fa-circle-o"></i> Listed Services</a></li>
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
            <li><a href="{{route('admin.posts.create')}}"><i class="fa fa-circle-o"></i> Write Blog</a></li>
            <li><a href="{{route('admin.posts.index')}}"><i class="fa fa-circle-o"></i> Posted Blogs</a></li>
          </ul>
        </li> 
        <li>
        </li>
       <li class="">
        <a href="{{ route('admin.asks.questions') }}"><i class="fa fa-files-o"></i> <span>Ask Us</span></a>
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
            <li><a href="{{ route('admin.offers.create') }}"><i class="fa fa-circle-o"></i> Create Offer</a></li>
            <li><a href="{{ route('admin.offers.index') }}"><i class="fa fa-circle-o"></i> Existing Offer</a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->

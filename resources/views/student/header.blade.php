<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: wheat;">
    <!-- Left navbar links -->

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{URL::to('student')}}" class="nav-link">Home</a>
        </li>
        <!--
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      -->
        <li class="nav-item">
            <a href="{{ route('logout')}}" class="nav-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

        </li>
    </ul>
    <div class="float-right d-none d-sm-inline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
    <div class="float-right d-none d-sm-inline"><i>Teacher Name :
            @php
                $teacher=\App\User::find(Auth::user()->uplink);
                //echo Auth::user()->uplink;
                echo (is_object ($teacher))?$teacher['name']:'-';
            @endphp
        </i></div>
    <!-- SEARCH FORM
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    -->


</nav>

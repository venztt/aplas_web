<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('lte/dist/img/logo-aplas.png')}}" alt="APLAS logo" class="brand-image elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">WebApps</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('lte/dist/img/teacher2.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{URL::to('teacher/crooms')}}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Class Rooms
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{URL::to('teacher/assignstudent')}}" class="nav-link">
                        <i class="nav-icon fas fa-check"></i>
                        <p>
                            Validate Student
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{URL::to('teacher/member')}}" class="nav-link">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                            Student Member
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

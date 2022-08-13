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
                <img src="{{asset('lte/dist/img/avatar3.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="treeview">
                    <a href="#" class="nav-link" style="background-color:#00b44e;color:black;">
                        <i class="nav-icon fas fa-space-shuttle"></i>
                        <p><b>Start Learning Java</b></p>
                    </a>
                    <ul role="menu" class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <a href="{{URL::to('student/tasks')}}" class="nav-link"><i
                                    class="nav-icon fas fa-angle-right"></i>
                                <p>Start learning</p>
                            </a>
                        </li>
                    </ul>
                    <ul role="menu" class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <a href="{{URL::to('student/tasks')}}" class="nav-link"><i
                                    class="nav-icon fas fa-angle-right"></i>
                                <p>Learning Results</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>

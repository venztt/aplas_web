<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{URL::to('admin/main')}}" class="brand-link">
        <img src="{{asset('lte/dist/img/logo-aplas.png')}}" alt="APLAS logo" class="brand-image elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">WebApps</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('lte/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Administrator</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.java.exercise.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>
                            Java Exercise
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.java.topic.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-spinner"></i>
                        <p>
                            Java Task
                        </p>
                    </a>
                </li>

                <li class="nav-header">Managements</li>
                <li class="nav-item">
                    <a href="{{URL::to('admin/resetpassword')}}" class="nav-link">
                        <i class="nav-icon fas fa-hand-pointer"></i>
                        <p>
                            Reset Password
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

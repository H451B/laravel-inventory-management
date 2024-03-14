<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard.index')}}" class="brand-link d-flex justify-content-center">
        <span class="brand-text font-weight-light">H451B</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->photo? storage_path(auth()->user()->photo) : asset('ui/backend/dist/img/user.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
                
            </div>
            <div class="info">
                <a href="{{route('profile.edit')}}" class="d-block">{{ auth()->user()->name }}
                    <i class='fas fa-angle-right' style="color: white"></i>
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item {{ request()->routeIs('dashboard.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @canany(['role-create','role-delete','role-edit','role-list'])
                <li class="nav-item {{ Str::startsWith(request()->url(), url('roles')) ? 'menu-open' : '' }}">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ Str::startsWith(request()->url(), url('roles')) ? 'active' : '' }}">
                        <i class="fas fa-fire nav-icon"></i>
                        <p>Roles & Permission</p>
                    </a>
                </li>                
                @endif

                @canany(['user-create','user-delete','user-edit','user-list'])
                <li class="nav-item {{ Str::startsWith(request()->url(), url('users')) ? 'menu-open' : '' }}">
                    <a href="{{route('users.index')}}" class="nav-link {{ Str::startsWith(request()->url(), url('users')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Employee</p>
                    </a>
                </li>    
                @endcanany

                {{-- Treeview --}}
                {{-- <li class="nav-item">
                        <i class="nav-icon fas fa-fire"></i>
                        <p>
                            A
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('roles.index')}}" class="nav-link">
                                <i class="fas fa-fire nav-icon" style="color: gray"></i>
                                <p>1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-fire nav-icon" style="color: gray"></i>
                                <p>2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Level 2
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

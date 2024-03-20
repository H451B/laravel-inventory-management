<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link d-flex justify-content-center">
        <span class="brand-text font-weight-light">H451B</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->photo ? storage_path(auth()->user()->photo) : asset('ui/backend/dist/img/user.jpg') }}"
                    class="img-circle elevation-2" alt="User Image">

            </div>
            <div class="info">
                <a href="{{ route('profile.edit') }}" class="d-block">{{ auth()->user()->name }}
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
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @canany(['role-create', 'role-delete', 'role-edit', 'role-list'])
                    <li class="nav-item {{ Str::startsWith(request()->url(), url('roles')) ? 'menu-open' : '' }}">
                        <a href="{{ route('roles.index') }}"
                            class="nav-link {{ Str::startsWith(request()->url(), url('roles')) ? 'active' : '' }}">
                            <i class="fas fa-fire nav-icon"></i>
                            <p>Roles & Permission</p>
                        </a>
                    </li>
                @endcanany

                @canany(['user-create', 'user-delete', 'user-edit', 'user-list'])
                    <li class="nav-item {{ Str::startsWith(request()->url(), url('users')) ? 'menu-open' : '' }}">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ Str::startsWith(request()->url(), url('users')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>Employee</p>
                        </a>
                    </li>
                @endcanany

                @canany(['supplier-create', 'supplier-delete', 'supplier-edit', 'supplier-list'])
                    <li class="nav-item {{ Str::startsWith(request()->url(), url('suppliers')) ? 'menu-open' : '' }}">
                        <a href="{{ route('suppliers.index') }}"
                            class="nav-link {{ Str::startsWith(request()->url(), url('suppliers')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>Supplier</p>
                        </a>
                    </li>
                @endcanany

                @canany(['product-create', 'product-delete', 'product-edit', 'product-list', 'product-category-create',
                    'product-category-delete', 'product-category-edit', 'product-category-list', 'product-type-create',
                    'product-type-delete', 'product-type-edit', 'product-type-list'])
                    <li class="nav-item {{ Str::startsWith(request()->url(), url('product')) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Product
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('products.index')}}"
                                    class="nav-link {{ Str::startsWith(request()->url(), url('products')) ? 'active' : '' }}">
                                    <i class="ml-2 far fa-circle nav-icon"></i>
                                    <p>Products</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('product.attributes.index')}}" class="nav-link {{ Str::startsWith(request()->url(), url('product-')) ? 'active' : '' }}">
                                    <i class="ml-2 far fa-circle nav-icon"></i>
                                    <p>Attributes</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany

                {{-- @canany(['customer-create', 'customer-delete', 'customer-edit', 'customer-list'])
                <li class="nav-item {{ Str::startsWith(request()->url(), url('customers')) ? 'menu-open' : '' }}">
                    <a href="{{route('customers.index')}}" class="nav-link {{ Str::startsWith(request()->url(), url('customers')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Customer</p>
                    </a>
                </li>    
                @endcanany --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

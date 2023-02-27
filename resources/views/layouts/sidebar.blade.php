<aside class="main-sidebar sidebar-light-success elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="https://th.bing.com/th/id/OIP.D2b5o5AIYbd0pkt0O73mAQHaHa?pid=ImgDet&w=640&h=640&rs=1"
            alt="AdminLTE Logo" class="brand-image img-circle elevation-1" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (auth()->user()->image)
                    <img src="{{ asset('storage/avatars/' . Auth::user()->image) }}" class="img-circle elevation-2"
                        alt="User Image">
                @else
                    <img src="{{ asset('vendor/admin-lte/img/user1-128x128.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('my.profile.index') }}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ Request::is('tag*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('tag*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Tags
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tag.create') }}"
                                class="nav-link {{ Request::is('tag/create') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-file-signature"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tag.index') }}"
                                class="nav-link {{ Request::is('tag/list') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-list-ol"></i>
                                <p>List Tags</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Category --}}
                <li class="nav-item has-treeview  {{ Request::is('category*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('category*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.create') }}"
                                class="nav-link {{ Request::is('category/create') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-file-signature"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}"
                                class="nav-link {{ Request::is('category/list') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-list-ol"></i>
                                <p>List Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Post --}}
                <li class="nav-item has-treeview  {{ Request::is('post*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('post*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-paste"></i>
                        <p>
                            Posts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('post.create') }}"
                                class="nav-link {{ Request::is('post/create') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-file-signature"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('post.index') }}"
                                class="nav-link {{ Request::is('post/list') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-list-ol"></i>
                                <p>List Posts</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (auth()->user()->role == 'SuperAdmin')
                    <li class="nav-item has-treeview  {{ Request::is('user*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Admin
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.create') }}"
                                    class="nav-link {{ Request::is('user/create') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-file-signature"></i>
                                    <p>Create Admin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                    class="nav-link {{ Request::is('user/list') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-list-ol"></i>
                                    <p>List Admin</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

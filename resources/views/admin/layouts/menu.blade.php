<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="{{ route('super_admin.dashboard') }}" title="Dashboard">
                <span class="brand-name text-truncate"> Admin Dashboard</span>
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">
            <ul class="nav sidebar-inner" id="sidebar-menu">

                <li class="active">
                    <a class="sidenav-item-link" href="{{ route('super_admin.dashboard') }}">
                        <i class="mdi mdi-desktop-mac-dashboard"></i>
                        <span class="nav-text" style="font-size: 9pt;">Dashboard</span>
                    </a>
                </li>

                {{-- Users --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#user"
                        aria-expanded="false" aria-controls="user">
                        <i class="mdi mdi-account-group"></i>
                        <span class="nav-text" style="font-size: 9pt;">Users</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="user" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.users-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"><i class="mdi mdi-account-group"></i> All Users</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>

                {{-- Shop --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#advertising" aria-expanded="false" aria-controls="advertising">
                        <i class="fas fa-store"></i>
                        <span class="nav-text" style="font-size: 9pt;">Shop</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="advertising" data-parent="#sidebar-menu">
                        <div class="sub-menu">

                            <li class="active">
                                <a class="sidenav-item-link"
                                    href="{{ route('super_admin.mainCategories-index') }}">
                                    <span class="nav-text"> <i class="fas fa-store"></i>Categories </span>
                                </a>
                            </li>
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.products-index') }}">
                                    <span class="nav-text"> <i class="fas fa-store"></i> Products </span>
                                </a>
                            </li>

                            <li class="active">
                                <a class="sidenav-item-link" href="{{route('super_admin.orders-index')}}">
                                    <span class="nav-text"> <i class="fas fa-magic"></i> Orders </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>

                {{-- Contact Us --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#contactUs" aria-expanded="false" aria-controls="contactUs">
                        <i class="fas fa-id-card"></i>
                        <span class="nav-text" style="font-size: 9pt;"> Contact Us</span> <b
                            class="caret"></b>
                    </a>
                    <ul class="collapse" id="contactUs" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.contact_us-index') }}">
                                    <i class="fas fa-id-card"></i>
                                    <span class="nav-text" style="font-size: 9pt;"> Contact Us Info</span>
                                </a>
                            </li>
                            <li class="active">
                                <a class="sidenav-item-link" href="{{route('super_admin.contact_us-requests')}}">
                                    <i class="fas fa-id-card"></i>
                                    <span class="nav-text"> Contact Messages</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>

                {{-- Logout : --}}
                <li class="active">
                    <a class="sidenav-item-link" href="{{ route('super_admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout"></i>
                        <span class="nav-text" style="font-size: 9pt;">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('super_admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>

    </div>
</aside>

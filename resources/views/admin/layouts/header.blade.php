<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <!-- search form -->
        <div class="search-form d-none d-lg-inline-block">
            <div class="input-group">
                {{-- <button type="button" name="search" id="search-btn" class="btn btn-flat">
                    <i class="mdi mdi-magnify"></i> --}}
                {{-- </button> --}}
                <input type="text" name="query" id="search-input" class="form-control" autofocus autocomplete="off"
                    disabled />
            </div>
            {{-- <div id="search-results-container">
                <ul id="search-results"></ul>
            </div> --}}
        </div>

        <div class="navbar-right">
            <ul class="nav navbar-nav">

                {{-- ===================================================================== --}}
                {{-- =========================== Setting Section ========================= --}}
                {{-- ===================================================================== --}}
                <li class="right-sidebar-in right-sidebar-2-menu">
                    <i class="mdi mdi-settings mdi-spin"></i>
                </li>

                {{-- ===================================================================== --}}
                {{-- ============================ User Account =========================== --}}
                {{-- ===================================================================== --}}
                <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        @if (isset(auth()->user()->profile_photo_path))
                            @if (auth()->user()->profile_photo_path && file_exists(auth()->user()->profile_photo_path))
                                <img src="{{ asset(auth()->user()->profile_photo_path) }}" class="user-image" alt="User Image" />
                            @else
                                <img src="{{ asset('front_end_style/images/profilesf.png') }}" class="user-image" alt="User Image" />
                            @endif
                        @else
                            <img src="{{ asset('front_end_style/images/profilesf.png') }}" class="user-image" alt="User Image" />
                        @endif
                        <span class="d-none d-lg-inline-block">{{ isset(auth()->user()->name_en) ? auth()->user()->name_en : 'Undefined' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- User image -->
                        <li class="dropdown-header">
                            @if (isset(auth()->user()->profile_photo_path))
                                @if (auth()->user()->profile_photo_path && file_exists(auth()->user()->profile_photo_path))
                                    <img src="{{ asset(auth()->user()->profile_photo_path) }}" class="img-circle" alt="User Image" />
                                @else
                                    <img src="{{ asset('front_end_style/images/profilesf.png') }}" class="img-circle" alt="User Image" />
                                @endif
                            @else
                                <img src="{{ asset('front_end_style/images/profilesf.png') }}" class="img-circle" alt="User Image" />
                            @endif

                            <div class="d-inline-block">
                                {{ isset(auth()->user()->name_en) ? auth()->user()->name_en : 'Undefined' }} <small class="pt-1">{{ isset(auth()->user()->email) ? auth()->user()->email : 'Undefined' }}</small>
                            </div>
                        </li>

                        <li>
                            <a href="#">
                                <i class="mdi mdi-account"></i> Profile
                            </a>
                        </li>

                        <li class="dropdown-footer">
                            <a href="{{ route('super_admin.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i
                                    class="mdi mdi-logout"></i> Logout </a>
                        </li>
                        <form id="logout-form" action="{{ route('super_admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>


</header>

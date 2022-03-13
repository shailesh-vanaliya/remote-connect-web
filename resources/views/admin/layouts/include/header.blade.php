<header class="main-header">
    <!-- Logo -->
    @php
    if(Auth::guard('admin')->user() == null){
    return redirect('login');
    }
    @endphp
    <!--  -->
    @if(Auth::guard('admin')->user())
    <a href="javascript:;" class="logo">
        @else
        <a href="javascript:;" class="logo">
            @endif
            <span class="logo-mini">
                <img src="{{ asset('public/img/futuristic.png') }}" alt="">
                <b></b>
            </span>
            <span class="logo-lg">
                <img src="{{ asset('public/img/futuristic.png') }}" alt="">
                <b style="font-size: 12px;">Futuristic Technologies</b></span>
        </a>
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <!-- <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a> -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <ul class="dropdown-menu dropdown-menus">
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-download text-green"></i> Import site
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if(Auth::guard('admin')->user())
                            {{ strtoupper(Auth::guard('admin')->user()->full_name) }}
                            @else
                            {{ strtoupper(Auth::guard('admin')->user()->full_name) }}
                            @endif
                            &nbsp; <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menus">
                            <li>
                                <ul class="menu">
                                    <li class="">
                                        <a href="{{ route('profile') }}">
                                            <i class="fa fa-user text-aqua"></i> Account
                                        </a>
                                    </li>
                                    @if(Auth::guard('admin')->user()->role == 'SUPERADMIN')
                                    <!-- <li class="">
                                        <a href="{{ route('reboot-server') }}">
                                            <i class="fa fa-refresh text-lime"></i> Reboot
                                        </a>
                                    </li> -->
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}">
                                            <i class="fa fa-power-off text-yellow"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @if(Auth::guard('admin')->user())
                    @if(Auth::guard('admin')->user()->image)
                    <li class="dropdown notifications-menu">
                        <div class="profile-image">
                            <img height="50" width="50" src="{{ asset('/images/'.Auth::guard('admin')->user()->image) }}" alt="">
                        </div>
                    </li>
                    @endif
                    @else
                    @if(Auth::user()->image)
                    <li class="dropdown notifications-menu">
                        <div class="profile-image">
                            <img height="50" width="50" src="{{ asset('/images/'.Auth::user()->image) }}" alt="">
                        </div>
                    </li>
                    @endif
                    @endif
                </ul>
            </div>
        </nav>
</header>
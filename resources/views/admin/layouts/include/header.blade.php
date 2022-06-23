<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a> 
        </li>-->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form> -->

    <!-- <input type="button" value="click to toggle fullscreen" onclick="toggleFullScreen(document.body)">
    <button >Go Fullscreen Mode</button>
<button onclick="closeFullscreen();">Close Fullscreen</button> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown mt-2">
            <i class="fa fa-compress" title="Maximize" onclick="openFullscreen();" aria-hidden="true">
            </i>
        </li>
        <li class="nav-item dropdown mt-2 ml-2">
        <i class="fa fa-expand " title="Minimize" onclick="closeFullscreen();" aria-hidden="true"></i>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge notificationCount">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="{{ asset('public/img/futuristic.png') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                FT111
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Temperature alert</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 22:04:10 11/05/2022</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="{{ asset('public/img/futuristic.png') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Device
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">High pressure Alert</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 22:04:10 18/05/2022</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="{{ asset('public/img/futuristic.png') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Machine
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Machine Trip</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 11:10:20 04/06/2022</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>

        <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-warning navbar-badge notificationCount">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li> -->
        <li class="nav-item">
            <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a> -->
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{ route('profile') }}" class="dropdown-item">
                    <i class="fa fa-user text-aqua"></i> Account
                </a>

                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item">
                    <i class="fa fa-power-off text-yellow"></i> Logout
                </a>
            </div>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if(Auth::guard('admin')->user())
                {{ strtoupper(Auth::guard('admin')->user()->full_name) }}
                @else
                {{ strtoupper(Auth::guard('admin')->user()->full_name) }}
                @endif
                <!-- &nbsp; <i class="fa fa-angle-down" aria-hidden="true"></i> -->
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
    </ul>
</nav>
<script>
    /* Get the element you want displayed in fullscreen */
    var elem = document.documentElement;

    /* Function to open fullscreen mode */
    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            /* Chrome, Safari & Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) {
            /* IE/Edge */
            elem = window.top.document.body; //To break out of frame in IE
            elem.msRequestFullscreen();
        }
    }

    /* Function to close fullscreen mode */
    function closeFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            window.top.document.msExitFullscreen();
        }
    }
</script>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
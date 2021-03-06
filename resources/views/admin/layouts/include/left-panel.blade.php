@php
$currRoute = Route::current()->getName();
if(Auth::guard('admin')->user() == null){
return redirect('login');
}
@endphp


<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            @if (!Auth::guest() && Auth::user()->role == 'CUSTOMER')
            <li class="{{ ($currRoute == 'user_dashboard' || $currRoute == '' || $currRoute == '') ? 'active' : '' }}">
                <a href="{{ route('user_dashboard') }}">
                    <i class="fa fa-id-card "></i><span> Dashboard</span>
                </a>
            </li>
            @else
            <li class="{{ ($currRoute == '' || $currRoute == 'admin_dashboard' || $currRoute == '') ? 'active' : '' }}">
                <a href="{{ route('admin_dashboard') }}">
                <img style="width:28px" src="{{ asset('public/ICON/Home.svg') }}" alt=""> <span class="spn"> Home</span>
                </a>
            </li>
           
            <li class="{{ ($currRoute == 'device.create'  ||   $currRoute == 'device-detail' || $currRoute == 'device.show' || $currRoute == 'device.edit' || $currRoute == 'device.index') ? 'active': '' }}">
                <a href="{{ url('/admin/device') }}">
                    <!-- <i class="fa fa-server"></i> <span>Device</span> -->
                    <img style="width:28px" src="{{ asset('public/ICON/Devices.svg') }}" alt=""> <span class="spn">Device</span>
                </a>
            </li>
            
            @if(Auth::guard('admin')->user()->role != 'USER')
            <li class="{{ ($currRoute == 'device-map.create' || $currRoute == 'device-map.show' || $currRoute == 'device-map.edit' || $currRoute == 'device-map.index') ? 'active': '' }}">
                <a href="{{ url('/admin/device-map')}}">
                    <!-- <i class="fa fa-address-book"></i> -->
                    <img style="width:28px" src="{{ asset('public/ICON/Device_map.svg') }}" alt=""> <span class="spn">Device Map</span>
                </a>
            </li>

            <li class="{{ ($currRoute == 'users.create' || $currRoute == 'users.show' || $currRoute == 'users.edit' || $currRoute == 'users.index') ? 'active': '' }}">
                <a href="{{ url('/admin/users') }}">
                    <!-- <i class="fa fa-users"></i> -->
                    <img style="width:28px" src="{{ asset('public/ICON/User.svg') }}" alt="">
                    <span class="spn"> Users</span>
                </a>
            </li>
         
            @endif
            @endif
        </ul>
    </section>
</aside>
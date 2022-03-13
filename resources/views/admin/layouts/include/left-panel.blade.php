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
                    <i class="fa fa-home"></i><span> Home</span>
                </a>
            </li>
           
            <li class="{{ ($currRoute == 'device.create' || $currRoute == 'device.show' || $currRoute == 'device.edit' || $currRoute == 'device.index') ? 'active': '' }}">
                <a href="{{ url('/admin/device') }}">
                    <i class="fa fa-server"></i> <span>Device</span>
                </a>
            </li>
            
            @if(Auth::guard('admin')->user()->role != 'USER')
            <li class="{{ ($currRoute == 'users.create' || $currRoute == 'users.show' || $currRoute == 'users.edit' || $currRoute == 'users.index') ? 'active': '' }}">
                <a href="{{ url('/admin/users') }}">
                    <i class="fa fa-users"></i><span> Users</span>
                </a>
            </li>
            @endif
            @endif
        </ul>
    </section>
</aside>
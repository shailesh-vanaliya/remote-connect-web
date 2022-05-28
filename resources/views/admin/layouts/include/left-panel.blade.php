@php
$currRoute = Route::current()->getName();
if(Auth::guard('admin')->user() == null){
return redirect('login');
}
@endphp

<!-- 
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
                    <img style="width:28px" src="{{ asset('public/ICON/Devices.svg') }}" alt=""> <span class="spn">Device</span>
                </a>
            </li>

            @if(Auth::guard('admin')->user()->role != 'USER')
            <li class="{{ ($currRoute == 'device-map.create' || $currRoute == 'device-map.show' || $currRoute == 'device-map.edit' || $currRoute == 'device-map.index') ? 'active': '' }}">
                <a href="{{ url('/admin/device-map')}}">
                    <img style="width:28px" src="{{ asset('public/ICON/Device_map.svg') }}" alt=""> <span class="spn">Device Map</span>
                </a>
            </li>

            <li class="{{ ($currRoute == 'users.create' || $currRoute == 'users.show' || $currRoute == 'users.edit' || $currRoute == 'users.index') ? 'active': '' }}">
                <a href="{{ url('/admin/users') }}">
                    <img style="width:28px" src="{{ asset('public/ICON/User.svg') }}" alt="">
                    <span class="spn"> Users</span>
                </a>
            </li>
            @endif
            @endif
        </ul>
    </section>
</aside> -->

 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('public/img/futuristic.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">IIOT Connect</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-flat text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <!-- <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> -->
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> -->
         
        
          <li class="{{ ($currRoute == '' || $currRoute == 'admin_dashboard' || $currRoute == '') ? 'active nav-item' : 'nav-item' }}">
                <a href="{{ route('admin_dashboard') }}" class="{{ ($currRoute == 'admin_dashboard'  ) ? 'active nav-link': 'nav-link' }}">
                    <img class="nav-icon" style="width:28px" src="{{ asset('public/ICON/Home.svg') }}" alt=""> <p > Home</p>
                </a>
            </li>

            <li class="{{ ($currRoute == 'device.create'  ||   $currRoute == 'device-detail' || $currRoute == 'device.show' || $currRoute == 'device.edit' || $currRoute == 'device.index') ? 'active nav-item': 'nav-item' }}">
                <a href="{{ url('/admin/device') }}" class="{{ ($currRoute == 'device.create'  ||   $currRoute == 'device-detail' || $currRoute == 'device.show' || $currRoute == 'device.edit' || $currRoute == 'device.index') ? 'active nav-link': 'nav-link' }}">
                    <img class="nav-icon" style="width:28px" src="{{ asset('public/ICON/Devices.svg') }}" alt=""> <p class="spn">Device</p>
                </a>
            </li>

            @if(Auth::guard('admin')->user()->role != 'USER')
            <li class="{{ ($currRoute == 'device-map.create' || $currRoute == 'device-map.show' || $currRoute == 'device-map.edit' || $currRoute == 'device-map.index') ? 'active nav-item': 'nav-item' }}">
                <a href="{{ url('/admin/device-map')}}" class="{{ ($currRoute == 'device-map.create' || $currRoute == 'device-map.show' || $currRoute == 'device-map.edit' || $currRoute == 'device-map.index') ? 'active nav-link': 'nav-link' }}">
                    <img class="nav-icon" style="width:28px" src="{{ asset('public/ICON/Device_map.svg') }}" alt=""> <p class="spn">Device Map</p>
                </a>
            </li>

            <li class="{{ ($currRoute == 'users.create' || $currRoute == 'users.show' || $currRoute == 'users.edit' || $currRoute == 'users.index') ? 'active nav-item': 'nav-item' }}">
                <a href="{{ url('/admin/users') }}" class="{{ ($currRoute == 'users.create' || $currRoute == 'users.show' || $currRoute == 'users.edit' || $currRoute == 'users.index') ? 'active nav-link': 'nav-link' }}">
                    <img  class="nav-icon" style="width:28px" src="{{ asset('public/ICON/User.svg') }}" alt="">
                    <p class="spn"> Users</p>
                </a>
            </li>
            @endif

          <!-- <li class="nav-item">
            <a href="{{ url('/admin/dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-warning"></i>
              <p>Dashboard</p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="{{ url('/admin/meter-dashboard') }}" class="{{ ($currRoute == 'meter-dashboard') ? 'active nav-link': 'nav-link' }}">
              <img  class="nav-icon" style="width:28px" src="{{ asset('public/ICON/pressure_gauge.svg') }}" alt="">
              <p>Pressure Dashboard</p>
            </a>
          </li> -->
          @if(Auth::guard('admin')->user()->role == 'SUPERADMIN')
          <li class="nav-item">
            <a href="{{ url('/admin/organization') }}" class="{{ ($currRoute == 'organization.create' || $currRoute == 'organization.show' || $currRoute == 'organization.edit' || $currRoute == 'organization.index') ? 'active nav-link': 'nav-link' }}">
              <!-- <i class="nav-icon far fa-circle text-info"></i> -->
              <img  class="nav-icon" style="width:28px" src="{{ asset('public/ICON/org.svg') }}" alt="">
              <p>Organization</p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{ url('/admin/notification') }}" class="{{ ($currRoute == 'notification.create' || $currRoute == 'notification.show' || $currRoute == 'notification.edit' || $currRoute == 'notification.index') ? 'active nav-link': 'nav-link' }}">
              <!-- <i class="nav-icon far fa-bell text-info"></i> -->
              <img  class="nav-icon" style="width:28px" src="{{ asset('public/ICON/notification.svg') }}" alt="">
              <p>Notification</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/alert-configration') }}" class="{{ ($currRoute == 'alert-configration.create' || $currRoute == 'alert-configration.show' || $currRoute == 'alert-configration.edit' || $currRoute == 'alert-configration.index') ? 'active nav-link': 'nav-link' }}">
              <!-- <i class="nav-icon far fa-comments text-info"></i> -->
              <img  class="nav-icon" style="width:28px" src="{{ asset('public/ICON/notificatin_config.svg') }}" alt="">
              <p>Alert Configuration</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/report') }}" class="{{ ($currRoute == 'report.create' || $currRoute == 'report.show' || $currRoute == 'report.edit' || $currRoute == 'report.index') ? 'active nav-link': 'nav-link' }}">
              <!-- <i class="nav-icon far fa-comment text-info"></i> -->
              <img  class="nav-icon" style="width:28px" src="{{ asset('public/ICON/report_gen.svg') }}" alt="">
              <p>Reports</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/report-configuration') }}" class="{{ ($currRoute == 'report-configuration.create' || $currRoute == 'report-configuration.show' || $currRoute == 'report-configuration.edit' || $currRoute == 'report-configuration.index') ? 'active nav-link': 'nav-link' }}">
              <!-- <i class="nav-icon far fa-comment text-info"></i> -->
              <img  class="nav-icon" style="width:28px" src="{{ asset('public/ICON/report_config.svg') }}" alt="">
              <p>Report Configuration</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/report-schedules') }}" class="{{ ($currRoute == 'report-schedules.create' || $currRoute == 'report-schedules.show' || $currRoute == 'report-schedules.edit' || $currRoute == 'report-schedules.index') ? 'active nav-link': 'nav-link' }}">
              <!-- <i class="nav-icon far fa-clock text-info"></i> -->
              <img  class="nav-icon" style="width:28px" src="{{ asset('public/ICON/report_schedule.svg') }}" alt="">
              <p>Report Schedules</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

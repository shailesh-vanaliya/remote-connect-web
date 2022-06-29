<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color"/>
    <title>IIOT CONNECT | @yield('title')</title>
    @include('admin.layouts.include.css')
</head>
<body class="sidebar-mini skin-black-light sidebar-collapse" >
<div class="wrapper">
    <!-- BEGIN TOP NAV -->

    @include('admin.layouts.include.header')

    @include('admin.layouts.include.left-panel')

    <div class="content-wrapper">

    @include('admin.layouts.include.breadcrumb')

    @include('admin.layouts.include.message')

    <!-- BEGIN PAGE CONTENT -->
    @yield('content')
    <a id="back-to-top" style="bottom: 4.0rem;background-color: #04AC9C;border-color: #04AC9C;" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
    <!-- /.content-wrapper -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.layouts.include.footer')
</div>
<!-- ./wrapper -->

@include('admin.layouts.include.js')
</body>
</html>

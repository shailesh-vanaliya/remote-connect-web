<!DOCTYPE html>
<html>

<head>
  <?php
  if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $dynamicUrl =  asset('') . 'public/';
  } else {
    $dynamicUrl =  asset('') . 'public/';
  }
  ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Futuristic Technologies | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="{{ $dynamicUrl.'/bower_components/bootstrap/dist/css/bootstrap.min.css' }}"> -->
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="{{ $dynamicUrl.'/bower_components/font-awesome/css/font-awesome.min.css' }}"> -->
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="{{ $dynamicUrl.'/bower_components/Ionicons/css/ionicons.min.css' }}"> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="{{ $dynamicUrl.'/dist/css/AdminLTE.min.css' }}"> -->
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="{{ $dynamicUrl.'/dist/css/skins/blue.css' }}"> -->
  <!-- <link rel="stylesheet" href="{{ $dynamicUrl.'/dist/css/custom.css' }}"> -->
  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="icon" href="{{ asset('/public/img/favicon.png') }}">
  <link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'plugins/fontawesome-free/css/all.min.css') }}"> -->


  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&display=swap" rel="stylesheet">
<link href="https://cdn.glitch.com/ a26fc0a9-d6cf-4b67-9100-2227eedddb62%2Fic_nfc_black_48dp.png?v=1573158259618" rel="icon"/>
<!-- <link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'bower_components/bootstrap/dist/css/bootstrap.min.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'bower_components/font-awesome/css/font-awesome.min.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'bower_components/fontawesome-free/css/all.min.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'bower_components/Ionicons/css/ionicons.min.css') }}"> -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<!-- <link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'bower_components/jvectormap/jquery-jvectormap.css') }}"> -->
<link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'dist/css/AdminLTE.min.css') }}">
<!-- <link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'dist/css/custom.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'dist/css/skins/_all-skins.min.css') }}"> -->
<link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'bower_components/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'plugins/datatables/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'plugins/fontawesome-free/css/all.min.css') }}">
<script src="{{ URL::asset($dynamicUrl.'plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<link href="{{ URL::asset($dynamicUrl.'css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ URL::asset($dynamicUrl.'js/select2.min.js') }}"></script>
<link rel="icon" href="{{ asset('/public/img/favicon.png') }}">

</head>

<body class="hold-transition login-page">
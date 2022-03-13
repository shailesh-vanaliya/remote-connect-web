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
  <link rel="stylesheet" href="{{ $dynamicUrl.'/bower_components/bootstrap/dist/css/bootstrap.min.css' }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ $dynamicUrl.'/bower_components/font-awesome/css/font-awesome.min.css' }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ $dynamicUrl.'/bower_components/Ionicons/css/ionicons.min.css' }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ $dynamicUrl.'/dist/css/AdminLTE.min.css' }}">
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="{{ $dynamicUrl.'/dist/css/skins/blue.css' }}"> -->
  <link rel="stylesheet" href="{{ $dynamicUrl.'/dist/css/custom.css' }}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="icon" href="{{ asset('/public/img/favicon.png') }}">
</head>

<body class="hold-transition login-page">
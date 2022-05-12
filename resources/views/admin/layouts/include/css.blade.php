<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php
    if($_SERVER['HTTP_HOST'] == 'localhost'){
        $dynamicUrl =  asset('').'public/';
    }else{
        $dynamicUrl = asset('').'public/';
    }
?>
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
<link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset($dynamicUrl.'plugins/fontawesome-free/css/all.min.css') }}">
<!-- <script src="{{ URL::asset($dynamicUrl.'plugins/jQuery/jQuery-2.1.4.min.js') }}"></script> -->
<script src="{{ URL::asset($dynamicUrl.'plugins/jquery/jquery.min.js') }}"></script>
<link href="{{ URL::asset($dynamicUrl.'plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ URL::asset($dynamicUrl.'plugins/select2/js/select2.min.js') }}"></script>
<link rel="icon" href="{{ asset('/public/img/favicon.png') }}">

<style>
    #cards {
        margin: 20px auto;
        width: 236px;
        height: 350px;
        overflow: hidden;
        padding: 0;
        background: #ccc;
        box-shadow: 0px 2px 2px 0px;
        border-radius: 12px;
    }
    #cards img {
        max-height: 360px;
        max-width: 239px;
    }
    #cards > div {
        background-color: #dcdcdc;
        border-radius: 4px;
        box-shadow: 0 1px 2px grey;
        background-position: center;
        background-repeat: no-repeat;
        background-size: 50%;
        transition: background-color 200ms ease-out;
        box-shadow: 0 1px 2px grey, inset -4px -4px 0 #dcdcdc,
        inset 4px 4px 0 #dcdcdc;
    }

    .card-top {
        margin-top: 30px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #4a4a4a;
        border: 1px solid #4a4a4a;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0 5px;
    }
</style>
@if(!empty($plugincss))
    @foreach ($plugincss as $pcss)
        <link href="{{ url('plugins') }}/{{ $pcss }}" rel="stylesheet">
    @endforeach
@endif

@if(!empty($css))
    @foreach ($css as $ccss)
        <link href="{{ url('css/frontend') }}/{{ $ccss }}" rel="stylesheet">
    @endforeach
@endif
<script>
    var site_url = "{{ url('/') }}/";
</script>

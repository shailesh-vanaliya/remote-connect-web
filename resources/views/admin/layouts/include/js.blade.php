<script>
    $('#mySelect2').select2({
        placeholder: "Select something",
        allowClear: true
    });
</script>
<?php
   if($_SERVER['HTTP_HOST'] == 'localhost'){
    $dynamicUrl =  asset('').'public/';
}else{
    $dynamicUrl = asset('').'public/';
}
?>
<script src="{{ URL::asset($dynamicUrl.'bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset($dynamicUrl.'bower_components/fastclick/lib/fastclick.js') }}"></script>
 <link href="{{ URL::asset($dynamicUrl.'build/css/intlTelInput.css') }}" rel="stylesheet">
<script src="{{ URL::asset($dynamicUrl.'dist/js/adminlte.min.js') }}"></script>
<link href="{{ asset($dynamicUrl.'css/jquery-ui.css') }}" rel="Stylesheet"></link>
<script src="{{ asset($dynamicUrl.'js/jquery.circliful.min.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/jquery-ui.js') }}" ></script>
<script src="{{ URL::asset($dynamicUrl.'bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ URL::asset($dynamicUrl.'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ URL::asset($dynamicUrl.'plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ URL::asset($dynamicUrl.'plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset($dynamicUrl.'plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ URL::asset($dynamicUrl.'bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::asset($dynamicUrl.'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset($dynamicUrl.'dist/js/demo.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/commonfunction.js') }}"></script>

<script src="{{ asset($dynamicUrl.'js/admin/customer.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/jquery.validate.min.js') }}"></script>
@if(!empty($pluginjs))
    @foreach ($pluginjs as $pjs)
        <script src="{{ asset($dynamicUrl) }}/{{ $pjs }}"></script>
        <!-- <script src="{{ asset($dynamicUrl.'assets/plugins') }}/{{ $pjs }}"></script> -->
    @endforeach
@endif

@if(!empty($js))
    @foreach ($js as $jss)
        <script src="{{ asset($dynamicUrl.'js/') }}/{{ $jss }}"></script>
    @endforeach
@endif
<script>
    $('.datepicker').datepicker({
        autoclose: true,
        format: "mm/dd/yyyy",
        endDate: new Date(),
        setDate: new Date(),
        showOn: "button",
        buttonImage: "images/calendar.gif",
        buttonImageOnly: true
    });
    Customer.init();
    jQuery(document).ready(function () {
@if(!empty($funinit))
@foreach ($funinit as $cjs)
{{ $cjs }}
@endforeach
@endif
});
</script>


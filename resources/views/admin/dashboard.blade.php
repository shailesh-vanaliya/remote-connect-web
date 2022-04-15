@extends('admin.layouts.admin')
@section('title', $pagetitle )
@section('content')
<section class="content">
    <!-- <h2>COMMING SOON</h2> -->
    <!-- <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Customer</span>
                    <span class="info-box-number">3</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-drivers-license"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Driver</span>
                    <span class="info-box-number">3</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-industry"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Seller</span>
                    <span class="info-box-number">3</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-first-order"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pending Order</span>
                    <span class="info-box-number">3</span>
                </div>
            </div>
        </div>
    </div> -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">   

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVqNumGk1DCDuthLx-X7YqutsMm6DReNA&region=india&libraries=places"></script>
    <div id="map" style="width: 1000px; height: 600px;"></div>
    
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDujLPXC7_jqMNn9KWpah2o1mYGUVbq2vk&region=india&libraries=places"></script>
    <div id="map" style="width: 1000px; height: 600px;"></div>

    <script type="text/javascript">
        var locations = [
            ['chandigarh', 30.7333, 76.7794, 8],
            ['Panjab', 31.1471, 75.3412, 6],
            ['Ahmadabad', 23.0225, 72.5714, 4],
            ['Baroda', 22.3072, 73.1812, 5],
            ['chennai', 13.0827, 80.2707, 3],
            ['bangalore ', 12.9716, 77.5946, 2],
            ['mumbai', 19.0760, 72.8777, 1]
        ];
        // var locations = "<?php echo ($locationList); ?>"
        // console.log(locations , " locationslocations")
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            // panControl: false,
            // zoomControl: true,
            // zoomControlOptions: {
            //     style: google.maps.ZoomControlStyle.LARGE
            // },
            mapTypeControl: false,
            streetViewControl: false,
            overviewMapControl: true,
            rotateControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: new google.maps.LatLng(20.5937, 78.9629),
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    </script> -->

</section>
@endsection
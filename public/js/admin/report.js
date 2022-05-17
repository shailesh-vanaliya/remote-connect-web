var Report = function () {
    var handleList = function () {

        $('.content').click(function () {
            $('.deviceInfomation').show();
        });


        //   function getLocationList() {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: site_url + "admin/device/ajaxAction",
            data: { 'action': 'getLocation' },
            success: function (data) {
                var output = JSON.parse(data);
                console.log(output)
                var locations = output;

                // var locations = [
                //     ['chandigarh', 30.7333, 76.7794, 8],
                //     ['Panjab', 31.1471, 75.3412, 6],
                //     ['Ahmadabad', 23.0225, 72.5714, 4],
                //     ['Baroda', 22.3072, 73.1812, 5],
                //     ['chennai', 13.0827, 80.2707, 3],
                //     ['bangalore ', 12.9716, 77.5946, 2],
                //     ['mumbai', 19.0760, 72.8777, 1]
                // ];
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

                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                        return function () {
                            infowindow.setContent(locations[i][0]);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }
            }
        });
        // }

    }
  
    return {
        init: function () {
            handleList();
        }
    }
}();
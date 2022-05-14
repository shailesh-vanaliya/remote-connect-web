var Dashboard = function () {
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

    var handleChart = function () {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: site_url + "admin/dashboard/ajaxAction",
            data: { 'action': 'getDashboard' },
            success: function (data) {
                console.log(data, " dasdsadsadasdsadas");
            }
        });
    }

    var meterDashboard = function () {
        console.log("fsdfsdsdf");

        var locations = [
            ['Ahmadabad', 23.0225, 72.5714, 4],
        ];
        console.log(locations, " locationslocations")
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            mapTypeControl: false,
            streetViewControl: false,
            overviewMapControl: true,
            rotateControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: new google.maps.LatLng(23.0225, 72.5714),
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
    var meterDashboardV2 = function () {
        console.log("fsdfsdsdf");

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $visitorsChart = $('#visitors-chart')
        // eslint-disable-next-line no-unused-vars
     


        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: site_url + "admin/dashboard-meter/ajaxAction",
            data: { 'action': 'getChartData' },
            success: function (datas) {
                let outPut = JSON.parse(datas);
                console.log(outPut, " outPut");
                // console.log(outPut.Temperature_PV);
                // console.log(outPut.Timestamps);
                var visitorsChart = new Chart($visitorsChart, {
                    data: {
                        labels: [outPut.date],
                        // labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
                        // labels: ['2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12'],
                        datasets: [
                            {
                                type: 'line',
                                // data: [outPut.temp],
                                data: [30,33,40,43,47,48,49,50,51,52,54,55,58,59,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87],
                                backgroundColor: 'transparent',
                                borderColor: '#007bff',
                                pointBorderColor: '#007bff',
                                pointBackgroundColor: '#007bff',
                                fill: false
                                // pointHoverBackgroundColor: '#007bff',
                                // pointHoverBorderColor    : '#007bff'
                            },
                            // {
                            //   type: 'line',
                            //   data: [60, 80, 70, 67, 80, 77, 100,111,145],
                            //   backgroundColor: 'tansparent',
                            //   borderColor: '#ced4da',
                            //   pointBorderColor: '#ced4da',
                            //   pointBackgroundColor: '#ced4da',
                            //   fill: false
                            //   // pointHoverBackgroundColor: '#ced4da',
                            //   // pointHoverBorderColor    : '#ced4da'
                            // }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                // display: false,
                                gridLines: {
                                    display: true,
                                    lineWidth: '4px',
                                    color: 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks: $.extend({
                                    beginAtZero: true,
                                    suggestedMax: 200
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            }]
                        }
                    }
                })
            }
        });
    }
    return {
        init: function () {
            handleList();
        },
        initChart: function () {
            handleChart();
        },
        initMeter: function () {
            meterDashboard();
            meterDashboardV2();
        },
    }
}();
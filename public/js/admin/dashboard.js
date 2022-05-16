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

    function toogleDataSeries(e) {
        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        e.chart.render();
    }

    var meterDashboardV2 = function () {
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }
        var mode = 'index'
        var intersect = true

        var $visitorsChart = $('#visitors-chart')

        function getDate() {

            let startDate = ($('#startDate').val() != undefined) ? $('#startDate').val() : '';
            let endDate = ($('#endDate').val() != undefined) ? $('#endDate').val() : '';
            console.log(startDate, " startDate")
            console.log(endDate, " endDate")
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: site_url + "admin/dashboard-meter/ajaxAction",
                data: { 'action': 'getChartData', 'endDate': endDate, 'startDate': startDate },
                success: function (out) {
                    let outPut = JSON.parse(out);
                    let arr = [];
                    for (let i = 0; i < outPut.length; i++) {
                        let resultX = {};
                        resultX['x'] = new Date(outPut[i].dtm);
                        resultX['y'] = outPut[i].Temperature_PV;
                        arr[i] = resultX;
                    }
                    console.log(arr)
                    if (arr) {
                        var options = {
                            animationEnabled: true,
                            zoomEnabled: true,
                            theme: "light2",
                            title: {
                                text: "Temperature Chart"
                            },
                            axisX: {
                                valueFormatString: "DD MMM HH-MM",
                                // prefix: "°C",
                            },
                            axisY: {
                                title: "Temperature",
                                suffix: "°C",
                                minimum: 30
                            },
                            toolTip: {
                                shared: true
                            },
                            legend: {
                                cursor: "pointer",
                                verticalAlign: "bottom",
                                horizontalAlign: "left",
                                dockInsidePlotArea: true,
                                itemclick: toogleDataSeries
                            },
                            data: [{
                                type: "line",
                                showInLegend: true,
                                name: "Dates",
                                markerType: "circle",
                                xValueFormatString: "HH mm DD MMM, YYYY",
                                color: "#F08080",
                                yValueFormatString: "#,##0K",
                                dataPoints: arr
                            },
                            ]
                        };
                        $("#chartContainer").CanvasJSChart(options);
                    }


                }
            });
        }


        $('.search').click(function () {
            // getDate()
        });
        $('.reset').click(function () {
            $('#startDate').val('')
            $('#endDate').val('');
            // getDate()
        });
        // getDate();
    }
    var meterDashboardV3 = function () {
        $('#dateRange').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
              format: 'DD/MM/YYYY hh:mm A'
            }
          })

        $('.search').click(function () {
            getAmChart()
        });
        $('.reset').click(function () {
            $('#startDate').val('')
            $('#endDate').val('');
            $('#dateRange').val('');
            getAmChart()
        });
       
        getAmChart();
       
        var root = am5.Root.new("chartdiv");
        function getAmChart() {
            console.log($('#dateRange').val() , " ============")
            let startDate = ($('#startDate').val() != undefined) ? $('#startDate').val() : '';
            let endDate = ($('#endDate').val() != undefined) ? $('#endDate').val() : '';
            let dateRange = ($('#dateRange').val() != undefined) ? $('#dateRange').val() : '';
            
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: site_url + "admin/dashboard-meter/ajaxAction",
                data: { 'action': 'getChartDataV2', 'endDate': endDate, 'startDate': startDate,'dateRange': dateRange },
                success: function (out) {
                    let data = JSON.parse(out);
                  
                    // Set themes
                    // https://www.amcharts.com/docs/v5/concepts/themes/
                    root.setThemes([
                        am5themes_Animated.new(root)
                    ]);
            
                    root.dateFormatter.setAll({
                        dateFormat: "yyyy-MM-dd HH:mm:ss",
                        dateFields: ["valueX"]
                    });
                    // am5.ready(function () {
                        root.container.children.clear()
                        // Create chart
                        // https://www.amcharts.com/docs/v5/charts/xy-chart/
                        var chart = root.container.children.push(am5xy.XYChart.new(root, {
                            focusable: true,
                            panX: true,
                            panY: true,
                            wheelX: "panX",
                            wheelY: "zoomX",
                            pinchZoomX: true
                        }));
                        
                        var easing = am5.ease.linear;


                        // Create axes
                        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                        var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                            maxDeviation: 0.1,
                            groupData: false,
                            baseInterval: {
                                timeUnit: "second",
                                count: 20
                            },
                            renderer: am5xy.AxisRendererX.new(root, {

                            }),
                            tooltip: am5.Tooltip.new(root, {})
                        }));

                        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                            maxDeviation: 0.2,
                            renderer: am5xy.AxisRendererY.new(root, {})
                        }));


                        // Add series
                        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                        var series = chart.series.push(am5xy.LineSeries.new(root, {
                            minBulletDistance: 10,
                            connect: true,
                            xAxis: xAxis,
                            yAxis: yAxis,
                            valueYField: "value",
                            valueXField: "date",
                            tooltip: am5.Tooltip.new(root, {
                                pointerOrientation: "horizontal",
                                labelText: "{valueY}"
                            })
                        }));

                        series.fills.template.setAll({
                            fillOpacity: 0.2,
                            visible: true
                        });

                        series.strokes.template.setAll({
                            strokeWidth: 1.5
                        });


                        // Set up data processor to parse string dates
                        // https://www.amcharts.com/docs/v5/concepts/data/#Pre_processing_data
                        series.data.processor = am5.DataProcessor.new(root, {
                            dateFormat: "yyyy-MM-dd HH:mm:ss",
                            dateFields: ["date"]
                        });
                        series.data.setAll([]);
                        // chart.series.removeIndex(0).dispose();
                        series.data.setAll(data);

                        series.bullets.push(function () {
                            var circle = am5.Circle.new(root, {
                                radius: 4,
                                fill: root.interfaceColors.get("background"),
                                stroke: series.get("fill"),
                                strokeWidth: 2
                            })

                            return am5.Bullet.new(root, {
                                sprite: circle
                            })
                        });


                        // Add cursor
                        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                            xAxis: xAxis,
                            behavior: "none"
                        }));
                        cursor.lineY.set("visible", false);

                        // add scrollbar
                        chart.set("scrollbarX", am5.Scrollbar.new(root, {
                            orientation: "horizontal"
                        }));
                        // Make stuff animate on load
                        // https://www.amcharts.com/docs/v5/concepts/animations/
                        chart.appear(1000, 100);
                    // });

                }
            });

        }

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
            meterDashboardV3();
        },
    }
}();
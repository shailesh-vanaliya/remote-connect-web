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
                        resultX['x'] = new Date(outPut[i].Timestamp);
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
                                // dataPoints: outPut.common
                                // dataPoints: [
                                //     { x: new Date(2017, 10, 1, 14, 12), y: 63 },
                                //     { x: new Date(2017, 10, 2, 11, 12), y: 69 },
                                //     { x: new Date(2017, 10, 2, 11, 20), y: 61 },
                                //     { x: new Date(2017, 10, 2, 11, 23), y: 61 },
                                //     { x: new Date(2017, 10, 3, 10, 23), y: 65 },
                                //     { x: new Date(2017, 10, 4, 12, 23), y: 70 },
                                //     { x: new Date(2017, 10, 5, 12, 23), y: 71 },
                                //     // { x: new Date(2017, 10, 6), y: 65 },
                                //     // { x: new Date(2017, 10, 7), y: 73 },
                                //     // { x: new Date(2017, 10, 8), y: 96 },
                                //     // { x: new Date(2017, 10, 9), y: 84 },
                                //     // { x: new Date(2017, 10, 10), y: 85 },
                                //     // { x: new Date(2017, 10, 11), y: 86 },
                                //     // { x: new Date(2017, 10, 12), y: 94 },
                                //     // { x: new Date(2017, 10, 13), y: 97 },
                                //     // { x: new Date(2017, 10, 14), y: 86 },
                                //     // { x: new Date(2017, 10, 15), y: 89 },
                                //     // { x: new Date(2018, 05, 15), y: 95 },
                                //     // { x: new Date(2018, 10, 15), y: 84 },
                                //     // { x: new Date(2020, 10, 15), y: 88 }
                                // ]
                            },
                                // {
                                // 	type: "line",
                                // 	showInLegend: true,
                                // 	name: "Actual Sales",
                                // 	lineDashType: "dash",
                                // 	yValueFormatString: "#,##0K",
                                // 	dataPoints: [
                                // 		{ x: new Date(2017, 10, 1), y: 60 },
                                // 		{ x: new Date(2017, 10, 2), y: 57 },
                                // 		{ x: new Date(2017, 10, 3), y: 51 },
                                // 		{ x: new Date(2017, 10, 4), y: 56 },
                                // 		{ x: new Date(2017, 10, 5), y: 54 },
                                // 		{ x: new Date(2017, 10, 6), y: 55 },
                                // 		{ x: new Date(2017, 10, 7), y: 54 },
                                // 		{ x: new Date(2017, 10, 8), y: 69 },
                                // 		{ x: new Date(2017, 10, 9), y: 65 },
                                // 		{ x: new Date(2017, 10, 10), y: 66 },
                                // 		{ x: new Date(2017, 10, 11), y: 63 },
                                // 		{ x: new Date(2017, 10, 12), y: 67 },
                                // 		{ x: new Date(2017, 10, 13), y: 66 },
                                // 		{ x: new Date(2017, 10, 14), y: 56 },
                                // 		{ x: new Date(2017, 10, 15), y: 64 }
                                // 	]
                                // }
                            ]
                        };
                        $("#chartContainer").CanvasJSChart(options);
                    }


                    // // console.log(outPut.Temperature_PV);
                    // // console.log(outPut.Timestamps);
                    // var visitorsChart = new Chart($visitorsChart, {
                    //     data: {
                    //         labels: [outPut.date],
                    //         // labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
                    //         // labels: ['2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12', '2022-05-12'],
                    //         datasets: [
                    //             {
                    //                 type: 'line',
                    //                 // data: [outPut.temp],
                    //                 data: [30,33,40,43,47,48,49,50,51,52,54,55,58,59,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87],
                    //                 backgroundColor: 'transparent',
                    //                 borderColor: '#007bff',
                    //                 pointBorderColor: '#007bff',
                    //                 pointBackgroundColor: '#007bff',
                    //                 fill: false
                    //                 // pointHoverBackgroundColor: '#007bff',
                    //                 // pointHoverBorderColor    : '#007bff'
                    //             },
                    //             // {
                    //             //   type: 'line',
                    //             //   data: [60, 80, 70, 67, 80, 77, 100,111,145],
                    //             //   backgroundColor: 'tansparent',
                    //             //   borderColor: '#ced4da',
                    //             //   pointBorderColor: '#ced4da',
                    //             //   pointBackgroundColor: '#ced4da',
                    //             //   fill: false
                    //             //   // pointHoverBackgroundColor: '#ced4da',
                    //             //   // pointHoverBorderColor    : '#ced4da'
                    //             // }
                    //         ]
                    //     },
                    //     options: {
                    //         maintainAspectRatio: false,
                    //         tooltips: {
                    //             mode: mode,
                    //             intersect: intersect
                    //         },
                    //         hover: {
                    //             mode: mode,
                    //             intersect: intersect
                    //         },
                    //         legend: {
                    //             display: false
                    //         },
                    //         scales: {
                    //             yAxes: [{
                    //                 // display: false,
                    //                 gridLines: {
                    //                     display: true,
                    //                     lineWidth: '4px',
                    //                     color: 'rgba(0, 0, 0, .2)',
                    //                     zeroLineColor: 'transparent'
                    //                 },
                    //                 ticks: $.extend({
                    //                     beginAtZero: true,
                    //                     suggestedMax: 200
                    //                 }, ticksStyle)
                    //             }],
                    //             xAxes: [{
                    //                 display: true,
                    //                 gridLines: {
                    //                     display: false
                    //                 },
                    //                 ticks: ticksStyle
                    //             }]
                    //         }
                    //     }
                    // })
                }
            });
        }


        $('.search').click(function () {
            getDate()
        });
        $('.reset').click(function () {
            $('#startDate').val('')
            $('#endDate').val('');
            getDate()
        });
        getDate();
    }
    var meterDashboardV3 = function () {
        am5.ready(function () {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");


            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true
            }));


            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "none"
            }));
            cursor.lineY.set("visible", false);


            // Generate random data
            var date = new Date();
            date.setHours(0, 0, 0, 0);
            var value = 1000;
            var volume = 100000;

            function generateData() {
                value = Math.round((Math.random() * 10 - 5) + value);
                volume = Math.round((Math.random() * 1000 - 500) + volume);

                am5.time.add(date, "day", 1);
                // add another if it's saturday
                if (date.getDay() == 6) {
                    am5.time.add(date, "day", 1);
                }
                // add another if it's sunday
                if (date.getDay() == 0) {
                    am5.time.add(date, "day", 1);
                }

                return {
                    date: date.getTime(),
                    value: value,
                    // volume: volume
                };
            }

            function generateDatas(count) {
                var data = [];
                // for (var i = 0; i < count; ++i) {
                //     data.push(generateData());
                // }
                // console.log(data, " datadatadata")
                // return data;

                let startDate = ($('#startDate').val() != undefined) ? $('#startDate').val() : '';
                let endDate = ($('#endDate').val() != undefined) ? $('#endDate').val() : '';
          
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
                            resultX['date'] = new Date(outPut[i].Timestamp).getTime();
                            resultX['value'] = outPut[i].Temperature_PV;
                            arr[i] = resultX;
                            data[i] = resultX;
                        } 
                        return arr;
                    }
                });
                return data;
            }

            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xAxis = chart.xAxes.push(am5xy.GaplessDateAxis.new(root, {
                maxDeviation: 0,
                baseInterval: {
                    timeUnit: "day",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {}),
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                extraMin: 0.2,
                renderer: am5xy.AxisRendererY.new(root, {})
            }));


            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(am5xy.LineSeries.new(root, {
                name: "Series",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            // y axis for volume
            var volumeAxisRenderer = am5xy.AxisRendererY.new(root, {});
            volumeAxisRenderer.grid.template.set("forceHidden", true);
            volumeAxisRenderer.labels.template.set("forceHidden", true);

            var volumeAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                height: am5.percent(25),
                y: am5.percent(100),
                centerY: am5.percent(100),
                panY: false,
                renderer: volumeAxisRenderer
            }));

            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var volumeSeries = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Volume Series",
                xAxis: xAxis,
                yAxis: volumeAxis,
                valueYField: "volume",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            volumeSeries.columns.template.setAll({ fillOpacity: 0.8, strokeOpacity: 0, width: am5.percent(40) })

            // Add scrollbar
            // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));


            // Set data
            // var data = generateDatas(200);
            // console.log(data ," datadatadatadatadata")
            // if(data){
            //     series.data.setAll(data);
            //     volumeSeries.data.setAll(data);
    
            //     // Make stuff animate on load
            //     // https://www.amcharts.com/docs/v5/concepts/animations/
            //     series.appear(1000);
            //     chart.appear(1000, 100);
            // }

            let startDate = ($('#startDate').val() != undefined) ? $('#startDate').val() : '';
            let endDate = ($('#endDate').val() != undefined) ? $('#endDate').val() : '';
   
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
                        resultX['date'] = new Date(outPut[i].Timestamp).getTime();
                        resultX['value'] = outPut[i].Temperature_PV;
                        arr[i] = resultX;
                        // data[i] = resultX;
                    } 
                    console.log(arr)
                  if(arr){
                    series.data.setAll(arr);
                    volumeSeries.data.setAll(arr);
                    series.appear(1000);
                    chart.appear(1000, 100);
                  }
                }
            });


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
            meterDashboardV3();
        },
    }
}();
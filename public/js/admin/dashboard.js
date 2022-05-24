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
                let latitude = ($('.latitude').val() != '' && $('.latitude').val() != undefined) ? $('.latitude').val() : ''
                let longitude = ($('.longitude').val() != '' && $('.longitude').val() != undefined) ? $('.longitude').val() : ''
                let location = $('.location').val()
                // var locations = [
                //     [location, latitude, longitude]
                  
                // ];
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 5,
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
        var locations = [
            ['Ahmadabad', 23.0225, 72.5714, 4],
        ];
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
                            autoSetClassName: true,
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

        $("input[data-bootstrap-switch]").each(function(){
            $('#'+$(this).attr("id")).bootstrapSwitch('state', $(this).prop('checked'));
        });


        if($("#moisture").val() == 1){
            $("#moisture").bootstrapSwitch('state', true);
        }else{
            $("#moisture").bootstrapSwitch('state', false);
        }

        if($("#machine").val() == 1){
            $("#machine").bootstrapSwitch('state', true);
        }else{
            $("#machine").bootstrapSwitch('state', false);
        }


        $('#dateRange').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            autoUpdateInput: true,
            timePicker24Hour: true,
            locale: {
              format: 'DD/MM/YYYY hh:mm A'
            }
        })
         
        $('.search').click(function () {
            getAmChart()
        });
         
        $('.applyBtn').click(function () {
            let startDate = $('#dateRange').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm');
            let endDate = $('#dateRange').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm');
            $('#startDate').val(startDate);
            $('#endDate').val(endDate);
        });

        $('.reset').click(function () {
            $('#startDate').val('')
            $('#endDate').val('');
            $('#dateRange').val('');
            getAmChart()
        });
      
        $("body").on("change", '.customSelect', function() {
            console.log($('#customSelect').val() , " ====")
            let startDate = '';
            let endDate = '';
            $('.dateDiv').hide();
            if($('#customSelect').val() == 'Today'){
                startDate = moment().format('YYYY-MM-DD') +' 00:00';
                endDate = moment().format('YYYY-MM-DD') +' 23:59';
            }else if($('#customSelect').val() == 'Yesterday'){
                startDate = moment().subtract(1, 'days').format('YYYY-MM-DD') +' 00:00';
                endDate = moment().subtract(1, 'days').format('YYYY-MM-DD') +' 23:59';
            }else if($('#customSelect').val() == 'Last 7 Days'){
                startDate = moment().subtract(6, 'days').format('YYYY-MM-DD') +' 00:00';
                endDate = moment().format('YYYY-MM-DD') +' 23:59';
            }else if($('#customSelect').val() == 'Last 30 Days'){
                startDate = moment().subtract(29, 'days').format('YYYY-MM-DD') +' 00:00';
                endDate = moment().format('YYYY-MM-DD') +' 23:59';
            }
            if($('#customSelect').val() == 'This Month'){
                startDate = moment().startOf('month').format('YYYY-MM-DD') +' 00:00';
                endDate = moment().endOf('month').format('YYYY-MM-DD') +' 23:59';
            }
            if($('#customSelect').val() == 'Last Month'){
                startDate = moment().subtract(1, 'month').startOf('month').format('YYYY-MM-DD') +' 00:00';
                endDate = moment().subtract(1, 'month').endOf('month').format('YYYY-MM-DD') +' 23:59';
            }
            if($('#customSelect').val() == 'Custom'){
                 $('.dateDiv').show();
                 startDate = $('#dateRange').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm');
                 endDate = $('#dateRange').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm');
            }
            console.log(startDate, " startDate")
            console.log(endDate, " endDate")
            $('#startDate').val(startDate);
            $('#endDate').val(endDate);

        });
      
        $('input[name="machine"]').on('switchChange.bootstrapSwitch', function (event, state) 
        {
            let values = (state == true) ? 1 : 0;
            let deviceId = $('.deviceId').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: site_url + "admin/dashboard-meter/ajaxAction",
                data: { 'action': 'sendMachine','value': values ,'deviceId' : deviceId},
                success: function (datas) {
                    let output = JSON.parse(datas);
                    showToster(output.status,output.message)
                }
            });
        });
        
        $('input[name="moisture"]').on('switchChange.bootstrapSwitch', function (event, state) 
        {
            let values = (state == true) ? 1 : 0;
            let deviceId = $('.deviceId').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: site_url + "admin/dashboard-meter/ajaxAction",
                data: { 'action': 'sendMoisture','value': values ,'deviceId' : deviceId},
                success: function (datas) {
                    let output = JSON.parse(datas);
                    showToster(output.status,output.message)
                }
            });
        });

        getAmChart();
       $('.customSelect').trigger('change');
        var root = am5.Root.new("chartdiv");
        function getAmChart() {

            let startDate = ($('#startDate').val() != undefined) ? $('#startDate').val() : '';
            let endDate = ($('#endDate').val() != undefined) ? $('#endDate').val() : '';
            let dateRange = ($('#dateRange').val() != undefined) ? $('#dateRange').val() : '';
            let modem_id = ($('#modem_id').val() != undefined) ? $('#modem_id').val() : '';
            // console.log($('#dateRange').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm'))
            // console.log($('#dateRange').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm'))
            // let startDate = $('#dateRange').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm');
            // let endDate = $('#dateRange').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm');
            // $('#startDate').val(startDate);
            // $('#endDate').val(endDate);
             if($('#customSelect').val() == 'Today'){
                startDate = moment().format('YYYY-MM-DD') +' 00:00';
                endDate = moment().format('YYYY-MM-DD') +' 23:59';
            }

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: site_url + "admin/dashboard-meter/ajaxAction",
                data: { 'action': 'getChartDataV2', 'endDate': endDate, 'startDate': startDate,'dateRange': dateRange, "modem_id":modem_id },
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
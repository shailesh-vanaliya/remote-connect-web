var DashboardV2 = function () {
    var handleList = function () {

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
            $('#customSelect').val('Today')
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

        var root = am5.Root.new("chartdiv");
        // var exporting = am5plugins_exporting.Exporting.new(root, {
        //     menu: am5plugins_exporting.ExportingMenu.new(root, {})
        //   });

          var exporting = am5plugins_exporting.Exporting.new(root, {
            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
            filePrefix: "chart"
          });

        //   setTimeout(function() {
        //     exporting.export("png").then(function(imgData) {
        //       document.getElementById("myImage").src = imgData;
        //     });
        //   }, 2000);

          
    //     function getAmChart() {

    //        let startDate = ($('#startDate').val() != undefined) ? $('#startDate').val() : '';
    //        let endDate = ($('#endDate').val() != undefined) ? $('#endDate').val() : '';
    //        let dateRange = ($('#dateRange').val() != undefined) ? $('#dateRange').val() : '';
    //        let modem_id = ($('#modem_id').val() != undefined) ? $('#modem_id').val() : '';
      
    //         if($('#customSelect').val() == 'Today'){
    //            startDate = moment().format('YYYY-MM-DD') +' 00:00';
    //            endDate = moment().format('YYYY-MM-DD') +' 23:59';
    //        }
           
         
    //        $.ajax({
    //            type: "POST",
    //            headers: {
    //                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
    //            },
    //            url: site_url + "admin/dashboardV2/ajaxAction",
    //            data: { 'action': 'getChartDataV2', 'endDate': endDate, 'startDate': startDate,'dateRange': dateRange, "modem_id":modem_id },
    //            success: function (out) {
    //                let result = JSON.parse(out);
    //                console.log(result,"result")
               
    //                root.setThemes([
    //                 am5themes_Animated.new(root)
    //             ]);
    //                var chart = root.container.children.push(am5xy.XYChart.new(root, {
    //                    panX: true,
    //                    panY: true,
    //                    wheelX: "panX",
    //                    wheelY: "zoomX",
    //                    maxTooltipDistance: 0,
    //                    pinchZoomX: true
    //                }));
       
       
    //                var date = new Date();
    //                // date.setHours(0, 0, 0, 0);
    //                var value = 0;
       
    //                var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
    //                    maxDeviation: 0.2,
    //                    baseInterval: {
    //                        // timeUnit: "time",
    //                        timeUnit: "minute",
    //                        // timeUnit: "day",
    //                        count: 1
    //                    },
    //                    renderer: am5xy.AxisRendererX.new(root, {}),
    //                    tooltip: am5.Tooltip.new(root, {})
    //                }));
       
    //                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
    //                    renderer: am5xy.AxisRendererY.new(root, {})
    //                }));
    //                function generateData(aaa) {
    //                 //    console.log(aaa)
    //                    value = aaa.value;
    //                    // value = Math.round((Math.random() * 10 - 4.2) + value);
    //                    am5.time.add(new Date(aaa.date), "day", 1);
    //                 //    console.log(new Date(aaa.date), "datedatedate")
    //                 //    console.log(new Date(aaa.date).getTime(), "ssss")
    //                    return {
    //                        date: new Date(aaa.date).getTime(),
    //                        value: value
    //                    };
    //                }
           
    //                function generateDatas(count) {
    //                    var data = [];
    //                    // for (var i = 0; i < 10; ++i) {
    //                    for (var i = 0; i < count.length; ++i) {
    //                        // let aaa = []
    //                        // var dateString = count[i].date
    //                        // aaa = {date:count[i].date+"0000",  value :count[i].value};
    //                        // data.push(aaa)
    //                        // console.log(aaa, "aaaaaa");
    //                        // data.push(generateData());
    //                        data.push(generateData(count[i]));
    //                    }
    //                    return data;
    //                }
    //                console.log(result.length, "result.lengthresult.length")
    //                for (var i = 0; i < result.length; i++) {
    //                    var series = chart.series.push(am5xy.LineSeries.new(root, {
    //                        name: "Series " + i,
    //                        xAxis: xAxis,
    //                        yAxis: yAxis,
    //                        valueYField: "value",
    //                        valueXField: "date",
    //                        legendValueText: "{valueY}",
    //                        tooltip: am5.Tooltip.new(root, {
    //                            pointerOrientation: "horizontal",
    //                            labelText: "{valueY}"
    //                        })
    //                    }));
       
    //                    // date = new Date();
    //                    // date.setHours(0, 0, 0, 0);
    //                    // value = 0;
       
    //                    // var data = generateDatas(10);
    //                    var data = generateDatas(result[i]);
    //                    // var data = result[i];
    //                    series.data.processor = am5.DataProcessor.new(root, {
    //                        dateFormat: "yyyy-MM-dd HH:mm:ss",
    //                        dateFields: ["date"]
    //                    });
    //                    console.log(data, "datadatadatadata")
    //                    series.data.setAll(data);
       
    //                    series.appear();
    //                }
       
    //                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
    //                    behavior: "none"
    //                }));
    //                cursor.lineY.set("visible", false);
       
    //                chart.set("scrollbarX", am5.Scrollbar.new(root, {
    //                    orientation: "horizontal"
    //                }));
       
    //                chart.set("scrollbarY", am5.Scrollbar.new(root, {
    //                    orientation: "vertical"
    //                }));
       
    //                var legend = chart.rightAxesContainer.children.push(am5.Legend.new(root, {
    //                    width: 200,
    //                    paddingLeft: 15,
    //                    height: am5.percent(100)
    //                }));
       
    //                legend.itemContainers.template.events.on("pointerover", function (e) {
    //                    var itemContainer = e.target;
       
    //                    // As series list is data of a legend, dataContext is series
    //                    var series = itemContainer.dataItem.dataContext;
       
    //                    chart.series.each(function (chartSeries) {
    //                        if (chartSeries != series) {
    //                            chartSeries.strokes.template.setAll({
    //                                strokeOpacity: 0.15,
    //                                stroke: am5.color(0x000000)
    //                            });
    //                        } else {
    //                            chartSeries.strokes.template.setAll({
    //                                strokeWidth: 3
    //                            });
    //                        }
    //                    })
    //                })
       
    //                legend.itemContainers.template.events.on("pointerout", function (e) {
    //                    var itemContainer = e.target;
    //                    var series = itemContainer.dataItem.dataContext;
       
    //                    chart.series.each(function (chartSeries) {
    //                        chartSeries.strokes.template.setAll({
    //                            strokeOpacity: 1,
    //                            strokeWidth: 1,
    //                            stroke: chartSeries.get("fill")
    //                        });
    //                    });
    //                })
       
    //                legend.itemContainers.template.set("width", am5.p100);
    //                legend.valueLabels.template.setAll({
    //                    width: am5.p100,
    //                    textAlign: "right"
    //                });
       
    //                legend.data.setAll(chart.series.values);
       
    //                chart.appear(1000, 100);

    //            }
    //        });

    //    }

        getAmChart()
         
 
    
       function getAmChart() {
          
            let startDate = ($('#startDate').val() != undefined) ? $('#startDate').val() : '';
            let endDate = ($('#endDate').val() != undefined) ? $('#endDate').val() : '';
            let dateRange = ($('#dateRange').val() != undefined) ? $('#dateRange').val() : '';
            let modem_id = ($('#modem_id').val() != undefined) ? $('#modem_id').val() : '';
       
             if($('#customSelect').val() == 'Today'){
                 console.log("Fdsfsf");
                startDate = moment().format('YYYY-MM-DD') +' 00:00';
                endDate = moment().format('YYYY-MM-DD') +' 23:59';
            }
            console.log(startDate, endDate)
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: site_url + "admin/dashboardV2/ajaxAction",
                data: { 'action': 'getChartDataV2', 'endDate': endDate, 'startDate': startDate,'dateRange': dateRange, "modem_id":modem_id },
                success: function (out) {
                    let result = JSON.parse(out);
                    
                    console.log(result,"result")
                    root.setThemes([
                        am5themes_Animated.new(root)
                    ]);
                    

                    root.container.children.clear();
                   
                   

                    var chart = root.container.children.push(am5xy.XYChart.new(root, {
                        panX: true,
                        panY: true,
                        wheelX: "panX",
                        wheelY: "zoomX",
                        maxTooltipDistance: 0,
                        pinchZoomX: true
                    }));
        
        
                    //var date = new Date();
                    // date.setHours(0, 0, 0, 0);
                    //var value = 100;
        
                   
        
                    var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                        maxDeviation: 0.2,
                        baseInterval: {
                            // timeUnit: "time",
                            timeUnit: "second",
                            // timeUnit: "day",
                            count: 1
                        },
                        renderer: am5xy.AxisRendererX.new(root, {}),
                        tooltip: am5.Tooltip.new(root, {})
                    }));
        
                    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                        renderer: am5xy.AxisRendererY.new(root, {})
                    }));
                    function generateData(aaa) {
                        // console.log(aaa)
                        value = aaa.value;
                        // value = Math.round((Math.random() * 10 - 4.2) + value);
                        // am5.time.add(new Date(aaa.date), "day", 1);
                        // console.log(new Date(aaa.date), "datedatedate")
                        // console.log(new Date(aaa.date).getTime(), "ssss")
                        return {
                            date: aaa.date,
                            // date: new Date(aaa.date).getTime(),
                            value: value
                        };
                    }
            
                    function generateDatas(count) {
                        var data = [];
                        // for (var i = 0; i < 10; ++i) {
                        for (var i = 0; i < count.length; ++i) {
                            let ary = []
                            var dateString = count[i].date
                            ary = {date:count[i].date ,  value :count[i].value};
                            data.push(ary)
                            // data.push(generateData(count[i]));
                        }
                        console.log(data, "datedatedate")
                        return data;
                    }
                    console.log(result.length, "result.lengthresult.length")
                    let titlename = ["PV1","SP1","PV2","SP2","PV3","SP3","PV4","SP4","PV5","SP5","PV6","SP6"];
                    // let titlename = ['PV',"SP","OYT","Obit"];
                    console.log(titlename, " titlename")
                    for (var i = 0; i < result.length; i++) {
                        var series = chart.series.push(am5xy.LineSeries.new(root, {
                            // minBulletDistance: 10,
                            connect: true,
                            name: titlename[i]+"Tempreture",
                            xAxis: xAxis,
                            yAxis: yAxis,
                            valueYField: "value",
                            valueXField: "date",
                            legendValueText: "{valueY}",
                            tooltip: am5.Tooltip.new(root, {
                                pointerOrientation: "horizontal",
                                labelText: "{valueY}"
                            })
                        }));
        
                        // date = new Date();
                        // date.setHours(0, 0, 0, 0);
                        // value = 0;
        
                        // var data = generateDatas(10);
                        var data = generateDatas(result[i]);
                        // var data = result[i];
                        series.data.processor = am5.DataProcessor.new(root, {
                            dateFormat: "yyyy-MM-dd HH:mm:ss",
                            dateFields: ["date"]
                        });
                        series.data.setAll(data);
        
                        series.appear();
                    }
        
                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                        behavior: "none"
                    }));
                    cursor.lineY.set("visible", false);
        
                    chart.set("scrollbarX", am5.Scrollbar.new(root, {
                        orientation: "horizontal"
                    }));
        
                    chart.set("scrollbarY", am5.Scrollbar.new(root, {
                        orientation: "vertical"
                    }));
        
                    var legend = chart.rightAxesContainer.children.push(am5.Legend.new(root, {
                        width: 200,
                        paddingLeft: 15,
                        height: am5.percent(100)
                    }));
        
                    legend.itemContainers.template.events.on("pointerover", function (e) {
                        var itemContainer = e.target;
        
                        // As series list is data of a legend, dataContext is series
                        var series = itemContainer.dataItem.dataContext;
        
                        chart.series.each(function (chartSeries) {
                            if (chartSeries != series) {
                                chartSeries.strokes.template.setAll({
                                    strokeOpacity: 0.15,
                                    stroke: am5.color(0x000000)
                                });
                            } else {
                                chartSeries.strokes.template.setAll({
                                    strokeWidth: 4
                                });
                            }
                        })
                    })
        
                    legend.itemContainers.template.events.on("pointerout", function (e) {
                        var itemContainer = e.target;
                        var series = itemContainer.dataItem.dataContext;
        
                        chart.series.each(function (chartSeries) {
                            chartSeries.strokes.template.setAll({
                                strokeOpacity: 1,
                                strokeWidth: 1,
                                stroke: chartSeries.get("fill")
                            });
                        });
                    })
        
                    legend.itemContainers.template.set("width", am5.p100);
                    legend.valueLabels.template.setAll({
                        width: am5.p100,
                        textAlign: "right"
                    });
        
                    legend.data.setAll(chart.series.values);
                    chart.appear(1000, 100);
                   

                }
            });

        }

       $('.customSelect').trigger('change');
    }
    return {
        init: function () {
            handleList();
            meterDashboardV3();
        },
        initChart: function () {
            handleChart();
        },
        initMeter: function () {
            // meterDashboard();
            // meterDashboardV2();
            // meterDashboardV3();
        },
    }
}();
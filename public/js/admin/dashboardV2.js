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
                   // return  console.log();
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

            filePrefix: "Chart",
            title: "This chart is exported From IIOTCONNECT.IN",
            pngOptions: {quality: 1,maintainPixelRatio: true,},
            jpgOptions: {quality: 1,maintainPixelRatio: true},
            pdfOptions: {pageSize: "LETTER",includeData: true,addURL:false}
          });
          
         
         exporting.get("menu").set("items", [
            {
              type: "format",
              format: "png",
              label: "Export png"}, 
              {type: "format",
              format: "jpg",
              label: "Export jpg"},
              {type: "format",
              format: "pdf",
              label: "Export pdf"},
              {type: "separator"}, 
              {type: "format",
              format: "print",
              label: "Print"}
              ]);
         exporting.events.on("pdfdocready", function(event) {
              event.doc.content.unshift({
                image: "data:image/png;base64,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",
                fit: [50,50]
              });

            });
        getAmChart()
         
 
    
       function getAmChart() {
          
            let startDate = ($('#startDate').val() != undefined) ? $('#startDate').val() : '';
            let endDate = ($('#endDate').val() != undefined) ? $('#endDate').val() : '';
            let dateRange = ($('#dateRange').val() != undefined) ? $('#dateRange').val() : '';
            let modem_id = ($('#modem_id').val() != undefined) ? $('#modem_id').val() : '';
       
             if($('#customSelect').val() == 'Today'){
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
                            // timeUnit: "second",
                            timeUnit: "second",
                            count: 10
                        },
                        renderer: am5xy.AxisRendererX.new(root, {}),
                        tooltip: am5.Tooltip.new(root, {})
                    }));
        
                    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                        renderer: am5xy.AxisRendererY.new(root, {})
                    }));
                    
            
                    function generateDatas(i) {
                        var data = [];
                        // for (var i = 0; i < 10; ++i) {
                        for (var k = 0; k < result.length; ++k) {
                            let ary = []
                            
                            ary = {date:result[k].date ,  value :result[k][i]};
                            am5.time.add(new Date(result[k].date), "second",1);
                            data.push(ary)
                            // data.push(generateData(count[i]));
                        }
                        // console.log(result[0][0], "arraydatalength")
                        // console.log(data, "datedatedate")
                        return data;
                    }
                    // console.log(result.length, "result.lengthresult.length")
                    let titlename = ["MASTER PV","MASTER SP","SLAVE1 PV","SLAVE1 SP","SLAVE2 PV","SLAVE2 SP","SLAVE3 PV","SLAVE3 SP","SLAVE4 PV","SLAVE4 SP","SLAVE5 PV","SLAVE5 SP"];

                    for (var i = 0; i < titlename.length; i++) {
                        var series = chart.series.push(am5xy.LineSeries.new(root, {
                            minBulletDistance: 10,
                            connect: true,
                            name: titlename[i],
                            xAxis: xAxis,
                            yAxis: yAxis,
                            valueYField: "value",
                            valueXField: "date",
                            // legendValueText: "{valueY}"+"°C",
                            // seriesTooltipTarget: "bullet",
                            tooltip: am5.Tooltip.new(root, {
                              labelText: "{name}[/] {valueY}"+"°C",
                              pointerOrientation: "right"
                            })
                        }));
                        // series.bullets.push(function() {
                        //   var circle = am5.Circle.new(root, {
                        //     radius: 3,
                        //     fill: root.interfaceColors.get("background"),
                        //     stroke: am5.color(0x04ac9c),
                        //     strokeWidth: 2
                        //   })

                        //   return am5.Bullet.new(root, {
                        //     sprite: circle
                        //   })
                        // });
                        
                        var data = generateDatas(i);
                        // var data = result[i];
                        // series.data.processor = am5.DataProcessor.new(root, {
                        //     dateFormat: "yyyy-MM-dd HH:mm:ss",
                        //     dateFields: ["date"]
                        // });
                        // console.log(data,"datataasasaS");
                        series.data.setAll(data);
                        
                        series.appear();
                    }
                    
                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                        behavior: "none"
                    }));
                    cursor.lineY.set("visible", true);
        
                    var scrollbarX = am5xy.XYChartScrollbar.new(root, {
                      orientation: "horizontal",
                      height: 30
                    });

                    chart.set("scrollbarX", scrollbarX);
            
                    chart.set("scrollbarY", am5.Scrollbar.new(root, {
                        orientation: "vertical"
                    }));
        
                    var legend = chart.rightAxesContainer.children.push(am5.Legend.new(root, {
					  // width: 200,
					  // paddingLeft: 15,
					  height: am5.percent(100)
					}));
        
                    // var legend = chart.bottomAxesContainer.children.push(am5.Legend.new(root, {
                    //     x: am5.percent(0),
                    //     // width: am5.percent(100),
                    //     centerX: am5.percent(0),
                    //     paddingTop:1,
                    //     // paddingLeft: 15,
                    //     layout: root.horizontalLayout
                    //   }));
                      
                    // var legend = chart.children.push(am5.Legend.new(root, {
                    //     width: am5.percent(100),
                    //     y: am5.percent(100),
                    //     centerY: am5.percent(0),
                    //     height:am5.percent(100),
                    //     paddingLeft: 15,
                    //     layout: root.horizontalLayout,
                    //   }));

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
                                strokeWidth: 2,
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
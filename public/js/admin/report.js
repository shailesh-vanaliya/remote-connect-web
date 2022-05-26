var Report = function () {
    var handleList = function () {

        $('.device_type_id').change(function () {
            var device_type_id = $('.device_type_id option:selected').val();
            // var that = $(this);
            //    loadingStart(that);
            $.ajax({
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                url: site_url + "admin/report/ajaxAction",
                data: { 'action': 'getDevicelist', 'device_type_id': device_type_id },
                success: function (data) {
                    $("#device_id").html("");
                    var data = JSON.parse(data);
                    console.log(data, " datadata")
                    var html = '<option value="">- - Choose Device - -</option>';
                    $.each(data.deviceList, function (idx, val) {
                        html += '<option value="' + val.id + '">' + val.modem_id + '(' + val.modem_id + ')</option>';
                    });
                    $("#device_id").html(html);

                    $('#coursesForType').empty();
                    for (var i = 0; i < data.column.length; i++) {
                        $('#coursesForType').append('<div><input type="checkbox" class="checkAction" checked name="fieldList[]" id= ' + data.column[i] + ' value= ' + data.column[i] + '  />&nbsp;&nbsp;<span class="label-value-view"><label for = ' + data.column[i]['id'] + '>' + data.column[i]  + "</label></span></div>");
                    }
                    // radioCheckboxClass();

                }
            });
        });
        $('.device_id').change(function () {
            var device_id = $('.device_id option:selected').val();
            var that = $(this);
            loadingStart(that);
            console.log($('input[name="_token"]').val())
            // $.ajax({
            //     type: "POST",
            //     headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
            //     url: site_url + "admin/report/ajaxAction",
            //     data: {'action': 'get', 'device_type_id': device_type_id},
            //     success: function(data) {
            //         $("#device_id").html("");
            //         var data = JSON.parse(data);
            //         var html = '<option value="">- - Choose Device - -</option>';
            //         $.each(data, function(idx, val) {
            //             html += '<option value="' + val.id + '">' + val.modem_id + '('+val.modem_id + ')</option>';
            //         });
            //         $("#device_id").html(html);
            //     }
            // });
        });

        $('.device_type_id').trigger('change');
        //   function getLocationList() {
        // $.ajax({
        //     type: "POST",
        //     headers: {
        //         'X-CSRF-TOKEN': $('input[name="_token"]').val(),
        //     },
        //     url: site_url + "admin/device/ajaxAction",
        //     data: { 'action': 'getLocation' },
        //     success: function (data) {
        //         var output = JSON.parse(data);
        //         console.log(output)
        //     }
        // });
        // }

        $('.courseGet').change(function () {
            var course_type = $('#course_type :selected').val();
            var course_active = $("input[name='courseStatus']:checked").val();
            var that = $(this);
            loadingStart(that);
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: site_url + "agentCommission/ajaxAction",
                data: { 'action': 'getCourseFromType', 'data': { 'course_type': course_type, 'course_active': course_active } },
                success: function (data) {
                    loadingEnd(that);
                    var data = JSON.parse(data);
                    $('#coursesForType').empty();
                    for (var i = 0; i < data.column.length; i++) {
                        console.log("hHhh")
                        $('#coursesForType').append('<div><input type="checkbox" class="checkAction" checked name="fieldList[]" id= ' + data[i]['id'] + ' value= ' + data[i]['id'] + '  />&nbsp;&nbsp;<span class="label-value-view"><label for = ' + data[i]['id'] + '>' + data[i]['course_code'] + ' : ' + data[i]['course_name'] + " " + "</label></span></div>");
                    }
                    // radioCheckboxClass();
                }
            });
        });


    }

    return {
        init: function () {
            handleList();
        }
    }
}();
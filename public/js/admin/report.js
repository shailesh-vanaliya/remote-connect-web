var Report = function () {
    var handleList = function () {
        // $('.device_type_id').change(function () {
        $("body").on('click', '.device_type_id', function () {
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
                        $('#coursesForType').append('<div><input type="checkbox" class="checkAction" checked name="fieldList[]" id= ' + data.column[i] + ' value= ' + data.column[i] + '  />&nbsp;&nbsp;<span class="label-value-view"><label for = ' + data.column[i]['id'] + '>' + data.column[i] + "</label></span></div>");
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



        // $("#example1").DataTable({
        //   "responsive": true,"paging": true,  "info": true,"lengthChange": false, "autoWidth": false,
        //   // "buttons": [ "csv", "excel", "pdf", "print"]
        // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        //   $('#example1').DataTable({
        //     initComplete: function () {
        //         this.api()
        //             .columns()
        //             .every(function () {
        //                 var column = this;
        //                 var select = $('<select><option value=""></option></select>')
        //                     .appendTo($(column.footer()).empty())
        //                     .on('change', function () {
        //                         var val = $.fn.dataTable.util.escapeRegex($(this).val());

        //                         column.search(val ? '^' + val + '$' : '', true, false).draw();
        //                     });

        //                 column
        //                     .data()
        //                     .unique()
        //                     .sort()
        //                     .each(function (d, j) {
        //                         select.append('<option value="' + d + '">' + d + '</option>');
        //                     });
        //             });
        //     },
        // });


    }
    var handleLists = function () {
        $('#dateRange').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            autoUpdateInput: true,
            timePicker24Hour: true,
            locale: {
                format: 'DD/MM/YYYY hh:mm A'
            }
        })


        // $('.applyBtn').click(function () {
        $("body").on('click', '.applyBtn', function () {
            let startDate = $('#dateRange').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm');
            let endDate = $('#dateRange').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm');
            $('#startDate').val(startDate);
            $('#endDate').val(endDate);
        });

        // $('.downloadBtn').click(function () {
        // $('.downloadBtn').on('click',function(){
        $("body").on('click', '.downloadBtn', function () {
            $('.applyBtn').trigger('click')
            console.log($(this).attr('data-report_id'), " ===")
            let report_id = $('.report_id').val($(this).attr('data-report_id'));
            let data_table = $('.data_table').val($(this).attr('data-data_table'));
            let modem_id = $('.modem_id').val($(this).attr('data-modem_id'));
            let parameter = $('.parameter').val($(this).attr('data-parameter'));
        });
        $('.applyBtn').trigger('click')
    }

    // buttons-excel


    return {
        init: function () {
            handleList();
        },
        listInit: function () {
            handleLists();
        }
    }
}()
var ReportConfig = function () {
    var handleCreate = function () {
        $('.select2').select2();


        $('.device_id').change(function () {
            $('.preloader').show();
            var device_id = $('.device_id option:selected').val();
            // var that = $(this);
            //    loadingStart(that);
            $.ajax({
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                url: site_url + "admin/report-config/ajaxAction",
                data: { 'action': 'getDevicelist', 'device_id': device_id },
                success: function (data) {
                    $("#parameter").html("");
                    $('.preloader').hide();
                    var data = JSON.parse(data);
                    console.log(data)
                    var html = '<option value="">- - Choose Parameter - -</option>';
                    $.each(data.column, function (idx, val) {
                        html += '<option value="' + idx + '">' + val + '</option>';
                    });
                    $("#parameter").html(html);
                }
            });
        });
// $('.device_id').trigger('change');
    }
   
    return {
        init: function () {
            handleCreate();
        },
     
    }
}();
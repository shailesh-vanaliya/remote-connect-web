var AlertConfig = function () {
    var handleCreate = function () {
        if ($(".select2").length > 0) {
            $('.select2').select2();
        }

        $('.device_id').change(function () {
            var device_id = $('.device_id option:selected').val();
           
            $.ajax({
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                url: site_url + "admin/report-config/ajaxAction",
                data: { 'action': 'getDevicelist', 'device_id': device_id },
                success: function (data) {
                    $("#parameter").html("");
                    var data = JSON.parse(data);
                
                    var html = '<option value="">- - Choose Parameter - -</option>';
                    $.each(data.column, function (idx, val) {
                        html += '<option value="' + val + '">' + val + '</option>';
                    });
                    $("#parameter").html(html);
                    if($('.old_parameter').val() != ''){
                        $("#parameter").val($('.old_parameter').val());
                    }
                }
            });
        });
        setTimeout(function(){
            $('.device_id').trigger('change');
        },100);
    }
        
    return {
        init: function () {
            handleCreate();
        },

    }
}();
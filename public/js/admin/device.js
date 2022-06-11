var Device = function () {
    var handleCreate = function () {
        // alert("Ff")
        // $('.select2').select2();


        $("body").on('blur', '#modem_id', function () {
            getModelNo();
        });

        $("body").on('blur', '#secret_key', function () {
            getModelNo();
        });

        function getModelNo() {
            var secret_key = $('#secret_key').val();
            var modem_id = $('#modem_id').val();
            if (modem_id != "" && secret_key != "") {
                $.ajax({
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                    url: site_url + "admin/device/ajaxAction",
                    data: { 'action': 'getDevicelist', 'modem_id': modem_id, 'secret_key': secret_key, },
                    success: function (data) {
                        $("#parameter").html("");
                        var data = JSON.parse(data);
                        console.log(data.model_no)

                        $("#model_no").val(data.model_no);
                    }
                });
            }
        };

        getModelNo();
    }

    return {
        init: function () {
            handleCreate();
        },

    }
}();
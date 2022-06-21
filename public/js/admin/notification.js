var Notification = function () {
    var handleList = function () {

        function getNotification() {
            $('.preloader').show();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: site_url + "admin/notification/ajaxAction",
                data: { 'action': 'getNotification' },
                success: function (data) {
                    $('.preloader').hide();
                    var output = JSON.parse(data);
                    $('.notificationCount').text(output.length);
                    $.each(output, function (i, item) {
                        if (i == 0) {
                            readNotification(item.id);
                        }
                        showToster('Alert', item.modem_id + " : " + item.alert_message)
                    });
                }
            });
        }

        function readNotification(readId) {
            console.log("dddddd", readId)
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: site_url + "admin/notification/ajaxAction",
                data: { 'action': 'readNotification', "lastId": readId },
                success: function (data) {
                    var output = JSON.parse(data);

                }
            });
        }

        $("body").on('click', '.isAck', function () {
            var notificationId = $(this).attr('data-id');
            $('.preloader').show();
            $.ajax({
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                url: site_url + "admin/notification/ajaxAction",
                data: { 'action': 'ackNotification', 'notificationId': notificationId },
                success: function (data) {
                    var output = JSON.parse(data);
                    $('.preloader').hide();
                    showToster(output.status, output.message)
                    $('.isAck_'+notificationId).removeClass('btn-secondary');
                    $('.isAck_'+notificationId).addClass('btn-success'); 
                    $('.isAckSub'+notificationId).prop('title', 'Already Acknowledged');
                }
            });
        });
        setInterval(function () {
            getNotification();
        }, 10000)
    }

    return {
        init: function () {
            handleList();
        }
    }
}();
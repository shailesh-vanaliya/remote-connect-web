var Notification = function () {
    var handleList = function () {
        
       function getNotification(){
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: site_url + "admin/notification/ajaxAction",
            data: { 'action': 'getNotification' },
            success: function (data) {
                var output = JSON.parse(data);
                $('.notificationCount').text(output.length)
                $.each(output, function(i, item) {
                    showToster('success',item.modem_id + " : " + item.alert_message)
                });
            }
        });
       }
       setInterval(function(){
        getNotification();
       },10000)
    }
  
    return {
        init: function () {
            handleList();
        }
    }
}();
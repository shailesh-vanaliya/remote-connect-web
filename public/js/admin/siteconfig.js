var Siteconfig = function() {
    var handleList = function() {
        $('#detected_distance_alert').change(function() {
            if($(this).is(":checked")) {
                $('.showRedAlert').show();
                $('#detected_distance_alert').val(1);
            }else{
                $('.showRedAlert').hide();
                $('#detected_distance_alert').val(0);
            }
        }); 
        $('#green_distance_alert').change(function() {
            if($(this).is(":checked")) {
                $('.showGreenAlert').show();
                $('#green_distance_alert').val(1);
            }else{
                $('.showGreenAlert').hide();
                $('#green_distance_alert').val(0);
            }
        }); 
        $('#yellow_distance_alert').change(function() {
            if($(this).is(":checked")) {
                $('.showYellowAlert').show();
                $('#yellow_distance_alert').val(1);
            }else{
                $('.showYellowAlert').hide();
                $('#yellow_distance_alert').val(0);
            }
        });
    }
    return {
        initFormSubmit: function() {
            handleList();
        }
    }
}();
var MqttUser = function() {
    var handleList = function() {
        $('body').on('blur', '.password', function (e) {
            console.log($('.password').val(), " ===")
            let decodePassword = hex_sha512($('.password').val());
            $(".password_hex_sha512").val(decodePassword);
            console.log(decodePassword, " decodePassworddecodePassword")
            let b64sha512 = b64_sha512($('.password').val());
            $(".password_b64_sha512").val(b64sha512);
            console.log(b64sha512, " b64_sha512")
         });

    }
    return {
        init: function() {
            handleList();
        }
    }
}();
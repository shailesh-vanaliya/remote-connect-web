var Order = function() {
    var handleList = function() {

        let lineNo = 1;


        $('body').on('click', '.deleteBtn', function() {
            let length = $('input[name="name[]"]').length;

            if (length > 1) {
                $(this).parent().parent().remove();
            } else  {
                $('#has_error').html("<span style='color: red; font-weight: bold;'>At least one product should be there. You can not delete the product.</span>");
            }
        });
    }
    return {
        init: function() {
            handleList();
        }
    }
}();

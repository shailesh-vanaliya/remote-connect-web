var ReportConfig = function () {
    var handleCreate = function () {
        $('.select2').select2();
    }
   
    return {
        init: function () {
            handleCreate();
        },
     
    }
}();
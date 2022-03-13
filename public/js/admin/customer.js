var Customer = function() {
    var handleList = function() {
          $('.content').click(function() {
              $('.deviceInfomation').show();
          });
          $("#example1").DataTable();
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
          });
    }
    return {
        init: function() {
            handleList();
        }
    }
}();

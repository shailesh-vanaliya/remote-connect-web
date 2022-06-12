var Customer = function() {
    var handleList = function() {
          $('.content').click(function() {
              $('.deviceInfomation').show();
          });
        //   $("#example1").DataTable();
          $("#example1").DataTable({
              "responsive": true,"paging": true,  "info": true,"lengthChange": false, "autoWidth": false,
            //   // "buttons": [ "csv", "excel", "pdf", "print"]
            });
          $("#example3").DataTable({
              "responsive": true,"paging": true,  "info": true,"lengthChange": false, "autoWidth": false,
            //   // "buttons": [ "csv", "excel", "pdf", "print"]
            });
          $('#example2').DataTable({
            "paging": true,
            "responsive": true,
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

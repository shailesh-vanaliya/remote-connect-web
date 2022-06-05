var Customer = function() {
    var handleList = function() {
          $('.content').click(function() {
              $('.deviceInfomation').show();
          });
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": [ "csv", "excel", "pdf", "print"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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

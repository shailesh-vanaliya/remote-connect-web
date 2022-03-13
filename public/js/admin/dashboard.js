var Dashboard = function() {
    var handleList = function() {
        
          $('.content').click(function() {
              $('.deviceInfomation').show();
          });
          
      // function getMonitordata() {
      //       $.ajax({
      //           type: "POST",
      //           headers: {
      //               'X-CSRF-TOKEN': $('input[name="_token"]').val(),
      //           },
      //           url: baseurl + "company/employee-ajaxAction",
      //           data: {'action': 'getDepartmentEmployeeList','department_id':department},
      //           success: function (data) {
      //               var output = JSON.parse(data);
      //               console.log(output)
      //               var len = output.length;
      //               $("#Employee"+empCount).empty();
      //               $("#Employee"+empCount).append("<option value=''>Select Employee</option>");
      //               for( var i = 0; i<len; i++){
      //                   var id = output[i]['id'];
      //                   var name = output[i]['name'];
      //                   $("#Employee"+empCount).append("<option value='"+eid+"'>"+name+"</option>");
      //               }
      //           }
      //       });
      //   }

    }
    return {
        init: function() {
            handleList();
        }
    }
}();
  <?php
  if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $dynamicUrl =  asset('') . 'public/';
  } else {
    $dynamicUrl =  asset('') . 'public/';
  }
  ?>
  <!-- jQuery 3 -->
  <script src="{{ $dynamicUrl.'bower_components/jquery/dist/jquery.min.js' }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ $dynamicUrl.'bower_components/bootstrap/dist/js/bootstrap.min.js' }}"></script>
  <!-- iCheck -->
  <script src="{{ $dynamicUrl.'js/icheck.min.js' }}"></script>
  <script src="{{ $dynamicUrl.'js/commonfunction.js' }}"></script>

  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
  </body>

  </html>
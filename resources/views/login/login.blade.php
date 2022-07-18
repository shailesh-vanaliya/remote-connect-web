@include('login.layout.header')
<style>
  .btn-iio {
    color: #ffffff;
    background-color: #01a89d;
    border-color: #01a89d;
    box-shadow: none;
  }

  .btn-iio:hover {
    color: #01a89d;
    background-color: #ffffff;
    border-color: #01a89d;
  }

  .btn-iio:focus,
  .btn-iio.focus {
    color: #ffffff;
    background-color: #01a89d;
    border-color: #0062cc;
    box-shadow: none, 0 0 0 0 rgba(38, 143, 255, 0.5);
  }

  .btn-iio.disabled,
  .btn-iio:disabled {
    color: #ffffff;
    background-color: #007bff;
    border-color: #007bff;
  }

  .btn-iio:not(:disabled):not(.disabled):active,
  .btn-iio:not(:disabled):not(.disabled).active,
  .show>.btn-iio.dropdown-toggle {
    color: #ffffff;
    background-color: #01a89d;
    border-color: #ffffff;
  }

  .btn-iio:not(:disabled):not(.disabled):active:focus,
  .btn-iio:not(:disabled):not(.disabled).active:focus,
  .show>.btn-iio.dropdown-toggle:focus {
    box-shadow: 0 0 0 0 rgba(38, 143, 255, 0.5);
  }


  #myVideo {
    position: fixed;
    right: 0;
    bottom: 0;
    /* top: 1px; */
    min-width: 100%;
    width: 100%;
    min-height: 100%;
  }
</style>
<video autoplay muted loop id="myVideo">
  <source src='{{ asset("/public/img/ft.mp4") }}' type="video/webm">
</video>
<div class="login-box ">

  <!-- <div class="login-logo ">
  <div class="login-logo"> <img src='{{ asset("/public/img/futuristics.png") }}' class="logo"> </div>
  </div> -->

  <!-- /.login-logo -->
  <div class="card ">
    <div class="login-logo" style="margin-top: 1.0rem; margin-bottom:0.1rem;"> <img src='{{ asset("/public/img/test.gif") }}' class="logo"> </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg">IIOT Connect Sign in</p>
      @include('login.layout.message')
      @if ( count( $errors ) > 0 )
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
      </div>
      @endif

      <form role="form" method="post" autocomplete="off" class="loginFrm" id="loginFrm" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-iio btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->
      <!-- 
      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">Create New Account</a>
      </p>
      <p class="mb-0">
      <a href="https://www.futuristictechnologies.in/"  target="_blank" > Help</a>
      </p> -->

    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<!-- <style>
    .logo{
        width:130px;
    }
</style>
<div class="card-body login-card-body">
<div class="login-box">
  <div class="login-logo"> <img src="{{ asset("/public/img/futuristics.png") }}" class="logo"> </div>
  <div class="login-box-body">
    <h4 class="login-box-msg">Futuristic Technologies Log in</h4>
     @include('login.layout.message')
     @if ( count( $errors ) > 0 )
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            {{ $error }}<br>
          @endforeach
        </div>
    @endif
     <form role="form" method="post" autocomplete="off" class="loginFrm" id="loginFrm" action="{{ route('login') }}">
        {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group row has-feedback">
        <div class="col-md-6 offset-md-4 ">
        </div>
          <div class="col-md-6 offset-md-4 ">
              <button type="submit" class="btn btn-primary btn-flat pull-right">Sign In</button>
          </div>
    </div >
    </form>
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="{{ route('register') }}" class="btn    btn-flat"> Create New Account</a> | 
      <a href="https://www.futuristictechnologies.in/"  target="_blank" class="btn  btn-flat"> Help</a>
    </div>
  </div>
</div> -->
<script>
  var video = document.getElementById("myVideo");
  var btn = document.getElementById("myBtn");

  function myFunction() {
    if (video.paused) {
      video.play();
      btn.innerHTML = "Pause";
    } else {
      video.pause();
      btn.innerHTML = "Play";
    }
  }
</script>
@include('login.layout.footer')
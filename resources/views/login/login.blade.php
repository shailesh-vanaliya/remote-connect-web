@include('login.layout.header')

<div class="login-box">
  <div class="login-logo">
  <div class="login-logo"> <img src="{{ asset("/public/img/futuristics.png") }}" class="logo"> </div>
  </div>
  <!-- /.login-logo -->
  <div class="card">
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
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">Create New Account</a>
      </p>
      <p class="mb-0">
      <a href="https://www.futuristictechnologies.in/"  target="_blank" > Help</a>
      </p>

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
@include('login.layout.footer')

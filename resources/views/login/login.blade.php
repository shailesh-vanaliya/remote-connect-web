@include('login.layout.header')
<style>
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
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@include('login.layout.footer')

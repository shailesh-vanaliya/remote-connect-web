@include('login.layout.header')
<style>
  .logo {
    width: 130px;
  }
</style>
<div class="card-body login-card-body">
  <div class="login-box" style="width:400px !important;">
    <!-- <div class="login-logo"> <img src="{{ asset("/public/img/futuristics.png") }}" class="logo"> </div> -->
    <div class="login-box-body">
      <h4 class="login-box-msg">Futuristic Technologies Register</h4>
      @include('login.layout.message')
      @if ( count( $errors ) > 0 )
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
      </div>
      @endif
      <br/>
      <!-- <form role="form" method="post" autocomplete="off" class="loginFrm" id="loginFrm" action="{{ route('register') }}"> -->
      <form method="POST" action="{{ url('/register') }}" accept-charset="UTF-8" class="form-horizontal1 loginFrm" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name">
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name">
        </div>

        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
        </div>

        <div class="form-group has-feedback">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
        </div>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" maxlength="10" name="mobile_no" id="mobile_no" placeholder="Phone number">
        </div>

        <div class="form-group row has-feedback">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-flat pull-right">Sign Up</button>
          </div>
        </div>
      </form>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
  @include('login.layout.footer')
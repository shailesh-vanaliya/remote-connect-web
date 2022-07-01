@extends('admin.layouts.admin')
@section('content')
<section style="display: none;" class="alert alert-danger alert-block fade in alert-dismissable server-side-validation">
    <div class="row form-group">
        <div class="col-lg-10">
            <p>The following errors have occurred:</p>
            <ul class="error-list">
            </ul>
        </div>
    </div>
</section>
<br />
<div class="row">
    <div class="col-md-9">
        <div class="card ml-5">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link @if (!isset($_GET['type'])) active @endif" href="#activity" data-toggle="tab">Edit Profile</a></li>
                    <li class="nav-item"><a class="nav-link @if (isset($_GET['type'])) active @endif" href="#settings" data-toggle="tab">Change Password</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="@if (!isset($_GET['type'])) active @endif tab-pane" id="activity">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post">
                            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                                <label for="first_name" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="first_name" value="{{ isset($userDetails->first_name) ? $userDetails->first_name : old('first_name')}}" name="first_name" placeholder="First Name">
                                    {!! $errors->first('first_name', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                                <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="last_name" value="{{ $userDetails->last_name }}" name="last_name" placeholder="Last Name">
                                    {!! $errors->first('last_name', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>
                            <input type="hidden" name="userId" value="{{ $userId }}">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $userDetails->email }}" placeholder="Email">
                                    {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                                <label for="company_name" class="col-sm-2 control-label">Company Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $userDetails->company_name }}" placeholder="company name">
                                    {!! $errors->first('company_name', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('profile_pic') ? 'has-error' : ''}}">
                                <label for="profile_pic" class="col-sm-2 control-label">Picture</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="profile_pic" name="profile_pic" value="{{ $userDetails->pic }}" placeholder="profile_pic">
                                    {!! $errors->first('profile_pic', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="@if (isset($_GET['type'])) active @endif tab-pane" id="settings">
                        <form class="form-horizontal" method="post" action="@if(Auth::guard('admin')->user())
                        {{ route('change_password') }}
                        @else
                        {{ route('change_password') }}
                        @endif">
                            <input type="hidden" name="userId" value="{{ $userId }}">
                            <input type="hidden" name="formType" value="password">
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                <label for="inputName" class="col-sm-2 control-label">Old Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Please enter old password">
                                    {!! $errors->first('password', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>
                            {!! csrf_field() !!}
                            <div class="form-group {{ $errors->has('new_password') ? 'has-error' : ''}}">
                                <label for="inputName" class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New password">
                                    {!! $errors->first('new_password', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : ''}}">
                                <label for="inputEmail" class="col-sm-2 control-label">Re-type Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control confirm_password" name="confirm_password" id="confirm_password" placeholder="Re type Password">
                                    {!! $errors->first('confirm_password', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-1"></div>
    <!-- <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-pills">
                <li class="@if (!isset($_GET['type'])) active @endif"><a href="#activity" data-toggle="tab">Edit
                        Profile</a></li>
                <li class="@if (isset($_GET['type'])) active @endif"><a href="#settings" data-toggle="tab">Change
                        Password</a></li>
            </ul>
            <div class="tab-content">
                <div class="@if (!isset($_GET['type'])) active @endif tab-pane" id="activity">
                    <form enctype="multipart/form-data" class="form-horizontal" method="post">
                        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                            <label for="first_name" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="first_name" value="{{ isset($userDetails->first_name) ? $userDetails->first_name : old('first_name')}}" name="first_name" placeholder="First Name">
                                {!! $errors->first('first_name', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                            <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="last_name" value="{{ $userDetails->last_name }}" name="last_name" placeholder="Last Name">
                                {!! $errors->first('last_name', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <input type="hidden" name="userId" value="{{ $userId }}">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" value="{{ $userDetails->email }}" placeholder="Email">
                                {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                            <label for="company_name" class="col-sm-2 control-label">Company Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $userDetails->company_name }}" placeholder="company name">
                                {!! $errors->first('company_name', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('profile_pic') ? 'has-error' : ''}}">
                            <label for="profile_pic" class="col-sm-2 control-label">Picture</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="profile_pic" name="profile_pic" value="{{ $userDetails->pic }}" placeholder="profile_pic">
                                {!! $errors->first('profile_pic', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane @if (isset($_GET['type'])) active @endif" id="settings">
                    <form class="form-horizontal" method="post" action="@if(Auth::guard('admin')->user())
                        {{ route('change_password') }}
                        @else
                        {{ route('change_password') }}
                        @endif">
                        <input type="hidden" name="userId" value="{{ $userId }}">
                        <input type="hidden" name="formType" value="password">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                            <label for="inputName" class="col-sm-2 control-label">Old Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Please enter old password">
                                {!! $errors->first('password', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <div class="form-group {{ $errors->has('new_password') ? 'has-error' : ''}}">
                            <label for="inputName" class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New password">
                                {!! $errors->first('new_password', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : ''}}">
                            <label for="inputEmail" class="col-sm-2 control-label">Re-type Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control confirm_password" name="confirm_password" id="confirm_password" placeholder="Re type Password">
                                {!! $errors->first('confirm_password', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
</div>
<script>
    $(document).ready(function() {
        $("#settings").trigger("click");
        $('#settings').click(function() {
            var selected = $("#tabs").tabs("option", "selected");
            $("#settings").addClass(' active');
        });
    });
</script>
@endsection
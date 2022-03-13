@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="row">
        <div class="col-sm-8 col-md-offset-2">
            <div class="box">
                <div class="box-body">
                    <div class="col-sm-12">
                        <form method="POST"   accept-charset="UTF-8"
                              class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('new_password') ? 'has-error' : ''}}">
                                <label for="inputName" class="col-sm-3 control-label">New Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="new_password" name="new_password"
                                           placeholder="Enter New password">
                                    {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : ''}}">
                                <label for="inputEmail" class="col-sm-3 control-label">Re-type Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control confirm_password" name="confirm_password"
                                           id="confirm_password" placeholder="Re type Password">
                                    {!! $errors->first('confirm_password', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <input class="btn btn-primary" type="submit" value="Change Password">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

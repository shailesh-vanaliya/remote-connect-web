@extends('admin.layouts.admin')
@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Profile</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3>
                        Edit your profile information
                        <a href="{{ route('changePassword') }}" title="Back" class="btn bg-primary btn-flat pull-right"><i class="fa fa-lock" aria-hidden="true"></i> Change Password</a>
                    </h3>

                </div>
                <div class="box-body">

                    <div class="col-lg-12">
                        <form role="form" method="POST" action="{{ route('edit_profile', [ 'id' => $user->id ]) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                                <label for="first_name">{{ 'First Name' }}</label>
                                <input class="form-control" name="first_name" type="text" id="first_name" value="{{ isset($user->first_name) ? $user->first_name :   old('first_name')  }}">
                                {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                                <label for="last_name">{{ 'Last Name' }}</label>
                                <input class="form-control" name="last_name" type="text" id="last_name" value="{{ isset($user->last_name) ? $user->last_name : old('last_name') }}">
                                {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                <label for="email">{{ 'Email' }}</label>
                                <input class="form-control" name="email" type="email" id="email" value="{{ isset($user->email) ? $user->email : old('email') }}">
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                <label for="phone">{{ 'Phone' }}</label>
                                <input class="form-control" name="phone" type="text" id="phone" value="{{ isset($user->phone) ? $user->phone : old('phone') }}">
                                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary pull-left btn-flat" type="submit" value="Update">
                                <a href="{{ route('admin_dashboard') }}" title="Back" class="btn btn-warning pull-right btn-flat"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
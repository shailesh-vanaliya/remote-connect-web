<div class="card-body">
    <div class="form-group row {{ $errors->has('user_name') ? 'has-error' : ''}}">
        <label for="user_name" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'User Name' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" required name="user_name" type="text" id="user_name" value="{{ isset($mqttuser->user_name) ? $mqttuser->user_name : ''}}">
            {!! $errors->first('user_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('password') ? 'has-error' : ''}}">
        <label for="password" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Password' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" required name="password" type="text" id="password" value="{{ isset($mqttuser->password) ? $mqttuser->password : ''}}">
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
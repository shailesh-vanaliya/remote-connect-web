<div class="card-body">
    <div class="form-group row {{ $errors->has('organization_name') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="organization_name" class="control-label">{{ 'Organization Name' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="organization_name" type="text" required id="organization_name" value="{{ isset($organization->organization_name) ? $organization->organization_name : ''}}">
            {!! $errors->first('organization_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('user_count') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="user_count" class="control-label">{{ 'User Count' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="user_count" type="number" required id="user_count" value="{{ isset($organization->user_count) ? $organization->user_count : ''}}">
            {!! $errors->first('user_count', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('device_count') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="device_count" class="control-label">{{ 'Device Count' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="device_count" type="number" required id="device_count" value="{{ isset($organization->device_count) ? $organization->device_count : ''}}">
            {!! $errors->first('device_count', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('max_device_limit') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="max_device_limit" class="control-label">{{ 'Max Device Limit' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="max_device_limit" type="number" required id="max_device_limit" value="{{ isset($organization->max_device_limit) ? $organization->max_device_limit : ''}}">
            {!! $errors->first('max_device_limit', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('max_user_limit') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="max_user_limit" class="control-label">{{ 'Max User Limit' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="max_user_limit" type="number" required id="max_user_limit" value="{{ isset($organization->max_user_limit) ? $organization->max_user_limit : ''}}">
            {!! $errors->first('max_user_limit', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
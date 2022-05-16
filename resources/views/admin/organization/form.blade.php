<div class="box-body">
<div class="form-group {{ $errors->has('organization_name') ? 'has-error' : ''}}">
    <label for="organization_name" class="control-label">{{ 'Organization Name' }}</label>
    <input class="form-control" name="organization_name" type="text" id="organization_name" value="{{ isset($organization->organization_name) ? $organization->organization_name : ''}}" >
    {!! $errors->first('organization_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_count') ? 'has-error' : ''}}">
    <label for="user_count" class="control-label">{{ 'User Count' }}</label>
    <input class="form-control" name="user_count" type="number" id="user_count" value="{{ isset($organization->user_count) ? $organization->user_count : ''}}" >
    {!! $errors->first('user_count', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('device_count') ? 'has-error' : ''}}">
    <label for="device_count" class="control-label">{{ 'Device Count' }}</label>
    <input class="form-control" name="device_count" type="number" id="device_count" value="{{ isset($organization->device_count) ? $organization->device_count : ''}}" >
    {!! $errors->first('device_count', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('max_device_limit') ? 'has-error' : ''}}">
    <label for="max_device_limit" class="control-label">{{ 'Max Device Limit' }}</label>
    <input class="form-control" name="max_device_limit" type="number" id="max_device_limit" value="{{ isset($organization->max_device_limit) ? $organization->max_device_limit : ''}}" >
    {!! $errors->first('max_device_limit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('max_user_limit') ? 'has-error' : ''}}">
    <label for="max_user_limit" class="control-label">{{ 'Max User Limit' }}</label>
    <input class="form-control" name="max_user_limit" type="number" id="max_user_limit" value="{{ isset($organization->max_user_limit) ? $organization->max_user_limit : ''}}" >
    {!! $errors->first('max_user_limit', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
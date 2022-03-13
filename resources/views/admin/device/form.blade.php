<div class="box-body">
    <div class="form-group {{ $errors->has('modem_id') ? 'has-error' : ''}}">
        <label for="modem_id" class="control-label">{{ 'Modem Id' }}</label>
        <input class="form-control" name="modem_id" type="text" id="modem_id" value="{{ isset($device->modem_id) ? $device->modem_id : ''}}">
        {!! $errors->first('modem_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('secret_key') ? 'has-error' : ''}}">
        <label for="secret_key" class="control-label">{{ 'Secret Key' }}</label>
        <input class="form-control" name="secret_key" type="text" id="secret_key" value="{{ isset($device->secret_key) ? $device->secret_key : ''}}">
        {!! $errors->first('secret_key', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('project_name') ? 'has-error' : ''}}">
        <label for="project_name" class="control-label">{{ 'Project Name' }}</label>
        <input class="form-control" name="project_name" type="text" id="project_name" value="{{ isset($device->project_name) ? $device->project_name : ''}}">
        {!! $errors->first('project_name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : ''}}">
        <label for="customer_name" class="control-label">{{ 'Customer Name' }}</label>
        <input class="form-control" name="customer_name" type="text" id="customer_name" value="{{ isset($device->customer_name) ? $device->customer_name : ''}}">
        {!! $errors->first('customer_name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('region') ? 'has-error' : ''}}">
        <label for="region" class="control-label">{{ 'Region' }}</label>
        <input class="form-control" name="region" type="text" id="region" value="{{ isset($device->region) ? $device->region : ''}}">
        {!! $errors->first('region', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
        <label for="location" class="control-label">{{ 'Location' }}</label>
        <input class="form-control" name="location" type="text" id="location" value="{{ isset($device->location) ? $device->location : ''}}">
        {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('machine_type') ? 'has-error' : ''}}">
        <label for="machine_type" class="control-label">{{ 'Machine Type' }}</label>
        <input class="form-control" name="machine_type" type="text" id="machine_type" value="{{ isset($device->machine_type) ? $device->machine_type : ''}}">
        {!! $errors->first('machine_type', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('latitude') ? 'has-error' : ''}}">
        <label for="latitude" class="control-label">{{ 'Latitude' }}</label>
        <input class="form-control" name="latitude" type="text" id="latitude" value="{{ isset($device->latitude) ? $device->latitude : ''}}">
        {!! $errors->first('latitude', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('longitude') ? 'has-error' : ''}}">
        <label for="longitude" class="control-label">{{ 'Longitude' }}</label>
        <input class="form-control" name="longitude" type="text" id="longitude" value="{{ isset($device->longitude) ? $device->longitude : ''}}">
        {!! $errors->first('longitude', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
        <label for="description" class="control-label">{{ 'description' }}</label>
        <textarea class="form-control" name="description" type="text" id="description" value="{{ isset($device->description) ? $device->description : ''}}">
        {{ isset($device->description) ? $device->description : ''}}
        </textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
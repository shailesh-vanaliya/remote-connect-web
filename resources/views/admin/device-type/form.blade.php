<div class="card-body">
<div class="form-group {{ $errors->has('device_type') ? 'has-error' : ''}}">
    <label for="device_type" class="control-label">{{ 'Device Type' }}</label>
    <input class="form-control" name="device_type" type="text" id="device_type" value="{{ isset($devicetype->device_type) ? $devicetype->device_type : ''}}" >
    {!! $errors->first('device_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('data_source') ? 'has-error' : ''}}">
    <label for="data_source" class="control-label">{{ 'Data Source' }}</label>
    <input class="form-control" name="data_source" type="text" id="data_source" value="{{ isset($devicetype->data_source) ? $devicetype->data_source : ''}}" >
    {!! $errors->first('data_source', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('data_table') ? 'has-error' : ''}}">
    <label for="data_table" class="control-label">{{ 'Data Table' }}</label>
    <input class="form-control" name="data_table" type="text" id="data_table" value="{{ isset($devicetype->data_table) ? $devicetype->data_table : ''}}" >
    {!! $errors->first('data_table', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('dashboard_id') ? 'has-error' : ''}}">
    <label for="dashboard_id" class="control-label">{{ 'Dashboard Id' }}</label>
    <input class="form-control" name="dashboard_id" type="text" id="dashboard_id" value="{{ isset($devicetype->dashboard_id) ? $devicetype->dashboard_id : ''}}" >
    {!! $errors->first('dashboard_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('parameter_alias') ? 'has-error' : ''}}">
    <label for="parameter_alias" class="control-label">{{ 'Parameter Alias' }}</label>
    <input class="form-control" name="parameter_alias" type="text" id="parameter_alias" value="{{ isset($devicetype->parameter_alias) ? $devicetype->parameter_alias : ''}}" >
    {!! $errors->first('parameter_alias', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('unit_alias') ? 'has-error' : ''}}">
    <label for="unit_alias" class="control-label">{{ 'Unit Alias' }}</label>
    <input class="form-control" name="unit_alias" type="text" id="unit_alias" value="{{ isset($devicetype->unit_alias) ? $devicetype->unit_alias : ''}}" >
    {!! $errors->first('unit_alias', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('chart_alias') ? 'has-error' : ''}}">
    <label for="chart_alias" class="control-label">{{ 'Chart Alias' }}</label>
    <input class="form-control" name="chart_alias" type="text" id="chart_alias" value="{{ isset($devicetype->chart_alias) ? $devicetype->chart_alias : ''}}" >
    {!! $errors->first('chart_alias', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('dashboard_alias') ? 'has-error' : ''}}">
    <label for="dashboard_alias" class="control-label">{{ 'Dashboard Alias' }}</label>
    <input class="form-control" name="dashboard_alias" type="text" id="dashboard_alias" value="{{ isset($devicetype->dashboard_alias) ? $devicetype->dashboard_alias : ''}}" >
    {!! $errors->first('dashboard_alias', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('model_name') ? 'has-error' : ''}}">
    <label for="model_name" class="control-label">{{ 'Model Name' }}</label>
    <input class="form-control" name="model_name" type="text" id="model_name" value="{{ isset($devicetype->model_name) ? $devicetype->model_name : ''}}" >
    {!! $errors->first('model_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('access_type') ? 'has-error' : ''}}">
    <label for="access_type" class="control-label">{{ 'Access Type' }}</label>
    <input class="form-control" name="access_type" type="text" id="access_type" value="{{ isset($devicetype->access_type) ? $devicetype->access_type : ''}}" >
    {!! $errors->first('access_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('created_by') ? 'has-error' : ''}}">
    <label for="created_by" class="control-label">{{ 'Created By' }}</label>
    <input class="form-control" name="created_by" type="number" id="created_by" value="{{ isset($devicetype->created_by) ? $devicetype->created_by : ''}}" >
    {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('updated_by') ? 'has-error' : ''}}">
    <label for="updated_by" class="control-label">{{ 'Updated By' }}</label>
    <input class="form-control" name="updated_by" type="number" id="updated_by" value="{{ isset($devicetype->updated_by) ? $devicetype->updated_by : ''}}" >
    {!! $errors->first('updated_by', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
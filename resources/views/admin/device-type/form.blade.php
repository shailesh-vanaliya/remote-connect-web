<div class="card-body">
<div class="form-group row {{ $errors->has('device_type') ? 'has-error' : ''}}">
    <label for="device_type" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Device Type' }}</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
    <input class="form-control" name="device_type" type="text" id="device_type" value="{{ isset($devicetype->device_type) ? $devicetype->device_type : ''}}" >
    {!! $errors->first('device_type', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group row {{ $errors->has('data_source') ? 'has-error' : ''}}">
    <label for="data_source" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Data Source' }}</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
    <input class="form-control" name="data_source" type="text" id="data_source" value="{{ isset($devicetype->data_source) ? $devicetype->data_source : ''}}" >
    {!! $errors->first('data_source', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group row {{ $errors->has('data_table') ? 'has-error' : ''}}">
    <label for="data_table" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Data Table' }}</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
    <input class="form-control" name="data_table" type="text" id="data_table" value="{{ isset($devicetype->data_table) ? $devicetype->data_table : ''}}" >
    {!! $errors->first('data_table', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group row {{ $errors->has('dashboard_id') ? 'has-error' : ''}}">
    <label for="dashboard_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Dashboard Id' }}</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
    <input class="form-control" name="dashboard_id" type="text" id="dashboard_id" value="{{ isset($devicetype->dashboard_id) ? $devicetype->dashboard_id : ''}}" >
    {!! $errors->first('dashboard_id', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group row {{ $errors->has('parameter_alias') ? 'has-error' : ''}}">
    <label for="parameter_alias" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Parameter Alias' }}</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
    <textarea class="form-control" name="parameter_alias" type="text" id="parameter_alias" value="{{ isset($devicetype->parameter_alias) ? $devicetype->parameter_alias : ''}}" rows="5">{{ isset($devicetype->parameter_alias) ? $devicetype->parameter_alias : ''}}</textarea>
    {!! $errors->first('parameter_alias', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group row {{ $errors->has('unit_alias') ? 'has-error' : ''}}">
    <label for="unit_alias" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Unit Alias' }}</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
    <textarea class="form-control" name="unit_alias" type="text" id="unit_alias" value="{{ isset($devicetype->unit_alias) ? $devicetype->unit_alias : ''}}" rows="5" >{{ isset($devicetype->unit_alias) ? $devicetype->unit_alias : ''}}</textarea>
    {!! $errors->first('unit_alias', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group row {{ $errors->has('chart_alias') ? 'has-error' : ''}}">
    <label for="chart_alias" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Chart Alias' }}</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
    <textarea class="form-control" name="chart_alias" type="text" id="chart_alias" value="{{ isset($devicetype->chart_alias) ? $devicetype->chart_alias : ''}}" rows="4" >{{ isset($devicetype->chart_alias) ? $devicetype->chart_alias : ''}}</textarea>
    {!! $errors->first('chart_alias', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group row {{ $errors->has('dashboard_alias') ? 'has-error' : ''}}">
    <label for="dashboard_alias" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Dashboard Alias' }}</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
    <textarea class="form-control" name="dashboard_alias" type="text" id="dashboard_alias" value="{{ isset($devicetype->dashboard_alias) ? $devicetype->dashboard_alias : ''}}" rows="4" >{{ isset($devicetype->dashboard_alias) ? $devicetype->dashboard_alias : ''}}</textarea>
    {!! $errors->first('dashboard_alias', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group row {{ $errors->has('model_name') ? 'has-error' : ''}}">
    <label for="model_name" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Model Name' }}</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
    <input class="form-control" name="model_name" type="text" id="model_name" value="{{ isset($devicetype->model_name) ? $devicetype->model_name : ''}}" >
    {!! $errors->first('model_name', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group row {{ $errors->has('access_type') ? 'has-error' : ''}}">
    <label for="access_type" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Access Type' }}</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
    <input class="form-control" name="access_type" type="text" id="access_type" value="{{ isset($devicetype->access_type) ? $devicetype->access_type : ''}}" >
    {!! $errors->first('access_type', '<p class="help-block">:message</p>') !!}
</div>
</div>
<!-- <div class="form-group row {{ $errors->has('created_by') ? 'has-error' : ''}}">
    <label for="created_by" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Created By' }}</label>
    <input class="form-control" name="created_by" type="number" id="created_by" value="{{ isset($devicetype->created_by) ? $devicetype->created_by : ''}}" >
    {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group row {{ $errors->has('updated_by') ? 'has-error' : ''}}">
    <label for="updated_by" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Updated By' }}</label>
    <input class="form-control" name="updated_by" type="number" id="updated_by" value="{{ isset($devicetype->updated_by) ? $devicetype->updated_by : ''}}" >
    {!! $errors->first('updated_by', '<p class="help-block">:message</p>') !!}
</div> -->


<div class="form-group row">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
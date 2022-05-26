<div class="box-body">
<div class="form-group {{ $errors->has('report_id') ? 'has-error' : ''}}">
    <label for="report_id" class="control-label">{{ 'Report Id' }}</label>
    <input class="form-control" name="report_id" type="number" id="report_id" value="{{ isset($reportconfiguration->report_id) ? $reportconfiguration->report_id : ''}}" >
    {!! $errors->first('report_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('device_id') ? 'has-error' : ''}}">
    <label for="device_id" class="control-label">{{ 'Device Id' }}</label>
    <input class="form-control" name="device_id" type="number" id="device_id" value="{{ isset($reportconfiguration->device_id) ? $reportconfiguration->device_id : ''}}" >
    {!! $errors->first('device_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('organization_id') ? 'has-error' : ''}}">
    <label for="organization_id" class="control-label">{{ 'Organization Id' }}</label>
    <input class="form-control" name="organization_id" type="text" id="organization_id" value="{{ isset($reportconfiguration->organization_id) ? $reportconfiguration->organization_id : ''}}" >
    {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('report_title') ? 'has-error' : ''}}">
    <label for="report_title" class="control-label">{{ 'Report Title' }}</label>
    <input class="form-control" name="report_title" type="text" id="report_title" value="{{ isset($reportconfiguration->report_title) ? $reportconfiguration->report_title : ''}}" >
    {!! $errors->first('report_title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('parameter') ? 'has-error' : ''}}">
    <label for="parameter" class="control-label">{{ 'Parameter' }}</label>
    <input class="form-control" name="parameter" type="text" id="parameter" value="{{ isset($reportconfiguration->parameter) ? $reportconfiguration->parameter : ''}}" >
    {!! $errors->first('parameter', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
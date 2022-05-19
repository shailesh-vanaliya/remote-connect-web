<div class="card-body">
    <div class="form-group row {{ $errors->has('device_type_id') ? 'has-error' : ''}}">
        <label for="device_type_id" class="col-sm-2 col-form-label">{{ 'Device Type Id' }}</label>
        <div class="col-sm-5">
            {{ Form::select('device_type_id', $deviceType , empty($report->device_type_id) ? null : $report->device_type_id , array('class' => 'form-control device_type_id', 'id' => 'device_type_id')) }}
            {!! $errors->first('device_type_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row {{ $errors->has('device_id') ? 'has-error' : ''}}">
        <label for="device_id" class="col-sm-2 col-form-label">{{ 'Device Id' }}</label>
        <div class="col-sm-5">
            {{ Form::select('device_id', $device , empty($report->device_id) ? null : $report->device_id , array('class' => 'form-control device_id', 'id' => 'device_id')) }}
            {!! $errors->first('device_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row {{ $errors->has('field_name') ? 'has-error' : ''}}">
        <label for="field_name" class="col-sm-2 col-form-label">{{ 'Field Name' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="field_name" type="text" id="field_name" value="{{ isset($report->field_name) ? $report->field_name : ''}}">
            {!! $errors->first('field_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
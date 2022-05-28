<div class="card-body">
    <div class="form-group row {{ $errors->has('report_id') ? 'has-error' : ''}}">
        <label for="report_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Report Id' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="report_id" type="number" id="report_id" value="{{ isset($reportconfiguration->report_id) ? $reportconfiguration->report_id : ''}}">
            {!! $errors->first('report_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('device_id') ? 'has-error' : ''}}">
        <label for="device_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Device Id' }}</label>
        <div class="col-sm-5">
            <!-- <input class="form-control" name="device_id" type="number" id="device_id" value="{{ isset($reportconfiguration->device_id) ? $reportconfiguration->device_id : ''}}"> -->
            {{ Form::select('device_id', $device , empty($reportconfiguration->device_id) ? null : $reportconfiguration->device_id , array('class' => 'form-control device_id', 'id' => 'device_id')) }}
            {!! $errors->first('device_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('organization_id') ? 'has-error' : ''}}">
        <label for="organization_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Organization Id' }}</label>
        <div class="col-sm-5">
            {{ Form::select('organization_id', $organization , empty($reportconfiguration->organization_id) ? null : $reportconfiguration->organization_id , array('class' => 'form-control organization_id', 'id' => 'organization_id')) }}
            {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('report_title') ? 'has-error' : ''}}">
        <label for="report_title" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Report Title' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="report_title" type="text" id="report_title" value="{{ isset($reportconfiguration->report_title) ? $reportconfiguration->report_title : ''}}">
            {!! $errors->first('report_title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('parameter') ? 'has-error' : ''}}">
        <label for="parameter" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Parameter' }}</label>
        <div class="col-sm-5">
            @php
            $array = (isset($reportconfiguration->parameter)) ? json_decode($reportconfiguration->parameter) : '';
            @endphp
            @foreach($column as $row => $val)
            @php
             $check =  isset($reportconfiguration->parameter) ? (in_array($val,$array) ? 'checked' : '') : '';
            @endphp
            <div class="icheck-primary d-inline mr-5">
                <input type="checkbox" {{ $check  }} value="{{ $val }}" name="parameter[]" id="email_report{{ $row }}">
                <label for="email_report{{ $row }}">{{ $val }}
                </label>
            </div>
            @endforeach
            <!-- <input class="form-control" name="parameter" type="text" id="parameter" value="{{ isset($reportconfiguration->parameter) ? $reportconfiguration->parameter : ''}}"> -->
            <!-- {!! $errors->first('parameter', '<p class="help-block">:message</p>') !!} -->
        </div>
    </div>


    <div class="form-group row">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
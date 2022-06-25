<style>

</style>
<div class="card-body">
    <!-- <div class="form-group row {{ $errors->has('report_id') ? 'has-error' : ''}}">
        <label for="report_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Report Id' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="report_id" type="number" id="report_id" value="{{ isset($reportconfiguration->report_id) ? $reportconfiguration->report_id : ''}}">
            {!! $errors->first('report_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div> -->

    <div class="form-group row {{ $errors->has('device_id') ? 'has-error' : ''}}">
        <label for="device_id" class="col-form-label text-right col-lg-3 col-sm-12 required">{{ 'Device' }}</label>
        <div class="col-sm-5">
            <!-- <input class="form-control" name="device_id" type="number" id="device_id" value="{{ isset($reportconfiguration->device_id) ? $reportconfiguration->device_id : ''}}"> -->
            {{ Form::select('device_id', $device , empty($reportconfiguration->device_id) ? null : $reportconfiguration->device_id , array('class' => 'form-control device_id select2', 'id' => 'device_id','required')) }}
            {!! $errors->first('device_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    @php
    $org = (Auth::guard('admin')->user()->role == 'SUPERADMIN') ? "" : "display:none";
    @endphp
    <div style="{{ $org }}" class="form-group row {{ $errors->has('organization_id') ? 'has-error' : ''}}">
        <label for="organization_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Organization' }}</label>
        <div class="col-sm-5">
            {{ Form::select('organization_id', $organization , empty($reportconfiguration->organization_id) ? null : $reportconfiguration->organization_id , array('class' => 'form-control organization_id select2', 'id' => 'organization_id','required')) }}
            {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('report_title') ? 'has-error' : ''}}">
        <label for="report_title" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Report Title' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="report_title" required type="text" id="report_title" value="{{ isset($reportconfiguration->report_title) ? $reportconfiguration->report_title : ''}}">
            {!! $errors->first('report_title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('parameter') ? 'has-error' : ''}}">
        <label for="parameter" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Parameter' }}</label>
        <div class="col-sm-5">
            <select class="select2 parameter" id="parameter" multiple="multiple" required name="parameter[]" data-placeholder="Select a Parameter" style="width: 100%;">
                @php
                $array = (isset($reportconfiguration->parameter)) ? json_decode($reportconfiguration->parameter) : '';
                @endphp
                @foreach($column as $row => $val)
                @php
                $check = isset($reportconfiguration->parameter) && !empty($array) ? (in_array($row,$array) ? 'selected' : '') : '';
                @endphp
                <option {{ $check  }} value="{{ $row }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row {{ $errors->has('created_by') ? 'has-error' : ''}}">
        <label for="created_by" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Assign To' }}</label>
        <div class="col-lg-5 col-md-9 col-sm-12">
            {{ Form::select('created_by', $createdBy , empty($reportconfiguration->created_by) ? ($formMode != 'edit') ? Auth::guard('admin')->user()->id : null : $reportconfiguration->created_by , array('class' => 'form-control created_by select2', 'id' => 'created_by','required')) }}
            {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row {{ $errors->has('report_type') ? 'has-error' : ''}}">
        <label for="report_type" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Report Type' }}</label>
        <div class="col-lg-5 col-md-9 col-sm-12">
            {{ Form::select('report_type', $reportType , empty($reportconfiguration->report_type) ?  null : $reportconfiguration->report_type , array('class' => 'form-control report_type select2', 'id' => 'report_type','required')) }}
            {!! $errors->first('report_type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="form-group row">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
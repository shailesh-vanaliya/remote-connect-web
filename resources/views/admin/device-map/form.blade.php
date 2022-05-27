<div class="card-body">
<div class="form-group row {{ $errors->has('organization_id') ? 'has-error' : ''}}">
        <label for="organization_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Organization' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('organization_id', $organization , empty($devicemap->organization_id) ? null : $devicemap->organization_id , array('class' => 'form-control organization_id', 'id' => 'organization_id')) }}
            {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row {{ $errors->has('model_no') ? 'has-error' : ''}}">
        <label for="model_no" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Model No' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="model_no" require maxlength="15" type="text" id="model_no" value="{{ isset($device->model_no) ? $device->model_no : ''}}">
            {!! $errors->first('model_no', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('MQTT_ID') ? 'has-error' : ''}}">
        <label for="MQTT_ID" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'MQTT Id' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="MQTT_ID" type="text" id="MQTT_ID" value="{{ isset($devicemap->MQTT_ID) ? $devicemap->MQTT_ID : ''}}">
            {!! $errors->first('MQTT_ID', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('MODEM_ID') ? 'has-error' : ''}}">
        <label for="MODEM_ID" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Modem Id' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="MODEM_ID" type="text" id="MODEM_ID" value="{{ isset($devicemap->MODEM_ID) ? $devicemap->MODEM_ID : ''}}">
            {!! $errors->first('MODEM_ID', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('secret_key') ? 'has-error' : ''}}">
        <label for="secret_key" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Seceret Key' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="secret_key" type="text" id="secret_key" value="{{ isset($devicemap->secret_key) ? $devicemap->secret_key : ''}}">
            {!! $errors->first('secret_key', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('max_user_access') ? 'has-error' : ''}}">
        <label for="max_user_access" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Max User Access' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="max_user_access" type="number" id="max_user_access" value="{{ isset($devicemap->max_user_access) ? $devicemap->max_user_access : ''}}">
            {!! $errors->first('max_user_access', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('IMEI_No') ? 'has-error' : ''}}">
        <label for="IMEI_No" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Imei No' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="IMEI_No" type="number" id="IMEI_No" value="{{ isset($devicemap->IMEI_No) ? $devicemap->IMEI_No : ''}}">
            {!! $errors->first('IMEI_No', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('SIM_No') ? 'has-error' : ''}}">
        <label for="SIM_No" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Sim No' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="SIM_No" type="number" id="SIM_No" value="{{ isset($devicemap->SIM_No) ? $devicemap->SIM_No : ''}}">
            {!! $errors->first('SIM_No', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('SIM_Plan') ? 'has-error' : ''}}">
        <label for="SIM_Plan" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Sim Plan' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <!-- <input class="form-control" name="SIM_Plan" type="text" id="SIM_Plan" value="{{ isset($devicemap->SIM_Plan) ? $devicemap->SIM_Plan : ''}}"> -->
            <select name="SIM_Plan" class="form-control" id="SIM_Plan" >
            @foreach (json_decode('{"1.M2ML 4G 120MB 200 SMS": "1.M2ML 4G 120MB 200 SMS",
                 "2.M2ML 4G 240MB 200 SMS": "2.M2ML 4G 240MB 200 SMS"
                }', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($setting->SIM_Plan) && $setting->SIM_Plan == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
            </select>
            {!! $errors->first('SIM_Plan', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('subscription_expire_date') ? 'has-error' : ''}}">
        <label for="subscription_expire_date" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Subscription Expire Date' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="subscription_expire_date" type="date" id="subscription_expire_date" value="{{ isset($devicemap->subscription_expire_date) ? $devicemap->subscription_expire_date : ''}}">
            {!! $errors->first('subscription_expire_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('subscription_status') ? 'has-error' : ''}}">
        <label for="subscription_status" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Subscription Tatus' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <!-- <input class="form-control" name="subscription_status" type="text" id="subscription_status" value="{{ isset($devicemap->subscription_status) ? $devicemap->subscription_status : ''}}"> -->
            <select name="subscription_status" class="form-control" id="subscription_status" >
            @foreach (json_decode('{"Active": "Active",
                 "InActive": "InActive"
                }', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($setting->subscription_status) && $setting->subscription_status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>

            {!! $errors->first('subscription_status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <!-- <div class="form-group row {{ $errors->has('created_by') ? 'has-error' : ''}}">
        <label for="created_by" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Created By' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="created_by" type="number" id="created_by" value="{{ isset($devicemap->created_by) ? $devicemap->created_by : ''}}">
            {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('updated_by') ? 'has-error' : ''}}">
        <label for="updated_by" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Updated By' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="updated_by" type="number" id="updated_by" value="{{ isset($devicemap->updated_by) ? $devicemap->updated_by : ''}}">
            {!! $errors->first('updated_by', '<p class="help-block">:message</p>') !!}
        </div>
    </div> -->

    <div class="form-group row row">
        <input class="btn btn-primary col-lg-1 col-md-9 col-sm-12 pull-right" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
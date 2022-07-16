<div class="card-body">


    <div class="form-group row {{ $errors->has('model_no') ? 'has-error' : ''}}">
        <label for="model_no" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Model No' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="model_no" require maxlength="15" type="text" id="model_no" value="{{ isset($devicemap->model_no) ? $devicemap->model_no : ''}}">
            {!! $errors->first('model_no', '<p class="help-block">:message</p>') !!}
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
    <div class="form-group row {{ $errors->has('MQTT_ID') ? 'has-error' : ''}}">
        <label for="MQTT_ID" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'MQTT Id' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="MQTT_ID" type="text" id="MQTT_ID" value="{{ isset($devicemap->MQTT_ID) ? $devicemap->MQTT_ID : ''}}">
            {!! $errors->first('MQTT_ID', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('organization_id') ? 'has-error' : ''}}">
        <label for="organization_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Organization' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('organization_id', $organization , empty($devicemap->organization_id) ? null : $devicemap->organization_id , array('class' => 'form-control organization_id', 'id' => 'organization_id')) }}
            {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('organization_id') ? 'has-error' : ''}}">
        <label for="organization_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Device type' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('device_type_id', $deviceType , empty($devicemap->device_type_id) ? null : $devicemap->device_type_id , array('class' => 'form-control device_type_id', 'id' => 'device_type_id')) }}
            {!! $errors->first('device_type_id', '<p class="help-block">:message</p>') !!}
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
            <select name="SIM_Plan" class="form-control" id="SIM_Plan">
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
            <select name="subscription_status" class="form-control" id="subscription_status">
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
    @if(Auth::guard('admin')->user()->role == 'SUPERADMIN')
    <div class="form-group row {{ $errors->has('storage_usage') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="storage_usage">{{ 'Storage usage' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="storage_usage" type="text" id="storage_usage" value="{{ isset($devicemap->storage_usage) ? $devicemap->storage_usage :   old('storage_usage')  }}">
            {!! $errors->first('storage_usage', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row {{ $errors->has('storage_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="storage_quota">{{ 'Storage quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('storage_quota', $storageQuota , empty($devicemap->storage_quota) ?  null : $devicemap->storage_quota , array('class' => 'form-control storage_quota select2', 'id' => 'storage_quota','required')) }}
            {!! $errors->first('storage_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('report_counter') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="report_counter">{{ 'Report counter' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="report_counter" type="text" id="report_counter" value="{{ isset($devicemap->report_counter) ? $devicemap->report_counter :   old('report_counter')  }}">
            {!! $errors->first('report_counter', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('report_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="report_quota">{{ 'Report quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('report_quota', $reportQuota , empty($devicemap->report_quota) ?  null : $devicemap->report_quota , array('class' => 'form-control report_quota select2', 'id' => 'report_quota','required')) }}
            {!! $errors->first('report_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('report_schedule_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="report_schedule_quota">{{ 'Report schedule quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('report_schedule_quota', $reportScheduleQuota , empty($devicemap->report_schedule_quota) ?  null : $devicemap->report_schedule_quota , array('class' => 'form-control report_schedule_quota select2', 'id' => 'report_schedule_quota','required')) }}
            {!! $errors->first('report_schedule_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('sms_counter') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="sms_counter">{{ 'SMS counter' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="sms_counter" type="text" id="sms_counter" value="{{ isset($devicemap->sms_counter) ? $devicemap->sms_counter :   old('sms_counter')  }}">
            {!! $errors->first('sms_counter', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('sms_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="sms_quota">{{ 'SMS quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('sms_quota', $SMSQuota , empty($devicemap->sms_quota) ?  null : $devicemap->sms_quota , array('class' => 'form-control sms_quota select2', 'id' => 'sms_quota','required')) }}
            {!! $errors->first('sms_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('email_counter') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="email_counter">{{ 'Email counter' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="email_counter" type="text" id="email_counter" value="{{ isset($devicemap->email_counter) ? $devicemap->email_counter :   old('email_counter')  }}">
            {!! $errors->first('email_counter', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('email_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="email_quota">{{ 'Email quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('email_quota', $emailQuota , empty($devicemap->email_quota) ?  null : $devicemap->email_quota , array('class' => 'form-control email_quota select2', 'id' => 'email_quota','required')) }}
            {!! $errors->first('email_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('notification_counter') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="notification_counter">{{ 'Notification Counter' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="notification_counter" type="text" id="notification_counter" value="{{ isset($devicemap->notification_counter) ? $devicemap->notification_counter :   old('notification_counter')  }}">
            {!! $errors->first('notification_counter', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row {{ $errors->has('notification_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="notification_quota">{{ 'Notification Quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('notification_quota', $notificationQuota , empty($devicemap->notification_quota) ?  null : $devicemap->notification_quota , array('class' => 'form-control notification_quota select2', 'id' => 'notification_quota','required')) }}
            {!! $errors->first('notification_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    @endif

    <div class="form-group row row">
        <input class="btn btn-primary col-lg-1 col-md-9 col-sm-12 pull-right" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
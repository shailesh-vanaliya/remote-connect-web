<div class="box-body">
    <div class="form-group {{ $errors->has('MQTT_ID') ? 'has-error' : ''}}">
        <label for="MQTT_ID" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'MQTT Id' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="MQTT_ID" type="text" id="MQTT_ID" value="{{ isset($devicemap->MQTT_ID) ? $devicemap->MQTT_ID : ''}}">
            {!! $errors->first('MQTT_ID', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('MODEM_ID') ? 'has-error' : ''}}">
        <label for="MODEM_ID" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Modem Id' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="MODEM_ID" type="text" id="MODEM_ID" value="{{ isset($devicemap->MODEM_ID) ? $devicemap->MODEM_ID : ''}}">
            {!! $errors->first('MODEM_ID', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('secret_key') ? 'has-error' : ''}}">
        <label for="secret_key" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Seceret Key' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="secret_key" type="text" id="secret_key" value="{{ isset($devicemap->secret_key) ? $devicemap->secret_key : ''}}">
            {!! $errors->first('secret_key', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('max_user_acess') ? 'has-error' : ''}}">
        <label for="max_user_acess" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Max User Acess' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="max_user_acess" type="number" id="max_user_acess" value="{{ isset($devicemap->max_user_acess) ? $devicemap->max_user_acess : ''}}">
            {!! $errors->first('max_user_acess', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('IMEI_No') ? 'has-error' : ''}}">
        <label for="IMEI_No" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Imei No' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="IMEI_No" type="number" id="IMEI_No" value="{{ isset($devicemap->IMEI_No) ? $devicemap->IMEI_No : ''}}">
            {!! $errors->first('IMEI_No', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('SIM_No') ? 'has-error' : ''}}">
        <label for="SIM_No" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Sim No' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="SIM_No" type="number" id="SIM_No" value="{{ isset($devicemap->SIM_No) ? $devicemap->SIM_No : ''}}">
            {!! $errors->first('SIM_No', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('SIM_Plan') ? 'has-error' : ''}}">
        <label for="SIM_Plan" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Sim Plan' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="SIM_Plan" type="text" id="SIM_Plan" value="{{ isset($devicemap->SIM_Plan) ? $devicemap->SIM_Plan : ''}}">
            {!! $errors->first('SIM_Plan', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('subscription_expire_date') ? 'has-error' : ''}}">
        <label for="subscription_expire_date" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Subscription Expire Date' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="subscription_expire_date" type="text" id="subscription_expire_date" value="{{ isset($devicemap->subscription_expire_date) ? $devicemap->subscription_expire_date : ''}}">
            {!! $errors->first('subscription_expire_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('subscription_status') ? 'has-error' : ''}}">
        <label for="subscription_status" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Subscription Tatus' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="subscription_status" type="text" id="subscription_status" value="{{ isset($devicemap->subscription_status) ? $devicemap->subscription_status : ''}}">
            {!! $errors->first('subscription_status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('created_by') ? 'has-error' : ''}}">
        <label for="created_by" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Created By' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="created_by" type="number" id="created_by" value="{{ isset($devicemap->created_by) ? $devicemap->created_by : ''}}">
            {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('updated_by') ? 'has-error' : ''}}">
        <label for="updated_by" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Updated By' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="updated_by" type="number" id="updated_by" value="{{ isset($devicemap->updated_by) ? $devicemap->updated_by : ''}}">
            {!! $errors->first('updated_by', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row">
        <input class="btn btn-primary col-lg-1 col-md-9 col-sm-12 pull-right" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
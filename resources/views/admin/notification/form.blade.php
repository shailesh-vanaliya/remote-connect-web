<div class="card-body">
    <div class="form-group row {{ $errors->has('modem_id') ? 'has-error' : ''}}">
        <label for="modem_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Modem Id' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="modem_id" type="text" id="modem_id" value="{{ isset($notification->modem_id) ? $notification->modem_id : ''}}">
            {!! $errors->first('modem_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('alert_message') ? 'has-error' : ''}}">
        <label for="alert_message" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Alert Message' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="alert_message" type="text" id="alert_message" value="{{ isset($notification->alert_message) ? $notification->alert_message : ''}}">
            {!! $errors->first('alert_message', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('is_read') ? 'has-error' : ''}}">
        <label for="is_read" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Is Viwed' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="is_read" type="number" id="is_read" value="{{ isset($notification->is_read) ? $notification->is_read : ''}}">
            {!! $errors->first('is_read', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('is_email_send') ? 'has-error' : ''}}">
        <label for="is_email_send" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Is Email Sent' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="is_email_send" type="number" id="is_email_send" value="{{ isset($notification->is_email_send) ? $notification->is_email_send : ''}}">
            {!! $errors->first('is_email_send', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('is_sms_send') ? 'has-error' : ''}}">
        <label for="is_sms_send" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Is Sms Sent' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="is_sms_send" type="number" id="is_sms_send" value="{{ isset($notification->is_sms_send) ? $notification->is_sms_send : ''}}">
            {!! $errors->first('is_sms_send', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
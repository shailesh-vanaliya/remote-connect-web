<div class="box-body">
<div class="form-group {{ $errors->has('modem_id') ? 'has-error' : ''}}">
    <label for="modem_id" class="control-label">{{ 'Modem Id' }}</label>
    <input class="form-control" name="modem_id" type="text" id="modem_id" value="{{ isset($notification->modem_id) ? $notification->modem_id : ''}}" >
    {!! $errors->first('modem_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('alert_message') ? 'has-error' : ''}}">
    <label for="alert_message" class="control-label">{{ 'Alert Message' }}</label>
    <input class="form-control" name="alert_message" type="text" id="alert_message" value="{{ isset($notification->alert_message) ? $notification->alert_message : ''}}" >
    {!! $errors->first('alert_message', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('is_read') ? 'has-error' : ''}}">
    <label for="is_read" class="control-label">{{ 'Is Read' }}</label>
    <input class="form-control" name="is_read" type="number" id="is_read" value="{{ isset($notification->is_read) ? $notification->is_read : ''}}" >
    {!! $errors->first('is_read', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('is_email_send') ? 'has-error' : ''}}">
    <label for="is_email_send" class="control-label">{{ 'Is Email Send' }}</label>
    <input class="form-control" name="is_email_send" type="number" id="is_email_send" value="{{ isset($notification->is_email_send) ? $notification->is_email_send : ''}}" >
    {!! $errors->first('is_email_send', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('is_sms_send') ? 'has-error' : ''}}">
    <label for="is_sms_send" class="control-label">{{ 'Is Sms Send' }}</label>
    <input class="form-control" name="is_sms_send" type="number" id="is_sms_send" value="{{ isset($notification->is_sms_send) ? $notification->is_sms_send : ''}}" >
    {!! $errors->first('is_sms_send', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
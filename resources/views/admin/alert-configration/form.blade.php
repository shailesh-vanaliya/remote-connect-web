<div class="box-body">
<div class="form-group {{ $errors->has('modem_id') ? 'has-error' : ''}}">
    <label for="modem_id" class="control-label">{{ 'Modem Id' }}</label>
    <input class="form-control" name="modem_id" type="text" id="modem_id" value="{{ isset($alertconfigration->modem_id) ? $alertconfigration->modem_id : ''}}" >
    {!! $errors->first('modem_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('parameter') ? 'has-error' : ''}}">
    <label for="parameter" class="control-label">{{ 'Parameter' }}</label>
    <input class="form-control" name="parameter" type="text" id="parameter" value="{{ isset($alertconfigration->parameter) ? $alertconfigration->parameter : ''}}" >
    {!! $errors->first('parameter', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('condition') ? 'has-error' : ''}}">
    <label for="condition" class="control-label">{{ 'Condition' }}</label>
    <input class="form-control" name="condition" type="text" id="condition" value="{{ isset($alertconfigration->condition) ? $alertconfigration->condition : ''}}" >
    {!! $errors->first('condition', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('set_value') ? 'has-error' : ''}}">
    <label for="set_value" class="control-label">{{ 'Set Value' }}</label>
    <input class="form-control" name="set_value" type="number" id="set_value" value="{{ isset($alertconfigration->set_value) ? $alertconfigration->set_value : ''}}" >
    {!! $errors->first('set_value', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sms_alert') ? 'has-error' : ''}}">
    <label for="sms_alert" class="control-label">{{ 'Sms Alert' }}</label>
    <input class="form-control" name="sms_alert" type="number" id="sms_alert" value="{{ isset($alertconfigration->sms_alert) ? $alertconfigration->sms_alert : ''}}" >
    {!! $errors->first('sms_alert', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email_alert') ? 'has-error' : ''}}">
    <label for="email_alert" class="control-label">{{ 'Email Alert' }}</label>
    <input class="form-control" name="email_alert" type="number" id="email_alert" value="{{ isset($alertconfigration->email_alert) ? $alertconfigration->email_alert : ''}}" >
    {!! $errors->first('email_alert', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
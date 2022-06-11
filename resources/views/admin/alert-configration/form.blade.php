<div class="card-body">
    <div class="form-group row {{ $errors->has('modem_id') ? 'has-error' : ''}}">
        <label for="modem_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Modem Id' }}</label>
        <div class="col-sm-5">
        {{ Form::select('device_id', $device , empty($alertconfigration->modem_id) ? null : $alertconfigration->modem_id , array('class' => 'form-control device_id', 'id' => 'device_id')) }}
            {!! $errors->first('modem_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
   

    <div class="form-group row {{ $errors->has('parameter') ? 'has-error' : ''}}">
        <label for="parameter" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Parameter' }}</label>
        <div class="col-sm-5">
            <select class="form-control parameter" id="parameter"  required name="parameter[]" data-placeholder="Select a Parameter" style="width: 100%;">
                @php
                $array = (isset($alertconfigration->parameter)) ? json_decode($alertconfigration->parameter) : '';
                @endphp
                @foreach($column as $row => $val)
                @php
                $check = isset($alertconfigration->parameter) && !empty($array) ? (in_array($val,$array) ? 'selected' : '') : '';
                @endphp
                <option {{ $check  }} value="{{ $val }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row {{ $errors->has('condition') ? 'has-error' : ''}}">
        <label for="condition" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Condition' }}</label>
        <div class="col-sm-5">
            <select name="condition" class="form-control" id="condition">
                @foreach (json_decode('{"2": ">","1": "<" ,"3": "=","4": "!="}', true) as $optionKey => $optionValue)
                <option value=" {{ $optionKey }}" {{ (isset($alertconfigration->condition) && $alertconfigration->condition == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                    @endforeach
            </select>
            {!! $errors->first('condition', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('set_value') ? 'has-error' : ''}}">
        <label for="set_value" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Set Value' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="set_value" type="number" id="set_value" value="{{ isset($alertconfigration->set_value) ? $alertconfigration->set_value : ''}}">
            {!! $errors->first('set_value', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('sms_alert') ? 'has-error' : ''}}">
        <label for="sms_alert" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Sms Alert' }}</label>
        <div class="col-sm-5">
            <select name="sms_alert" class="form-control" id="sms_alert">
                @foreach (json_decode('{"0": "No", "1": "Yes"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($alertconfigration->sms_alert) && $alertconfigration->sms_alert == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                @endforeach
            </select>
            {!! $errors->first('sms_alert', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('email_alert') ? 'has-error' : ''}}">
        <label for="email_alert" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Email Alert' }}</label>
        <div class="col-sm-5">
            <select name="email_alert" class="form-control" id="email_alert">
                @foreach (json_decode('{"0": "No", "1": "Yes"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($alertconfigration->email_alert) && $alertconfigration->email_alert == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                @endforeach
            </select>
            {!! $errors->first('email_alert', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
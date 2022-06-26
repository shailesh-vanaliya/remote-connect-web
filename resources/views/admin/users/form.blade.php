<div class="card-body">
    <div class="form-group row {{ $errors->has('first_name') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="first_name">{{ 'First Name' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="first_name" type="text" id="first_name" value="{{ isset($user->first_name) ? $user->first_name :   old('first_name')  }}">
            {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('last_name') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="last_name">{{ 'Last Name' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="last_name" type="text" id="last_name" value="{{ isset($user->last_name) ? $user->last_name :   old('last_name')  }}">
            {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('organization_id') ? 'has-error' : ''}}">
        <label for="organization_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Organization' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('organization_id', $organization , empty($user->organization_id) ? null : $user->organization_id , array('class' => 'form-control organization_id', 'id' => 'organization_id')) }}
            {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    @if ($formMode !== 'edit')
    <div class="form-group row {{ $errors->has('email') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="email">{{ 'Email' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="email" type="email" id="email" value="{{ isset($user->email) ? $user->email : old('email') }}">
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('password') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="phone">{{ 'Password' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="password" type="password" id="password" value="">
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="phone">{{ 'Confirm Password' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input type="password" name="password_confirmation" class="form-control">
            {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    @endif
    <div class="form-group row {{ $errors->has('mobile_no') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="mobile_no">{{ 'Mobile Number' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="mobile_no" type="text" id="mobile_no" value="{{ isset($user->mobile_no) ? $user->mobile_no : old('mobile_no') }}">
            {!! $errors->first('mobile_no', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row {{ $errors->has('status') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="status" class="control-label">{{ 'Status' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <select name="status" class="form-control" id="status">
                @foreach (json_decode('{"ACTIVE": "Active", "INACTIVE": "Inactive"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($user->status) && $user->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                @endforeach
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('role') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="role" class="control-label">{{ 'role' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('role', $roles , empty($user->role) ?  null : $user->role , array('class' => 'form-control role select2', 'id' => 'storage_quota','required')) }}

            <!-- <select name="role" class="form-control" id="role">
                @foreach (json_decode('{"ADMIN": "ADMIN", "USER": "USER","ENG": "ENG"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($user->role) && $user->role == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                @endforeach
            </select> -->
            {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    @if(Auth::guard('admin')->user()->role == 'SUPERADMIN')
    <div class="form-group row {{ $errors->has('storage_usage') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="storage_usage">{{ 'Storage usage' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="storage_usage" type="text" id="storage_usage" value="{{ isset($user->storage_usage) ? $user->storage_usage :   old('storage_usage')  }}">
            {!! $errors->first('storage_usage', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row {{ $errors->has('storage_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="storage_quota">{{ 'Storage quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <!-- <input class="form-control" name="storage_quota" type="text" id="storage_quota" value="{{ isset($user->storage_quota) ? $user->storage_quota :   old('storage_quota')  }}"> -->
            {{ Form::select('storage_quota', $storageQuota , empty($user->storage_quota) ?  null : $user->storage_quota , array('class' => 'form-control storage_quota select2', 'id' => 'storage_quota','required')) }}
            {!! $errors->first('storage_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('report_counter') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="report_counter">{{ 'Report counter' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="report_counter" type="text" id="report_counter" value="{{ isset($user->report_counter) ? $user->report_counter :   old('report_counter')  }}">
            {!! $errors->first('report_counter', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('report_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="report_quota">{{ 'Report quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <!-- <input class="form-control" name="report_quota" type="text" id="report_quota" value="{{ isset($user->report_quota) ? $user->report_quota :   old('report_quota')  }}"> -->
            {{ Form::select('report_quota', $reportQuota , empty($user->report_quota) ?  null : $user->report_quota , array('class' => 'form-control report_quota select2', 'id' => 'report_quota','required')) }}
            {!! $errors->first('report_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('report_schedule_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="report_schedule_quota">{{ 'Report schedule quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
             {{ Form::select('report_schedule_quota', $reportScheduleQuota , empty($user->report_schedule_quota) ?  null : $user->report_schedule_quota , array('class' => 'form-control report_schedule_quota select2', 'id' => 'report_schedule_quota','required')) }}
            {!! $errors->first('report_schedule_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('sms_counter') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="sms_counter">{{ 'SMS counter' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="sms_counter" type="text" id="sms_counter" value="{{ isset($user->sms_counter) ? $user->sms_counter :   old('sms_counter')  }}">
            {!! $errors->first('sms_counter', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('sms_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="sms_quota">{{ 'SMS quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <!-- <input class="form-control" name="sms_quota" type="text" id="sms_quota" value="{{ isset($user->sms_quota) ? $user->sms_quota :   old('sms_quota')  }}"> -->
            {{ Form::select('sms_quota', $SMSQuota , empty($user->sms_quota) ?  null : $user->sms_quota , array('class' => 'form-control sms_quota select2', 'id' => 'sms_quota','required')) }}
            {!! $errors->first('sms_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('email_counter') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="email_counter">{{ 'Email counter' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="email_counter" type="text" id="email_counter" value="{{ isset($user->email_counter) ? $user->email_counter :   old('email_counter')  }}">
            {!! $errors->first('email_counter', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('email_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="email_quota">{{ 'Email quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <!-- <input class="form-control" name="email_quota" type="text" id="email_quota" value="{{ isset($user->email_quota) ? $user->email_quota :   old('email_quota')  }}"> -->
            {{ Form::select('email_quota', $emailQuota , empty($user->email_quota) ?  null : $user->email_quota , array('class' => 'form-control email_quota select2', 'id' => 'email_quota','required')) }}
            {!! $errors->first('email_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('notification_counter') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="notification_counter">{{ 'Notification Counter' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="notification_counter" type="text" id="notification_counter" value="{{ isset($user->notification_counter) ? $user->notification_counter :   old('notification_counter')  }}">
            {!! $errors->first('notification_counter', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row {{ $errors->has('notification_quota') ? 'has-error' : ''}}">
        <label class="col-form-label text-right col-lg-3 col-sm-12" for="notification_quota">{{ 'Notification Quota' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <!-- <input class="form-control" name="notification_quota" type="text" id="notification_quota" value="{{ isset($user->notification_quota) ? $user->notification_quota :   old('notification_quota')  }}"> -->
            {{ Form::select('notification_quota', $notificationQuota , empty($user->notification_quota) ?  null : $user->notification_quota , array('class' => 'form-control notification_quota select2', 'id' => 'notification_quota','required')) }}
            {!! $errors->first('notification_quota', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif
    <div class="form-group row {{ $errors->has('email_alert') ? 'has-error' : ''}}">
        <label class="  text-right col-lg-3 col-sm-12  mt-0" for="email_alert" class="control-label">{{ 'Email Alert' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="email_alert" {{  isset($user->email_alert) &&  $user->email_alert == 1 ? 'checked' :'' }} id="email_alert">
                <label for="email_alert">
                </label>
            </div>
            {!! $errors->first('email_alert', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('sms_alert') ? 'has-error' : ''}}">
        <label class="  text-right col-lg-3 col-sm-12  mt-0" for="sms_alert" class="control-label">{{ 'SMS Alert' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="sms_alert" {{ isset($user->sms_alert) && $user->sms_alert == 1 ? 'checked' :'' }} id="sms_alert">
                <label for="sms_alert">
                </label>
            </div>
            {!! $errors->first('sms_alert', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('email_report') ? 'has-error' : ''}}">
        <label class="  text-right col-lg-3 col-sm-12  mt-0" for="email_report" class="control-label">{{ 'Email Report' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="icheck-primary d-inline">
                <input type="checkbox" {{  isset($user->email_report) &&  $user->email_report == 1 ? 'checked' :'' }} name="email_report" id="email_report">
                <label for="email_report">
                </label>
            </div>
            {!! $errors->first('email_report', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row ">
        <input class="btn btn-primary col-lg-1 col-md-9 col-sm-12 float-left" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
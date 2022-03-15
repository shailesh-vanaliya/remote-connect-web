<div class="box-body">
    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
        <label for="first_name">{{ 'First Name' }}</label>
        <input class="form-control" name="first_name" type="text" id="first_name" value="{{ isset($user->first_name) ? $user->first_name :   old('first_name')  }}">
        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
        <label for="last_name">{{ 'Last Name' }}</label>
        <input class="form-control" name="last_name" type="text" id="last_name" value="{{ isset($user->last_name) ? $user->last_name :   old('last_name')  }}">
        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
    </div>

    @if ($formMode !== 'edit')
    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
        <label for="email">{{ 'Email' }}</label>
        <input class="form-control" name="email" type="email" id="email" value="{{ isset($user->email) ? $user->email : old('email') }}">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
        <label for="phone">{{ 'Password' }}</label>
        <input class="form-control" name="password" type="password" id="password" value="">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
        <label for="phone">{{ 'Confirm Password' }}</label>
        <input type="password" name="password_confirmation" class="form-control">
        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
    </div>
    @endif
    <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : ''}}">
        <label for="mobile_no">{{ 'Mobile Number' }}</label>
        <input class="form-control" name="mobile_no" type="text" id="mobile_no" value="{{ isset($user->mobile_no) ? $user->mobile_no : old('mobile_no') }}">
        {!! $errors->first('mobile_no', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
        <label for="status" class="control-label">{{ 'Status' }}</label>
        <select name="status" class="form-control" id="status">
            @foreach (json_decode('{"ACTIVE": "Active", "INACTIVE": "Inactive"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($user->status) && $user->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
        <label for="role" class="control-label">{{ 'role' }}</label>
        <select name="role" class="form-control" id="role">
            @foreach (json_decode('{"ADMIN": "ADMIN", "USER": "USER"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($user->role) && $user->role == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="box-footer">
    <div class="form-group">
        <input class="btn btn-primary pull-left" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
        <a href="{{ url('/admin/users') }}" title="Back" class="btn btn-warning pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
    </div>
</div>
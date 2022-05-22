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
            <select name="role" class="form-control" id="role">
                @foreach (json_decode('{"ADMIN": "ADMIN", "USER": "USER","ENG": "ENG"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($user->role) && $user->role == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                @endforeach
            </select>
            {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row ">
        <input class="btn btn-primary col-lg-1 col-md-9 col-sm-12 float-left" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
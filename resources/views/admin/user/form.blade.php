<div class="form-group ">
    <label for="organization_name" class="col-sm-2 control-label">Organization Name</label>
    <div class="col-sm-10 {{ $errors->has('organization_name') ? 'has-error' : ''}}">
        <input type="text" class="form-control" id="organization_name"
               value="{{ isset($user->organization_name) ? $user->organization_name : old('organization_name')}}"
               name="organization_name" >
        {!! $errors->first('organization_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="first_name" class="col-sm-2 control-label">{{ 'First Name' }}</label>
    <div class="col-sm-10 {{ $errors->has('first_name') ? 'has-error' : ''}}">
        <input class="form-control" name="first_name" type="text" id="first_name" value="{{ isset($user->first_name) ? $user->first_name : old('first_name')}}" >
        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="last_name" class="col-sm-2 control-label">{{ 'Last Name' }}</label>
    <div class="col-sm-10 {{ $errors->has('last_name') ? 'has-error' : ''}}">
        <input class="form-control" name="last_name" type="text" id="last_name" value="{{ isset($user->last_name) ? $user->last_name : old('last_name')}}" >
        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="email" class="col-sm-2 control-label">{{ 'Email' }}</label>
    <div class="col-sm-10 {{ $errors->has('email') ? 'has-error' : ''}}">
        <input class="form-control" name="email" type="text" id="email" value="{{ isset($user->email) ? $user->email : old('email') }}" >
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    @if (!isset($user->password))
        <label for="password" class="col-sm-2 control-label">{{ 'Password' }}</label>
        <div class="col-sm-10 {{ $errors->has('password') ? 'has-error' : ''}}">
            <input class="form-control" name="password" type="password" id="password" >
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    @endif
</div>
<div class="form-group">
    <label for="status" class="col-sm-2 control-label">{{ 'Status' }}</label>
    <div class="col-sm-10 {{ $errors->has('status') ? 'has-error' : ''}}">
        <select name="status" class="form-control" id="status" >
            @foreach (json_decode('{"Inactive": "Inactive", "Active": "Active"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($user->status) && $user->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="user_type" class="col-sm-2 control-label">{{ 'Role' }}</label>
    <div class="col-sm-10 {{ $errors->has('status') ? 'has-error' : ''}}">
        <select name="user_type" class="form-control" id="user_type" >
            @foreach (json_decode('{"USER": "CLIENT", "ADMIN": "ADMIN"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($user->user_type) && $user->user_type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('user_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create Client' }}">
    </div>
</div>

<div class="box-body">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($setting->title) ? $setting->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<!-- <div class="form-group {{ $errors->has('meta_key') ? 'has-error' : ''}}">
    <label for="meta_key" class="control-label">{{ 'Meta Key' }}</label>
    <input class="form-control" name="meta_key" type="text" id="meta_key" value="{{ isset($setting->meta_key) ? $setting->meta_key : ''}}" >
    {!! $errors->first('meta_key', '<p class="help-block">:message</p>') !!}
</div> -->
<div class="form-group {{ $errors->has('meta_value') ? 'has-error' : ''}}">
    <label for="meta_value" class="control-label">{{ 'Meta Value' }}</label>
    <input class="form-control" name="meta_value" type="text" id="meta_value" value="{{ isset($setting->meta_value) ? $setting->meta_value : ''}}" >
    {!! $errors->first('meta_value', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <select name="status" class="form-control" id="status" >
    @foreach (json_decode('{"ACTIVE": "ACTIVE", "INACTIVE": "INACTIVE"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($setting->status) && $setting->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<!--
<div class="form-group {{ $errors->has('platform') ? 'has-error' : ''}}">
    <label for="platform" class="control-label">{{ 'Platform' }}</label>
    <select name="platform" class="form-control" id="platform" >
    @foreach (json_decode('{"Android": "Android", "Iphone": "Iphone", "Web": "Web", "Admin": "Admin"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($setting->platform) && $setting->platform == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('platform', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('country_id') ? 'has-error' : ''}}">
    <label for="country_id" class="control-label">{{ 'Country Id' }}</label>
    <input class="form-control" name="country_id" type="number" id="country_id" value="{{ isset($setting->country_id) ? $setting->country_id : ''}}" >
    {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('created_by') ? 'has-error' : ''}}">
    <label for="created_by" class="control-label">{{ 'Created By' }}</label>
    <input class="form-control" name="created_by" type="number" id="created_by" value="{{ isset($setting->created_by) ? $setting->created_by : ''}}" >
    {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('updated_by') ? 'has-error' : ''}}">
    <label for="updated_by" class="control-label">{{ 'Updated By' }}</label>
    <input class="form-control" name="updated_by" type="number" id="updated_by" value="{{ isset($setting->updated_by) ? $setting->updated_by : ''}}" >
    {!! $errors->first('updated_by', '<p class="help-block">:message</p>') !!}
</div>
-->
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>

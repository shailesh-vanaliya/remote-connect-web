<div class="card-body">
    <div class="form-group row {{ $errors->has('model_no') ? 'has-error' : ''}}">
        <label for="model_no" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Model No' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" readonly name="model_no" maxlength="15" type="text" id="model_no" value="{{ isset($device->model_no) ? $device->model_no : ''}}">
            {!! $errors->first('model_no', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    @php
    $org = (Auth::guard('admin')->user()->role == 'SUPERADMIN') ? "" : "display:none";
    @endphp
    <div style="{{ $org }}" class="form-group row {{ $errors->has('organization_id') ? 'has-error' : ''}}">
        <label for="organization_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Organization' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            {{ Form::select('organization_id', $organization , empty($device->organization_id) ? null : $device->organization_id , array('class' => 'form-control organization_id select2', 'id' => 'organization_id','required')) }}
            {!! $errors->first('organization_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <!-- <input type="hidden" class="organization_id" id="organization_id" name="organization_id" value=""> -->
    <div class="form-group row {{ $errors->has('modem_id') ? 'has-error' : ''}}">
        <label for="modem_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Modem Id' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="modem_id" type="text" maxlength="10" id="modem_id" value="{{ isset($device->modem_id) ? $device->modem_id : ''}}">
            {!! $errors->first('modem_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('secret_key') ? 'has-error' : ''}}">
        <label for="secret_key" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Secret Key' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="secret_key" maxlength="15" type="text" id="secret_key" value="{{ isset($device->secret_key) ? $device->secret_key : ''}}">
            {!! $errors->first('secret_key', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('project_name') ? 'has-error' : ''}}">
        <label for="project_name" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Project Name' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="project_name" maxlength="50" type="text" id="project_name" value="{{ isset($device->project_name) ? $device->project_name : ''}}">
            {!! $errors->first('project_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('customer_name') ? 'has-error' : ''}}">
        <label for="customer_name" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Customer Name' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="customer_name" maxlength="30" type="text" id="customer_name" value="{{ isset($device->customer_name) ? $device->customer_name : ''}}">
            {!! $errors->first('customer_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('region') ? 'has-error' : ''}}">
        <label for="region" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Region' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <select name="region" class="form-control" id="region">
                @foreach (json_decode('{"Gujrat": "Gujrat",
                "Andaman and Nicobar Islands": "Andaman and Nicobar Islands",
                "Andhra Pradesh": "Andhra Pradesh",
                "Arunachal Pradesh": "Arunachal Pradesh",
                "Assam": "Assam",
                "Bihar": "Bihar",
                "Chandigarh": "Chandigarh",
                "Chhattisgarh": "Chhattisgarh",
                "Dadra and Nagar Haveli": "Dadra and Nagar Haveli",
                "Daman and Diu": "Daman and Diu",
                "Delhi": "Delhi",
                "Goa": "Goa",
                "Gujarat": "Gujarat",
                "Haryana": "Haryana",
                "Himachal Pradesh": "Himachal Pradesh",
                "Jammu and Kashmir": "Jammu and Kashmir",
                "Jharkhand": "Jharkhand",
                "Karnataka": "Karnataka",
                "Kerala": "Kerala",
                "Ladakh": "Ladakh",
                "Lakshadweep": "Lakshadweep",
                "Madhya Pradesh": "Madhya Pradesh",
                "Maharashtra": "Maharashtra",
                "Manipur": "Manipur",
                "Meghalaya": "Meghalaya",
                "Mizoram": "Mizoram",
                "Nagaland": "Nagaland",
                "Odisha": "Odisha",
                "Puducherry": "Puducherry",
                "Punjab": "Punjab",
                "Rajasthan": "Rajasthan",
                "Sikkim": "Sikkim",
                "Tamil Nadu": "Tamil Nadu",
                "Telangana": "Telangana",
                "Tripura": "Tripura",
                "Uttar Pradesh": "Uttar Pradesh",
                "Uttarakhand": "Uttarakhand",
                "West Bengal": "West Bengal"
                }', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($setting->region) && $setting->region == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                @endforeach
            </select>
            <!-- <input class="form-control" name="region" type="text" id="region" value="{{ isset($device->region) ? $device->region : ''}}"> -->
            {!! $errors->first('region', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('location') ? 'has-error' : ''}}">
        <label for="location" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Location' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="location" type="text" id="location" placeholder="Enter a location" autocomplete="on" runat="server" value="{{ isset($device->location) ? $device->location : ''}}">
            <!-- <input id="searchTextField" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" /> -->
            {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('machine_type') ? 'has-error' : ''}}">
        <label for="machine_type" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Machine Type' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="machine_type" type="text" id="machine_type" value="{{ isset($device->machine_type) ? $device->machine_type : ''}}">
            {!! $errors->first('machine_type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('latitude') ? 'has-error' : ''}}">
        <label for="latitude" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Latitude' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="latitude" type="text" id="latitude" value="{{ isset($device->latitude) ? $device->latitude : ''}}">
            {!! $errors->first('latitude', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('longitude') ? 'has-error' : ''}}">
        <label for="longitude" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Longitude' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="longitude" type="text" id="longitude" value="{{ isset($device->longitude) ? $device->longitude : ''}}">
            {!! $errors->first('longitude', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('description') ? 'has-error' : ''}}">
        <label for="description" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Description/Note' }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <textarea class="form-control" name="description" type="text" id="description" value="{{ isset($device->description) ? $device->description : ''}}">
            {{ isset($device->description) ? $device->description : ''}}
            </textarea>
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row row">
        <input class="btn btn-primary col-lg-1 col-md-9 col-sm-12 pull-right" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
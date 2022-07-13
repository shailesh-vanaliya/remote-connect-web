<div class="card-body">
    <!-- <div class="form-group row {{ $errors->has('report_id') ? 'has-error' : ''}}">
        <label for="report_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Report Id' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="report_id" type="number" id="report_id" value="{{ isset($reportschedule->report_id) ? $reportschedule->report_id : ''}}">
            {!! $errors->first('report_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div> -->
    <div class="form-group row {{ $errors->has('report_config_id') ? 'has-error' : ''}}">
        <label for="device_id" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Report Config Id' }}</label>
        <div class="col-sm-5">
            {{ Form::select('report_config_id', $reportConfiguration , empty($reportschedule->report_config_id) ? null : $reportschedule->report_config_id , array('class' => 'form-control report_config_id', 'id' => 'report_config_id','required')) }}
            {!! $errors->first('report_config_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('start_time') ? 'has-error' : ''}}">
        <label for="start_time" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Start Time' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="start_time" type="time" id="start_time" required value="{{ isset($reportschedule->start_time) ? $reportschedule->start_time : ''}}">
            {!! $errors->first('start_time', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('end_time') ? 'has-error' : ''}}">
        <label for="end_time" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'End Time' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="end_time" type="time" id="end_time" required value="{{ isset($reportschedule->end_time) ? $reportschedule->end_time : ''}}">
            {!! $errors->first('end_time', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row {{ $errors->has('execution_time') ? 'has-error' : ''}}">
        <label for="execution_time" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Execution Time' }}</label>
        <div class="col-sm-5">
            <input class="form-control" name="execution_time" type="time" id="execution_time" required value="{{ isset($reportschedule->execution_time) ? $reportschedule->execution_time : ''}}">
            {!! $errors->first('execution_time', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row {{ $errors->has('repeat_on') ? 'has-error' : ''}}">
        <label for="repeat_on" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Repeat on' }}</label>
        <div class="col-sm-5">
            @php
            $array = (isset($reportschedule->repeat_on)) ? json_decode($reportschedule->repeat_on) : '';
            @endphp
            @foreach($days as $row => $val)
            @php
            $check = isset($reportschedule->repeat_on) ? (in_array($val,$array) ? 'checked' : '') : '';
            @endphp
            <div class="icheck-primary d-inline mr-5">
                <input type="checkbox" {{ $check  }} value="{{ $val }}" name="repeat_on[]" id="email_report{{ $row }}">
                <label for="email_report{{ $row }}">{{ $val }}
                </label>
            </div>
            @endforeach
        </div>
    </div>

    <!-- <div class="form-group row {{ $errors->has('sender_user_list') ? 'has-error' : ''}}">
        <label for="sender_user_list" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Sender User List' }}</label>
        <div class="col-sm-5">
            <div class="col-sm-5">
                @php
                $usr = (isset($reportschedule->sender_user_list)) ? json_decode($reportschedule->sender_user_list) : '';
                @endphp
                @foreach($userList as $row => $val)
                @php
                $check = isset($reportschedule->sender_user_list) ? (in_array($val,$usr) ? 'checked' : '') : '';
                @endphp
                <div class="icheck-primary d-inline mr-5">
                    <input type="checkbox" {{ $check  }} value="{{ $val }}" name="sender_user_list[]" id="user{{ $row }}">
                    <label for="user{{ $row }}">{{ $val }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div> -->

    <div class="form-group row {{ $errors->has('sender_user_list') ? 'has-error' : ''}}">
        <label for="sender_user_list" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Sender User List' }}</label>
        <div class="col-sm-5">
            <select class="select2 sender_user_list" id="sender_user_list" multiple="multiple" required name="sender_user_list[]" data-placeholder="Select Sender User List" style="width: 100%;">
                @php
                $usr = (isset($reportschedule->sender_user_list)) ? json_decode($reportschedule->sender_user_list) : '';
                @endphp
                @foreach($userList as $row => $val)
                @php
                $check = isset($reportschedule->sender_user_list) ? (in_array($row,$usr) ? 'selected' : '') : '';
                @endphp
                <option {{ $check  }} value="{{ $row }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div  class="form-group row {{ $errors->has('created_by') ? 'has-error' : ''}}">
        <label for="created_by" class="col-form-label text-right col-lg-3 col-sm-12">{{ 'Assign to' }}</label>
        <div class="col-lg-5 col-md-9 col-sm-12">
            {{ Form::select('created_by', $createdBy , empty($reportschedule->created_by) ? ($formMode != 'edit') ? Auth::guard('admin')->user()->id : null : $reportschedule->created_by , array('class' => 'form-control created_by select2', 'id' => 'created_by','required')) }}
            {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="form-group row">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
@extends('admin.layouts.admin')
@section('title', $pagetitle )
@section('content')
<!-- Main content -->
<style>
  .bg-success {
    background-color: #01a89d !important;
    /* background-color: #adb5bd !important; */
  }

  .card-primary:not(.card-outline)>.card-header {
    background-color: #01a89d;
  }

  .card-primary.card-outline {
    border-top: 3px solid #01a89d;
  }

  .iconColor {
    color: #fff;
  }

  .amcharts-LineSeries-bullets .amcharts-Circle {
    fill-opacity: 0.5;
    fill: red !important;
  }

  .profile-user-img {
    border: 4px solid #3e9ae2;
    padding: 5px;
  }
</style>
<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
  $dynamicUrl =  asset('') . 'public/';
} else {
  $dynamicUrl = asset('') . 'public/';
}
if ($device->Status == 1) {
  $sss = "";
} else {
  $sss = "opacity: 0.5;cursor: not-allowed !important;";
}

?>
<script src="{{ asset($dynamicUrl.'js/amcharts/index.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/amcharts/xy.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/amcharts/Animated.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/amcharts/Responsive.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/amcharts/exporting.js') }}"></script>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
            @php
              $nm = str_replace("_","",$device->device_type.'.png');
              $imageName =  asset('/public/uploads/device/' . $nm );
              @endphp
              <img class="profile-user-img img-fluid img-circle" src="{{ $imageName }}" alt="Device picture">
            </div>

            <h3 class="profile-username text-center">{{ (isset($device->modem_id) && !empty($device->modem_id) ? $device->modem_id : 'N/A') }}</h3>

            <p class="text-muted text-center" style="margin-bottom: 0.1rem">{{ (isset($device->project_name) && !empty($device->project_name) ? $device->project_name : 'N/A') }}</p>

            <p class="text-muted text-center" style="margin-bottom: 0.1rem">Status:
              @if($device->Status == 1)
              <small class=" badge bg-success">
                Online
              </small>
              @else
              <small class=" badge bg-danger">
                Offline
              </small>
              @endif
            </p>
            <p class="text-muted text-center" style="margin-bottom: 0.1rem">Last Network Strength: <small class=" badge bg-success">
                Good</small></p>


            <p class="text-muted text-center" style="margin-bottom: 0.1rem">Last Data At: <small> {{ isset($result->dtm) &&  !empty($result->dtm) ?  date('d/m/Y h:i:s A', strtotime($result->dtm)) : '' }}</small></p>
            <p class="text-muted text-center" style="margin-bottom: 0.1rem">Added On: <small>{{ (isset($device->created_at) && !empty($device->created_at) ?  date('d/m/Y h:i:s A', strtotime($device->created_at)) : 'N/A') }}</small></p>
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVqNumGk1DCDuthLx-X7YqutsMm6DReNA&region=india&libraries=places"></script>
            <div id="map" class="col-md-12" style=" height: 220px;"></div>
            <input type="hidden" name="latitude" class="latitude" value="{{ isset($device->latitude) ? $device->latitude : 'N/A' }}">
            <input type="hidden" name="longitude" class="longitude" value="{{ isset($device->longitude) ? $device->longitude : 'N/A' }}">
            <input type="hidden" name="location" class="location" value="{{ isset($device->location) ? $device->location : '' }}">
            <input type="hidden" name="deviceId" class="deviceId" value="{{ isset($device->id) ? $device->id : '' }}">
            <input type="hidden" name="Status" class="Status" value="{{ isset($device->Status) ? $device->Status : '' }}">
            <span class="text-center">{{ (isset($device->location) && !empty($device->location) ? $device->location : 'N/A') }}</span>
          </div>
          <div class="col-md-12">
            <p class="text-center">
              <strong>Usage Counter</strong>
            </p>
            @php
            $var1 = ( $device['storage_quota'] > 0 && ($device['storage_usage'] * 100) > 0 ) ? ($device['storage_usage'] * 100) / $device['storage_quota'] : 0;
            @endphp
            <div class="progress-group">
              Storage Usage
              <span class="float-right"><b>{{ $device['storage_usage']}}</b>/{{ $device['storage_quota'] }}mb</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-primary" style="width: {{ $var1 }}%"></div>
              </div>
            </div>
            <!-- /.progress-group -->
            @php
            $var1 = ( $device['report_quota'] > 0 && ($device['report_counter'] * 100) > 0 ) ? ($device['report_counter'] * 100) / $device['report_quota'] : 0;
            @endphp
            <div class="progress-group">
              Report Counter
              <span class="float-right"><b>{{ $device['report_counter']}}</b>/{{ $device['report_quota'] }}</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-danger" style="width: {{ $var1 }}%"></div>
              </div>
            </div>
            @php
            $var1 = ( $device['sms_quota'] > 0 && ($device['sms_counter'] * 100) > 0 ) ? ($device['sms_counter'] * 100) / $device['sms_quota'] : 0;
            @endphp
            <!-- /.progress-group -->
            <div class="progress-group">
              <span class="progress-text">SMS Counter</span>
              <span class="float-right"><b>{{ $device['sms_counter']}}</b>/{{ $device['sms_quota'] }}</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-success" style="width: {{ $var1 }}%"></div>
              </div>
            </div>

            <!-- /.progress-group -->
            <div class="progress-group">
              EMAIL Counter
              @php
              $var = ( $device['email_quota'] > 0 && ($device['email_counter'] * 100) > 0 ) ? ($device['email_counter'] * 100) / $device['email_quota'] : 0;
              @endphp
              <span class="float-right"><b>{{ $device['email_counter']}}</b>/{{ $device['email_quota'] }}</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-warning" style="width: {{ $var }}%"></div>
              </div>
            </div>
            @php
            $var1 = ( $device['notification_quota'] > 0 && ($device['notification_counter'] * 100) > 0 ) ? ($device['notification_counter'] * 100) / $device['notification_quota'] : 0;
            @endphp
            <div class="progress-group">
              Notification
              <span class="float-right"><b>{{ $device['notification_counter']}}</b>/{{ $device->notification_quota }}</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-secondary" style="width: {{ $var1 }}%"></div>
              </div>
            </div>
            <!-- /.progress-group -->
          </div>
        </div>


      </div>
      <div class="col-md-9">
        <div class="col-md-12">
          <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-five-overlay-tab" data-toggle="pill" href="#custom-tabs-five-overlay" role="tab" aria-controls="custom-tabs-five-overlay" aria-selected="true">Display</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-five-overlay-dark-tab" data-toggle="pill" href="#custom-tabs-five-overlay-dark" role="tab" aria-controls="custom-tabs-five-overlay-dark" aria-selected="false">Weekly Flow</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-flow-meter-dark-tab" data-toggle="pill" href="#custom-tabs-flow-meter-dark" role="tab" aria-controls="custom-tabs-flow-meter-dark" aria-selected="false">Monthly Flow</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-setting-tab" data-toggle="pill" href="#custom-tabs-setting-dark" role="tab" aria-controls="custom-tabs-setting-dark" aria-selected="false">Setting</a>
                </li> -->
              </ul>
            </div>

            <div class="card-body">
              <div class="tab-content" id="custom-tabs-five-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
                  <div class="row">

                    <div class="col-lg-4 col-12">
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 2.8rem">{{ (isset($result->D0) ? $result->D0 : '' )}}<sup style="font-size: 20px">{{ isset($unit_alias['D0']) ? $unit_alias['D0'] : '' }}</sup></h3>
                          <p style="margin: 0;margin-bottom: unset">{{ isset($dashboard_alias['DISPLAY11_TITLE']) ? $dashboard_alias['DISPLAY11_TITLE'] : '' }} </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars iconColor"></i>
                        </div>

                      </div>
                    </div>
                    <div class="col-lg-4 col-12">
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 2.8rem">{{ isset($result->D1) ? $result->D1 : '' }}<sup style="font-size: 20px">{{ isset($unit_alias['D1']) ? $unit_alias['D1'] : '' }}</sup></h3>
                          <p style="margin: 0;margin-bottom: unset">{{ isset($dashboard_alias['DISPLAY12_TITLE']) ? $dashboard_alias['DISPLAY12_TITLE'] : '' }} </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars iconColor"></i>
                        </div>
                        <!-- <p class="small-box-footer">
                          <i class="fas fa-clock"></i> Last Data At: {{ isset($result->dtm) ?  date('d/m/Y h:i:s A', strtotime($result->dtm)) : '' }}
                        </p> -->
                      </div>
                    </div>

                    <div class="col-lg-4 col-12">
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 2.8rem">{{ isset($result->D2) ? $result->D2 : '' }}<sup style="font-size: 20px">{{ isset($unit_alias['D2']) ? $unit_alias['D2'] : '' }}</sup></h3>
                          <p style="margin: 0;margin-bottom: unset">{{ isset($dashboard_alias['DISPLAY13_TITLE']) ? $dashboard_alias['DISPLAY13_TITLE'] : '' }} </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars iconColor"></i>
                        </div>
                        <!-- <p class="small-box-footer">
                          <i class="fas fa-clock"></i> Last Data At: {{ isset($result->dtm) ?  date('d/m/Y h:i:s A', strtotime($result->dtm)) : '' }}
                        </p> -->
                      </div>
                    </div>
                    <div class="col-lg-4 col-12">
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 2.8rem">{{ isset($result->D3) ? $result->D3 : '' }}<sup style="font-size: 20px">{{ isset($unit_alias['D3']) ? $unit_alias['D3'] : '' }}</sup></h3>
                          <p style="margin: 0;margin-bottom: unset">{{ isset($dashboard_alias['DISPLAY14_TITLE']) ? $dashboard_alias['DISPLAY14_TITLE'] : '' }} </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars iconColor"></i>
                        </div>
                        <!-- <p class="small-box-footer">
                          <i class="fas fa-clock"></i> Last Data At: {{ isset($result->dtm) ?  date('d/m/Y h:i:s A', strtotime($result->dtm)) : '' }}
                        </p> -->
                      </div>
                    </div>
                    <div class="col-lg-4 col-12">
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 2.8rem">{{ isset($result->D4) ? $result->D4 : '' }}<sup style="font-size: 20px">{{ isset($unit_alias['D4']) ? $unit_alias['D4'] : '' }}</sup></h3>
                          <p style="margin: 0;margin-bottom: unset">{{ isset($dashboard_alias['DISPLAY15_TITLE']) ? $dashboard_alias['DISPLAY15_TITLE'] : '' }} </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars iconColor"></i>
                        </div>
                        <!-- <p class="small-box-footer">
                          <i class="fas fa-clock"></i> Last Data At: {{ isset($result->dtm) ?  date('d/m/Y h:i:s A', strtotime($result->dtm)) : '' }}
                        </p> -->
                      </div>
                    </div>

                  </div>
                </div>
                <div class="tab-pane fade show" id="custom-tabs-five-overlay-dark" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-dark-tab">
                  <div class="row">
                    <div id="chartdiv2" style="height: 300px; width: 100%;"></div>
                  </div>
                </div>
                <div class="tab-pane fade show" id="custom-tabs-flow-meter-dark" role="tabpanel" aria-labelledby="custom-tabs-flow-meter-dark-tab">
                  <div class="row">
                    <div id="chartdiv3" style="height: 300px; width: 100%;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Flow Chart</h3>
            </div>

            <div class="mailbox-controls with-border text-center">
              <form class="" method="POST" action="{{ url('/admin/meter-dashboard-export/') }}">
                <div class="row">
                  <div class=" col-sm-12 col-md-1 mt-2">
                    Filter
                  </div>
                  <div class="col-sm-12 col-md-3">
                    <select class="form-control select2 customSelect" id="customSelect">
                      <option value="12Hours" selected="selected">Last 12Hours</option>
                      <option value="Today">Today</option>
                      <option value="Yesterday">Yesterday</option>
                      <option value="Last 7 Days">Last 7 Days</option>
                      <option value="Last 30 Days">Last 30 Days</option>
                      <option value="This Month">This Month</option>
                      <option value="Last Month">Last Month</option>
                      <option value="Custom">Custom Range</option>
                    </select>


                    <input class="form-control endDate" id="endDate" name="end" type="hidden" placeholder="End date" aria-label="Search">
                  </div>
                  <div class=" col-sm-12 col-md-2 ">
                    {{ Form::select('flm_no', array(''=>"Select flm No") + $flmNo ,  null  , array('class' => 'form-control flm_no', 'id' => 'flm_no')) }}
                  </div>
                  <div class=" col-sm-12 col-md-5 dateDiv hidden" style="display: none;">
                    <input type="text" name="dateRange" class="form-control float-right" id="dateRange">
                    <input type="hidden" id="modem_id" name="modem_id" class="modem_id" value="{{ isset($result->modem_id) ? $result->modem_id : '' }}">
                    <input class="form-control startDate" id="startDate" name="start" type="hidden" placeholder="Start Date" aria-label="Search">
                  </div>

                  <div class="col-sm-12 col-md-3">
                    <button type="button" class="btn btn-default btn-sm search" title="Filter">
                      <i class="fas fa-check"></i>
                    </button> &nbsp;
                    <button type="button" class="btn btn-default btn-sm reset" title="Reset">
                      <i class="fas fa-sync-alt"></i>
                    </button>&nbsp;
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- <button type="submit" class="btn btn-default btn-sm" title="Download">
                        <i class="fas fa-download"> Export </i>
                      </button> -->

                  </div>
                </div>
              </form>
            </div>
            <div class="card-body--">
              <div id="chartdiv" style="height: 300px; width: 100%;"></div>
            </div>

          </div>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-md-6">

      </div>
      <div class="col-md-6">

      </div>
    </div>
  </div>
  </div>
</section>
@endsection
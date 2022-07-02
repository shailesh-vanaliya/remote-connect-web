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
    border: 3px solid #01A89D;
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
              <img class="profile-user-img img-fluid img-circle" src="{{ asset('public/ICON/Devices.svg') }}" alt="Device picture">
            </div>

            <h3 class="profile-username text-center">{{ (isset($device->modem_id) && !empty($device->modem_id) ? $device->modem_id : 'N/A') }}</h3>

            <p class="text-muted text-center">{{ (isset($device->project_name) && !empty($device->project_name) ? $device->project_name : 'N/A') }}</p>
            <p class="text-muted text-center">Status:
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
            <p class="text-muted text-center">Added On: <small>{{ (isset($device->created_at) && !empty($device->created_at) ?  date('d/m/Y h:i:s A', strtotime($device->created_at)) : 'N/A') }}</small></p>

            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVqNumGk1DCDuthLx-X7YqutsMm6DReNA&region=india&libraries=places"></script>
            <div id="map" class="col-md-12" style=" height: 220px;"></div>
            <input type="hidden" name="latitude" class="latitude" value="{{ isset($device->latitude) ? $device->latitude : 'N/A' }}">
            <input type="hidden" name="longitude" class="longitude" value="{{ isset($device->longitude) ? $device->longitude : 'N/A' }}">
            <input type="hidden" name="location" class="location" value="{{ isset($device->location) ? $device->location : '' }}">
            <input type="hidden" name="deviceId" class="deviceId" value="{{ isset($device->id) ? $device->id : '' }}">
            <input type="hidden" name="Status" class="Status" value="{{ isset($device->Status) ? $device->Status : '' }}">
            <span class="text-center">{{ (isset($device->location) && !empty($device->location) ? $device->location : 'N/A') }}</span>
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
                <!-- <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-five-overlay-dark-tab" data-toggle="pill" href="#custom-tabs-five-overlay-dark" role="tab" aria-controls="custom-tabs-five-overlay-dark" aria-selected="false">Control</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-flow-meter-dark-tab" data-toggle="pill" href="#custom-tabs-flow-meter-dark" role="tab" aria-controls="custom-tabs-flow-meter-dark" aria-selected="false">Flow Meter</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-setting-tab" data-toggle="pill" href="#custom-tabs-setting-dark" role="tab" aria-controls="custom-tabs-setting-dark" aria-selected="false">Setting</a>
                </li> -->
              </ul>
            </div>

            <div class="card-body">
              <div class="tab-content" id="custom-tabs-five-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
                  <div class="row">

                    <div class="col-lg-3 col-6">
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 3.2rem">{{ (isset($result->D0) ? $result->D0 : 'N/A' )}}<sup style="font-size: 20px">{{ isset($unit_alias['Temperature']) ? $unit_alias['Temperature'] : '' }}</sup></h3>
                          <p style="margin: 0;margin-bottom: unset">{{ isset($dashboard_alias['DISPLAY11_TITLE']) ? $dashboard_alias['DISPLAY11_TITLE'] : 'Temperature' }} </p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-thermometer-half iconColor"></i>
                        </div>
                        <p class="small-box-footer">
                          <i class="fas fa-arrow-circle-right"></i> Last Data At: {{ isset($result->dtm) ?  date('d/m/Y h:i:s A', strtotime($result->dtm)) : '' }}
                        </p>
                      </div>
                    </div>
                    <div class="col-lg-3 col-6">
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 3.2rem">{{ isset($result->D1) ? $result->D1 : '' }}<sup style="font-size: 20px">{{ isset($unit_alias['Humidity']) ? $unit_alias['Humidity'] : '' }}</sup></h3>
                          <p style="margin: 0;margin-bottom: unset">{{ isset($dashboard_alias['DISPLAY12_TITLE']) ? $dashboard_alias['DISPLAY12_TITLE'] : 'Pressure' }} </p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-thermometer-half iconColor"></i>
                        </div>
                        <p class="small-box-footer">
                          <i class="fas fa-arrow-circle-right"></i> Last Data At: {{ isset($result->dtm) ?  date('d/m/Y h:i:s A', strtotime($result->dtm)) : '' }}
                        </p>
                      </div>
                    </div>

                    <div class="col-lg-3 col-6">
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 3.2rem">{{ isset($result->D2) ? $result->D2 : '' }}<sup style="font-size: 20px">{{ isset($unit_alias['CO2']) ? $unit_alias['CO2'] : '' }}</sup></h3>
                          <p style="margin: 0;margin-bottom: unset">{{ isset($dashboard_alias['DISPLAY13_TITLE']) ? $dashboard_alias['DISPLAY13_TITLE'] : 'Water Valve1' }} </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars iconColor"></i>
                        </div>
                        <p class="small-box-footer">
                          <i class="fas fa-arrow-circle-right"></i> Last Data At: {{ isset($result->dtm) ?  date('d/m/Y h:i:s A', strtotime($result->dtm)) : '' }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12-">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Line Chart</h3>
              </div>

              <div class="mailbox-controls with-border text-center">
                <form class="" method="POST" action="{{ url('/admin/meter-dashboard-export/') }}">
                  <div class="row">
                    <div class=" col-sm-12 col-md-1 mt-2">
                      Filter
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <select class="form-control select2 customSelect" id="customSelect">
                        <option value="Today" selected="selected">Today</option>
                        <option value="Yesterday">Yesterday</option>
                        <option value="Last 7 Days">Last 7 Days</option>
                        <option value="Last 30 Days">Last 30 Days</option>
                        <option value="This Month">This Month</option>
                        <option value="Last Month">Last Month</option>
                        <option value="Custom">Custom Range</option>
                      </select>
                      <input class="form-control endDate" id="endDate" name="end" type="hidden" placeholder="End date" aria-label="Search">
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

                      <!-- <button type="submit" class="btn btn-default btn-sm" title="Download">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
    </div>
  </div>
</section>
@endsection
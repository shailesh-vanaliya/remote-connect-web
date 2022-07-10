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

  /*
  #startDate:before {
    content: 'Start Date';
    color: #000;
    text-align: center;
    width: 100%;
  }

  #startDate:active:before,
  #startDate:hover:before,
  #startDate:visited:before,
  #startDate:focus:before {
    content: '';
    width: 100%;
  }
  #endDate:before {
    content: 'End Date';
    color: #000;
    text-align: center;
    width: 100%;
  }

  #endDate:active:before,
  #endDate:hover:before,
  #endDate:visited:before,
  #endDate:focus:before {
    content: '';
    width: 100%;
  } */
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
if($device->Status == 1){
$sss = "";
}else{
$sss = "opacity: 0.5;cursor: not-allowed !important;";
}

?>
<script src="{{ asset($dynamicUrl.'js/amcharts/index.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/amcharts/xy.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/amcharts/Animated.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/amcharts/Responsive.js') }}"></script>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
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
          <!-- /.card-body -->
        </div>
        <!-- /.card -->


      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="col-md-12">
          <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-five-overlay-tab" data-toggle="pill" href="#custom-tabs-five-overlay" role="tab" aria-controls="custom-tabs-five-overlay" aria-selected="true">Display</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-five-overlay-dark-tab" data-toggle="pill" href="#custom-tabs-five-overlay-dark" role="tab" aria-controls="custom-tabs-five-overlay-dark" aria-selected="false">Control</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-flow-meter-dark-tab" data-toggle="pill" href="#custom-tabs-flow-meter-dark" role="tab" aria-controls="custom-tabs-flow-meter-dark" aria-selected="false">Flow Meter</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-setting-tab" data-toggle="pill" href="#custom-tabs-setting-dark" role="tab" aria-controls="custom-tabs-setting-dark" aria-selected="false">Setting</a>
                </li>

              </ul>
            </div>

            <div class="card-body">
              <div class="tab-content" id="custom-tabs-five-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
                  <div class="row">

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 3.2rem">{{ (isset($result->Temperature_PV) ? $result->Temperature_PV : 'N/A' )}}<sup style="font-size: 20px">°C</sup></h3>
                          <!-- <p style="margin: 0;margin-bottom: unset">Phase 1 to</p> -->
                          <p style="margin: 0;margin-bottom: unset">{{ isset($dashboard_alias['DISPLAY11_TITLE']) ? $dashboard_alias['DISPLAY11_TITLE'] : 'Temperature' }} </p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-thermometer-empty iconColor"></i>
                        </div>
                        <p class="small-box-footer">
                          <i class="fas fa-arrow-circle-right"></i> Last Data At: {{ isset($result->dtm) ?  date('d/m/Y h:i:s A', strtotime($result->dtm)) : '' }}
                        </p>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 3.2rem">{{ isset($result->Pressure_PV) ? $result->Pressure_PV : '' }}<sup style="font-size: 20px">Bar</sup></h3>
                          <!-- <p style="margin: 0;margin-bottom: unset">Phase 1 to</p> -->
                          <p style="margin: 0;margin-bottom: unset">{{ isset($dashboard_alias['DISPLAY12_TITLE']) ? $dashboard_alias['DISPLAY12_TITLE'] : 'Pressure' }} </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars iconColor"></i>
                        </div>
                        <p class="small-box-footer">
                          <i class="fas fa-arrow-circle-right"></i> Last Data At: {{ isset($result->dtm) ?  date('d/m/Y h:i:s A', strtotime($result->dtm)) : '' }}
                        </p>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 3.2rem">{{ isset($result->WATER_VALVE1) ? $result->WATER_VALVE1 : '' }}<sup style="font-size: 20px">%</sup></h3>
                          <!-- <p style="margin: 0;margin-bottom: unset">Phase 1 to</p> -->
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
                    <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 3.2rem">{{ isset($result->WATER_VALVE2) ? $result->WATER_VALVE2 : '' }}<sup style="font-size: 20px">%</sup></h3>
                          <p style="margin: 0;margin-bottom: unset">{{ isset($dashboard_alias['DISPLAY14_TITLE']) ? $dashboard_alias['DISPLAY14_TITLE'] : 'Water Valve2' }} </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars iconColor"></i>
                        </div>
                        <p class="small-box-footer">
                          <i class="fas fa-arrow-circle-right"></i> Last Data At: {{ isset($result->dtm) ?  date('d/m/Y h:i:s A', strtotime($result->dtm)) : '' }}
                        </p>
                      </div>
                    </div>

                    <!-- ./col -->
                  </div>
                </div>
                
                <div class="tab-pane fade show" id="custom-tabs-five-overlay-dark" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-dark-tab">
                  <div class="row">
                    <!-- ./col -->
                    <!-- <div class="col-lg-3 col-6">
                      <div class="small-box bg-success">
                        <div class="inner">
                          <div class="card-body">
                            <div class="row">
                              Machine : <input type="checkbox" name="machine" class="machine" id="machine" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </div>
                            <div class="row">
                              Moisture : <input type="checkbox" class="moisture" id="moisture" name="moisture" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-4 col-sm-6 col-12">
                      <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-info mr-3"><i class="fa fa-thermometer-empty"></i></span>

                        <div class="info-box-content ">
                          <span class="info-box-text ">{{ isset($dashboard_alias['SWITCH1_TITLE']) ? $dashboard_alias['SWITCH1_TITLE'] : 'Machine' }}</span>
                          <span class="info-box-number "style="{{ $sss }}" >
                            <input type="checkbox" style="{{ $sss }}"  name="machine" class="machine form-control" value="{{ isset($result->MACHINE_STATUS) && $result->MACHINE_STATUS == 1 ? 1 : 0 }}" id="machine" data-bootstrap-switch data-off-color="danger" checked data-on-color="success">
                          </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                      <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-info mr-3"><i class="fa fa-thermometer-empty"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">{{ isset($dashboard_alias['SWITCH2_TITLE']) ? $dashboard_alias['SWITCH2_TITLE'] : 'Moisture' }}</span>
                          <span class="info-box-number" style="{{ $sss }}">
                            <input type="checkbox" style="{{ $sss }}" class="moisture form-control" id="moisture" name="moisture" value="{{ isset($result->MOISTURE_STATUS) && $result->MOISTURE_STATUS == 1 ? 1 : 0 }}" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                          </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade show" id="custom-tabs-flow-meter-dark" role="tabpanel" aria-labelledby="custom-tabs-flow-meter-dark-tab">
                  <div class="row">
                    <table id="" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Water Flow</th>
                          <th>Reset</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Daily</td>
                          <td>{{ isset($result->DAILY_FLOW) ? $result->DAILY_FLOW : 'N/A' }}</td>
                          <td><i data-name="DAILY_FLOW" data-modem_id="{{ isset($result->modem_id) ? $result->modem_id : '' }}" class="fas fa-undo resetBtn"></i></td>
                        </tr>
                        <tr>
                          <td>Weekly</td>
                          <td>{{ isset($result->WEEKLY_FLOW) ? $result->WEEKLY_FLOW : 'N/A' }}</td>
                          <td><i data-name="WEEKLY_FLOW" data-modem_id="{{ isset($result->modem_id) ? $result->modem_id : '' }}" class="fas fa-undo resetBtn"></i></td>
                        </tr>
                        <tr>
                          <td>Monthly</td>
                          <td>{{ isset($result->MONTHLY_FLOW) ? $result->MONTHLY_FLOW : 'N/A' }}</td>
                          <td><i data-name="MONTHLY_FLOW" data-modem_id="{{ isset($result->modem_id) ? $result->modem_id : '' }}" class="fas fa-undo resetBtn"></i></td>
                        </tr>
                        <tr>
                          <td>6 Months</td>
                          <td>{{ isset($result->MONTH6_FLOW) ? $result->MONTH6_FLOW : 'N/A' }}</td>
                          <td><i data-name="MONTH6_FLOW" data-modem_id="{{ isset($result->modem_id) ? $result->modem_id : '' }}" class="fas fa-undo resetBtn"></i></td>
                        </tr>
                        <tr>
                          <td>Total</td>
                          <td>{{ isset($result->TOTAL_FLOW) ? $result->TOTAL_FLOW : 'N/A' }}</td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="tab-pane fade show" id="custom-tabs-setting-dark" role="tabpanel" aria-labelledby="custom-tabs-setting-tab">
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="card card-primary card-outline direct-chat direct-chat-primary">
                        <div class="card-header">
                          <h3 class="card-title">WATER VALVE1 %</h3>
                        </div>
                        <div class="card-footer">
                          <div class="input-group">
                            <input type="number" value="{{ isset($result->WATER_VALVE1) ? $result->WATER_VALVE1 : '' }}" min="0" max="100" name="WATEROUT_1" placeholder="WATER VALVE1 ..." class="form-control numberValid">
                            <span class="input-group-append" >
                              <button data-valve="WATEROUT_1" style="{{ $sss }}" type="button" class="btn btn-success setVALVE">set</button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="card card-primary card-outline direct-chat direct-chat-primary">
                        <div class="card-header">
                          <h3 class="card-title">WATER VALVE2 %</h3>
                        </div>
                        <div class="card-footer">
                          <div class="input-group">
                            <input type="number" value="{{ isset($result->WATER_VALVE2) ? $result->WATER_VALVE2 : '' }}" min="0" max="100" name="WATEROUT_2" placeholder="WATER VALVE1 ..." class="form-control numberValid">
                            <span class="input-group-append" >
                              <button data-valve="WATEROUT_2" style="{{ $sss }}" type="button" class="btn btn-success setVALVE">Set</button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    @if(Auth::guard('admin')->user()->role != 'USER')
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="card card-primary card-outline direct-chat direct-chat-primary">
                        <div class="card-header">
                          <h3 class="card-title">Pressure Set Point</h3>
                        </div>
                        <div class="card-footer">
                          <div class="input-group">
                            <input type="number" value="{{ isset($result->Pressure_SP) ? $result->Pressure_SP : '' }}" min="0" max="100" name="H_PRS_SP" placeholder="Pressure Set Point" class="form-control numberValid">
                            <span class="input-group-append">
                              <button data-valve="H_PRS_SP"style="{{ $sss }}"  type="button" class="btn btn-success setVALVE">Set</button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="card card-primary card-outline direct-chat direct-chat-primary">
                        <div class="card-header">
                          <h3 class="card-title">High Temp. set Point</h3>
                        </div>
                        <div class="card-footer">
                          <div class="input-group">
                            <input type="number" value="" min="0" max="100" name="H_TEMP_ALT_SP" placeholder="High Temp. set Point" class="form-control numberValid">
                            <span class="input-group-append" >
                              <button data-valve="H_TEMP_ALT_SP" style="{{ $sss }}"  type="button" class="btn btn-success setVALVE">Set</button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                  </div>
                </div>

              </div>

            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-12-">
            <!-- STACKED BAR CHART -->
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
                      <option value="12Hours" selected="selected">Today 12Hours</option>
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

                      <button type="submit" class="btn btn-default btn-sm" title="Download">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <i class="fas fa-download"> Export </i>
                        <!-- <i class="fas fa-download"><a class="" style="margin-right: 5px;"  href="{{ route('meter-dashboard-export') }}"> Export </a>  </i> -->
                      </button>

                    </div>
                  </div>
                </form>
              </div>
              <div class="card-body--">
                <!-- <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div> -->
                <div id="chartdiv" style="height: 300px; width: 100%;"></div>
              </div>
              <!-- <div id="chartdiv" style="height: 400px; width: 100%;"></div> -->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
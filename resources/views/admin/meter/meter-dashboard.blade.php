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
</style>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="https://cloud.iiotconnect.in/assets/img/device_types/energymeter.svg" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ (isset($device->modem_id) && !empty($device->modem_id) ? $device->modem_id : 'N/A') }}</h3>
            
            <p class="text-muted text-center">{{ (isset($device->project_name) && !empty($device->project_name) ? $device->project_name : 'N/A') }}</p>
            <p class="text-muted text-center">Device Type: <small>Energymeter</small></p>
            <p class="text-muted text-center">Added On: <small>{{ (isset($device->created_by) && !empty($device->created_by) ?  date('d/m/Y h:i:s A', strtotime($device->created_by)) : 'N/A') }}</small></p>

            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVqNumGk1DCDuthLx-X7YqutsMm6DReNA&region=india&libraries=places"></script>
            <div id="map" class="col-md-12" style=" height: 220px;"></div>
  <input type="hidden" name="latitude" class="latitude" value="{{ $device->latitude }}">
  <input type="hidden" name="longitude" class="longitude" value="{{ $device->longitude }}">
  <input type="hidden" name="location" class="location" value="{{ $device->location }}">
            <span class="text-center">{{ (isset($device->location) && !empty($device->location) ? $device->location : 'N/A') }}</span>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <!-- <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>
                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>
                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                <p class="text-muted">Malibu, California</p>
                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>
                <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
            </div> -->
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="col-md-12">
          <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                <!-- <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-five-overlay-tab" data-toggle="pill" href="#custom-tabs-five-overlay" role="tab" aria-controls="custom-tabs-five-overlay" aria-selected="true">Temperature</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-five-overlay-dark-tab" data-toggle="pill" href="#custom-tabs-five-overlay-dark" role="tab" aria-controls="custom-tabs-five-overlay-dark" aria-selected="false">Pressure</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-five-normal-tab" data-toggle="pill" href="#custom-tabs-five-normal" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false">Water valve1</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-five-normal-tab" data-toggle="pill" href="#power-factor" role="tab" aria-controls="power-factor" aria-selected="false">Water valve1</a>
                </li> -->
                <!-- <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-five-normal-tab" data-toggle="pill" href="#active-factor" role="tab" aria-controls="active-factor" aria-selected="false">Active Factor</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-five-normal-tab" data-toggle="pill" href="#reactive-factor" role="tab" aria-controls="reactive-factor" aria-selected="false">Reactive Power</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-five-normal-tab" data-toggle="pill" href="#apparent-power" role="tab" aria-controls="apparent-power" aria-selected="false">Apparent Power</a>
                </li> -->
              </ul>
            </div>

            <div class="card-body">
              <div class="tab-content" id="custom-tabs-five-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
                  <!-- Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. -->
                  <div class="row">

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 3.2rem">{{ $result->Temperature_PV}}<sup style="font-size: 20px">°C</sup></h3>
                          <!-- <p style="margin: 0;margin-bottom: unset">Phase 1 to</p> -->
                          <p style="margin: 0;margin-bottom: unset">Temperature </p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-thermometer-empty iconColor"></i>
                        </div>
                        <p class="small-box-footer">
                          <i class="fas fa-arrow-circle-right"></i> Last Data At: {{ date('d/m/Y h:i:s A', strtotime($result->dtm)) }}
                        </p>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 3.2rem">{{ $result->Pressure_PV}}<sup style="font-size: 20px">Bar</sup></h3>
                          <!-- <p style="margin: 0;margin-bottom: unset">Phase 1 to</p> -->
                          <p style="margin: 0;margin-bottom: unset">Pressure </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars iconColor"></i>
                        </div>
                        <p class="small-box-footer">
                          <i class="fas fa-arrow-circle-right"></i> Last Data At: {{ date('d/m/Y h:i:s A', strtotime($result->dtm)) }}
                        </p>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 3.2rem">{{ $result->WATER_VALVE1}}<sup style="font-size: 20px">%</sup></h3>
                          <!-- <p style="margin: 0;margin-bottom: unset">Phase 1 to</p> -->
                          <p style="margin: 0;margin-bottom: unset">Water Valve1 </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars iconColor"></i>
                        </div>
                        <p class="small-box-footer">
                          <i class="fas fa-arrow-circle-right"></i> Last Data At: {{ date('d/m/Y h:i:s A', strtotime($result->dtm)) }}
                        </p>
                      </div>
                    </div>
                    <div class="col-lg-3 col-6">
                      <!-- small card -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 style="font-size: 3.2rem">{{ $result->WATER_VALVE2 }}<sup style="font-size: 20px">%</sup></h3>
                          <!-- <p style="margin: 0;margin-bottom: unset">Phase 1 to</p> -->
                          <p style="margin: 0;margin-bottom: unset">Water Valve2 </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars iconColor"></i>
                        </div>
                        <p class="small-box-footer">
                          <i class="fas fa-arrow-circle-right"></i> Last Data At: {{ date('d/m/Y h:i:s A', strtotime($result->dtm)) }}
                        </p>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-12">
            <!-- STACKED BAR CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Line Chart</h3>

                <!-- <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div> -->
              </div>
              <div class="mailbox-controls with-border text-center">
              <form class="" method="POST" action="{{ url('/admin/meter-dashboard-export/') }}">
                <div class="row">
                  <div class=" col-sm-12 col-md-1 mt-2">
                    Filter
                  </div>
                  <div class=" col-sm-12 col-md-3">
                  <!-- <input type="text" class="form-control float-right" id="dateRange"> -->
                    <input class="form-control startDate" id="startDate" name="start" type="date" placeholder="Start Date" aria-label="Search">
                  </div>
                  <div class="col-sm-12 col-md-3">
                    <input class="form-control endDate" id="endDate" name="end" type="date" placeholder="End date" aria-label="Search">
                    <!-- <input class="form-control endDate" id="endDate" type="datetime-local" placeholder="Search" aria-label="Search"> -->
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
              <div class="card-body">
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
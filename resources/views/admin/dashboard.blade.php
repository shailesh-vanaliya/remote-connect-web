@extends('admin.layouts.admin')
@section('title', $pagetitle )
@section('content')

<section class="content">
  <!-- <h2>COMMING SOON</h2> -->
  <!-- <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Customer</span>
                    <span class="info-box-number">3</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-drivers-license"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Driver</span>
                    <span class="info-box-number">3</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-industry"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Seller</span>
                    <span class="info-box-number">3</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-first-order"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pending Order</span>
                    <span class="info-box-number">3</span>
                </div>
            </div>
        </div>
    </div> -->
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVqNumGk1DCDuthLx-X7YqutsMm6DReNA&region=india&libraries=places"></script>
  <!-- <div id="mapa" class="col-md-12" style="width: 1000px; height: 600px;"></div> -->
  <div class="row">
    <!-- Left col -->
    <div class="col-md-8">
      <!-- MAP & BOX PANE -->
      <div class="card">
        <!-- <div class="card-header">
                <h3 class="card-title">US-Visitors Report</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div> -->
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="d-md-flex">
            <div class="p-1 flex-fill" style="overflow: hidden">
              <!-- Map will be created here -->
              <div id="map" style="height: 525px; overflow: hidden">
                <div class="map"></div>
              </div>
            </div>
            <!-- <div class="card-pane-right bg-success pt-2 pb-2 pl-4 pr-4">
                    <div class="description-block mb-4">
                      <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                      <h5 class="description-header">8390</h5>
                      <span class="description-text">Visits</span>
                    </div>
                    <div class="description-block mb-4">
                      <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                      <h5 class="description-header">30%</h5>
                      <span class="description-text">Referrals</span>
                    </div>
                    <div class="description-block">
                      <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                      <h5 class="description-header">70%</h5>
                      <span class="description-text">Organic</span>
                    </div>
                  </div>  -->
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->

    <div class="col-md-4">
      <div class="info-box mb-3 bg-warning">
        <span class="info-box-icon"><i class="fas fa-tag"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Device</span>
          <span class="info-box-number">{{ $device }}</span>
        </div>
      </div>
      <div class="info-box mb-3 bg-success">
        <span class="info-box-icon"><i class="fas fa-wifi"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Online Device</span>
          <span class="info-box-number">{{ $onlineDevice }}</span>
        </div>
      </div>

      <div class="info-box mb-3 bg-red">
        <span class="info-box-icon"><i class="fas fa-unlink"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Offline Device</span>
          <span class="info-box-number">{{ $device - $onlineDevice }}</span>
        </div>
      </div>

      <div class="info-box mb-3 bg-secondary">
        <span class="info-box-icon"><i class="far fa-file-alt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Reports Config</span>
          <span class="info-box-number">{{ $reportCount }}</span>
        </div>
      </div>

      <div class="info-box mb-3 bg-info">
        <span class="info-box-icon"><i class="far fa-bell"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Alert Config</span>
          <span class="info-box-number">{{ $alertCount }}</span>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
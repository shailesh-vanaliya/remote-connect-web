@extends('admin.layouts.admin')
@section('title', $pagetitle )
@section('content')
<style>
  #chartdiv {
    width: 100%;
    height: 500px;
    max-width: 100%;
  }

  .bg-success {
    background-color: #343a40 !important;
  }

  .card-primary:not(.card-outline)>.card-header {
    background-color: #343a40;
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

  i.fa.fa-exclamation-triangle {
    font-size: 10px;
  }

  .card-footer {
    padding: 0rem 1.25rem !important;
  }
</style>
<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
  $dynamicUrl =  asset('') . 'public/';
} else {
  $dynamicUrl = asset('') . 'public/';
}
?>
<!-- Resources -->
<!-- <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/plugins/exporting.js"></script> -->

<script src="{{ asset($dynamicUrl.'js/amcharts/index1.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/amcharts/xy1.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/amcharts/Animated1.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/amcharts/Responsive.js') }}"></script>
<script src="{{ asset($dynamicUrl.'js/amcharts/exporting.js') }}"></script>

</head>


<section class="content">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="container-fluid">

    <div class="card-body- mt-3">
      <div class="tab-content" id="custom-tabs-five-tabContent">
        <div class="tab-pane fade show active" id="custom-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
          <div class="row">

            <div class="col-lg-3 col-md-12 col-sm-12">
              <div class="small-box bg-success">
                <div class="inner" align="center" padding="0">
                  <h2 style="font-size: 1.5rem">{{ isset($dashboard_alias) ? $dashboard_alias['CONTROLLER1_TITLE'] : 'ZONE1' }}</h2>
                </div>
                <div class="inner">
                  <h3 style="font-size: 3.0rem"><sup style="font-size: 22px">PV</sup> {{ (empty($result)) ? "" : $result->pv1 }} </h3>
                  <h4 style="font-size: 2.8rem"><sup style="font-size: 22px">SP</sup> {{ (empty($result)) ? "" :$result->sp1 }} </h4>
                </div>
                <div class="icon">
                  <i class="fa fa-thermometer-three-quarters iconColor"></i>
                </div>

                <div class="progress-group" style=text-align:left>
                  <span class="progress-text ml-1">Output %</span>
                  <span class="float-right mr-1"><b> {{ (empty($result)) ? "0" : $result->out1 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-gradient-success" style="width: {{ (empty($result)) ? "0" : $result->out1 }}%"></div>
                  </div>
                </div>
                @php
                $out1 = (empty($result)) ? "" : (boolean)($result->obit1&1);
                $out2 = (empty($result)) ? "" : (boolean)($result->obit1&2);
                $at = (empty($result)) ? "" :(boolean)($result->obit1&4);
                $alt1 = (empty($result)) ? "" :(boolean)($result->obit1&8);
                $alt2 = (empty($result)) ? "" :(boolean)($result->obit1&16);
                $alt3 = (empty($result)) ? "" :(boolean)($result->obit1&32);
                $pro = (empty($result)) ? "" :(boolean)($result->obit1&64);
                $man = (empty($result)) ? "" :(boolean)($result->obit1&128);
                @endphp

                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-3 col-6 ">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">Out1</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6 ">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6 ">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($at == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">AT</h5>
                        <!-- <h5 class="description-header {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</h5> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6 ">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt1 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL1</h5>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt2 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt3 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</h5>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($man == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">MAN</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($pro == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">PRO</h5>
                      </div>
                    </div>
                  </div>
                  <!-- /.row -->
                </div>

              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
              <div class="small-box bg-success">
                <div class="inner" align="center" padding="0">
                  <h2 style="font-size: 1.5rem">{{ isset($dashboard_alias) ? $dashboard_alias['CONTROLLER2_TITLE'] : 'ZONE3' }}</h2>
                </div>
                <div class="inner">
                  <h3 style="font-size: 3.0rem"><sup style="font-size: 22px">PV</sup> {{ (empty($result)) ? "" : $result->pv2 }} </h3>
                  <h4 style="font-size: 2.8rem"><sup style="font-size: 22px">SP</sup> {{ (empty($result)) ? "" : $result->sp2 }} </h4>
                </div>
                <div class="icon">
                  <i class="fa fa-thermometer-three-quarters iconColor"></i>
                </div>
                <!-- <p class="small-box-footer"> -->
                <div class="progress-group" style=text-align:left>
                  <span class="progress-text ml-1">Output %</span>
                  <span class="float-right mr-1"><b> {{ (empty($result)) ? "" : $result->out2 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-gradient-success" style="width: {{ (empty($result)) ? "" : $result->out2 }}%"></div>
                  </div>
                  <!-- <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div> -->
                </div>
                <!-- <div class="btn-group mb-2 ml-3"> -->
                @php
                $out1 = (empty($result)) ? "" : (boolean)($result->obit2&1);
                $out2 = (empty($result)) ? "" : (boolean)($result->obit2&2);
                $at = (empty($result)) ? "" : (boolean)($result->obit2&4);
                $alt1 = (empty($result)) ? "" : (boolean)($result->obit2&8);
                $alt2 = (empty($result)) ? "" : (boolean)($result->obit2&16);
                $alt3 = (empty($result)) ? "" : (boolean)($result->obit2&32);
                $pro = (empty($result)) ? "" : (boolean)($result->obit2&64);
                $man = (empty($result)) ? "" : (boolean)($result->obit2&128);
                @endphp
                <div class="card-footer" style="">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}"> Out1</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($at == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">AT</h5>
                        <!-- <small class="description-header {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</small> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt1 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL1</h5>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt2 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt3 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</h5>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($man == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">MAN</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($pro == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">PRO</h5>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <button type="button" class="btn btn-default btn-xs {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($at == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">AT</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt3 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT3</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($man == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">MAN</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($pro == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">PRO</button> -->
                <!-- </div> -->
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
              <div class="small-box bg-success">
                <div class="inner" align="center" padding="0">
                  <h2 style="font-size: 1.5rem">{{ isset($dashboard_alias) ? $dashboard_alias['CONTROLLER3_TITLE'] : 'ZONE4' }}</h2>
                </div>
                <div class="inner">
                  <h3 style="font-size: 3.0rem"><sup style="font-size: 22px">PV</sup> {{ (empty($result)) ? "" : $result->pv3 }} </h3>
                  <h4 style="font-size: 2.8rem"><sup style="font-size: 22px">SP</sup> {{ (empty($result)) ? "" : $result->sp3 }} </h4>
                </div>

                <div class="icon">
                  <i class="fa fa-thermometer-three-quarters iconColor"></i>
                </div>
                <!-- <p class="small-box-footer"> -->
                <div class="progress-group" style=text-align:left>
                  <span class="progress-text ml-1">Output %</span>
                  <span class="float-right mr-1"><b> {{ (empty($result)) ? "0" : $result->out3 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-gradient-success" style="width: {{ (empty($result)) ? '0' :$result->out3 }}%"></div>
                  </div>
                </div>
                <!-- <div class="btn-group mb-2 ml-3"> -->
                @php
                $out1 = (empty($result)) ? "" : (boolean)($result->obit3&1);
                $out2 = (empty($result)) ? "" : (boolean)($result->obit3&2);
                $at = (empty($result)) ? "" : (boolean)($result->obit3&4);
                $alt1 = (empty($result)) ? "" : (boolean)($result->obit3&8);
                $alt2 = (empty($result)) ? "" : (boolean)($result->obit3&16);
                $alt3 = (empty($result)) ? "" : (boolean)($result->obit3&32);
                $pro = (empty($result)) ? "" : (boolean)($result->obit3&64);
                $man = (empty($result)) ? "" : (boolean)($result->obit3&128);
                @endphp
                <div class="card-footer" style="">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">Out1</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($at == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">AT</h5>
                        <!-- <h5 class="description-header {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</small> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt1 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL1</h5>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt2 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt3 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</h5>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($man == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">MAN</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($pro == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">PRO</h5>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <button type="button" class="btn btn-default btn-xs {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($at == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">AT</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt3 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT3</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($man == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">MAN</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($pro == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">PRO</button> -->
                <!-- </div> -->
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
              <div class="small-box bg-success">
                <div class="inner" align="center" padding="0">
                  <h2 style="font-size: 1.5rem">{{ isset($dashboard_alias) ? $dashboard_alias['CONTROLLER4_TITLE'] : 'ZONE5' }}</h2>
                </div>
                <div class="inner">
                  <h3 style="font-size: 3.0rem"><sup style="font-size: 22px">PV</sup> {{ (empty($result)) ? "" : $result->pv4 }} </h3>
                  <h4 style="font-size: 2.8rem"><sup style="font-size: 22px">SP</sup> {{ (empty($result)) ? "" : $result->sp4 }} </h4>
                </div>
                <div class="icon">
                  <i class="fa fa-thermometer-three-quarters iconColor"></i>
                </div>
                <!-- <p class="small-box-footer"> -->
                <div class="progress-group" style=text-align:left>
                  <span class="progress-text ml-1">Output %</span>
                  <span class="float-right mr-1"><b> {{ (empty($result)) ? "" : $result->out4 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-gradient-success" style="width: {{ (empty($result)) ? '0' : $result->out4 }}%"></div>
                  </div>
                </div>
                <!-- <div class="btn-group mb-2 ml-3"> -->
                @php
                $out1 = (empty($result)) ? "" : (boolean)($result->obit4&1);
                $out2 = (empty($result)) ? "" : (boolean)($result->obit4&2);
                $at = (empty($result)) ? "" : (boolean)($result->obit4&4);
                $alt1 = (empty($result)) ? "" : (boolean)($result->obit4&8);
                $alt2 = (empty($result)) ? "" : (boolean)($result->obit4&16);
                $alt3 = (empty($result)) ? "" : (boolean)($result->obit4&32);
                $pro = (empty($result)) ? "" : (boolean)($result->obit4&64);
                $man = (empty($result)) ? "" : (boolean)($result->obit4&128);
                @endphp
                <div class="card-footer" style="padding: unset;">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">Out1</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($at == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">AT</h5>
                        <!-- <h5 class="description-header {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</h5> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt1 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL1</h5>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt2 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt3 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</h5>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($man == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">MAN</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($pro == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">PRO</h5>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <button type="button" class="btn btn-default btn-xs {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($at == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">AT</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt3 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT3</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($man == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">MAN</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($pro == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">PRO</button>
                </div> -->
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
              <div class="small-box bg-success">
                <div class="inner" align="center" padding="0">
                  <h2 style="font-size: 1.5rem">{{ isset($dashboard_alias) ? $dashboard_alias['CONTROLLER5_TITLE'] : 'ZONE6' }}</h2>
                </div>
                <div class="inner">
                  <h3 style="font-size: 3.0rem"><sup style="font-size: 22px">PV</sup> {{ (empty($result)) ? "" : $result->pv5 }} </h3>
                  <h4 style="font-size: 2.8rem"><sup style="font-size: 22px">SP</sup> {{ (empty($result)) ? "" : $result->sp5 }} </h4>
                </div>
                <div class="icon">
                  <i class="fa fa-thermometer-three-quarters iconColor"></i>
                </div>
                <!-- <p class="small-box-footer"> -->
                <div class="progress-group" style=text-align:left>
                  <span class="progress-text ml-1">Output %</span>
                  <span class="float-right mr-1"><b> {{ (empty($result)) ? "" : $result->out5 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-gradient-success" style="width: {{ (empty($result)) ? '0' : $result->out5 }}%"></div>
                  </div>
                </div>

                <!-- <div class="btn-group mb-2 ml-3"> -->
                @php
                $out1 = (empty($result)) ? "" : (boolean)($result->obit5&1);
                $out2 = (empty($result)) ? "" : (boolean)($result->obit5&2);
                $at = (empty($result)) ? "" : (boolean)($result->obit5&4);
                $alt1 = (empty($result)) ? "" : (boolean)($result->obit5&8);
                $alt2 = (empty($result)) ? "" : (boolean)($result->obit5&16);
                $alt3 = (empty($result)) ? "" : (boolean)($result->obit5&32);
                $pro = (empty($result)) ? "" : (boolean)($result->obit5&64);
                $man = (empty($result)) ? "" : (boolean)($result->obit5&128);
                @endphp
                <!-- bg-gradient-secondary -->
                <!-- <button type="button" class="btn btn-default btn-xs {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($at == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">AT</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt3 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT3</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($man == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">MAN</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($pro == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">PRO</button>
                </div> -->
                <div class="card-footer" style="">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">Out1</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($at == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">AT</h5>
                        <!-- <h5 class="description-header {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</h5> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt1 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL1</h5>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt2 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt3 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</h5>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($man == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">MAN</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($pro == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">PRO</h5>
                      </div>
                    </div>
                  </div>
                </div>
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
              <div class="small-box bg-success">
                <div class="inner" align="center" padding="0">
                  <h2 style="font-size: 1.5rem">{{ isset($dashboard_alias) ? $dashboard_alias['CONTROLLER6_TITLE'] : 'ZONE7' }}</h2>
                </div>
                <div class="inner">
                  <h3 style="font-size: 3.0rem"><sup style="font-size: 22px">PV</sup> {{ (empty($result)) ? "" : $result->pv6 }} </h3>
                  <h4 style="font-size: 2.8rem"><sup style="font-size: 22px">SP</sup> {{ (empty($result)) ? "" : $result->sp6 }} </h4>
                </div>
                <div class="icon">
                  <i class="fa fa-thermometer-three-quarters iconColor"></i>
                </div>
                <!-- <p class="small-box-footer"> -->
                <div class="progress-group" style=text-align:left>
                  <span class="progress-text ml-1">Output %</span>
                  <span class="float-right mr-1"><b> {{ (empty($result)) ? "" : $result->out6 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-gradient-success" style="width: {{ (empty($result)) ? '0' :$result->out6 }}%"></div>
                  </div>
                </div>

                <!-- <div class="btn-group mb-2 ml-3"> -->
                @php
                $out1 = (empty($result)) ? "" : (boolean)($result->obit6&1);
                $out2 = (empty($result)) ? "" : (boolean)($result->obit6&2);
                $at = (empty($result)) ? "" : (boolean)($result->obit6&4);
                $alt1 = (empty($result)) ? "" : (boolean)($result->obit6&8);
                $alt2 = (empty($result)) ? "" : (boolean)($result->obit6&16);
                $alt3 = (empty($result)) ? "" : (boolean)($result->obit6&32);
                $pro = (empty($result)) ? "" : (boolean)($result->obit6&64);
                $man = (empty($result)) ? "" : (boolean)($result->obit6&128);
                @endphp
                <!-- <button type="button" class="btn btn-default btn-xs {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($at == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">AT</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt3 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT3</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($man == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">MAN</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($pro == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">PRO</button>
                </div> -->
                <div class="card-footer" style="padding: unset;">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">Out1</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($at == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">AT</h5>
                        <!-- <h5 class="description-header {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</h5> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt1 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL1</h5>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt2 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL2</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($alt3 == 1) ? 'bg-gradient-danger' : 'bg-gradient-secondary'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</h5>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($man == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">MAN</h5>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header {{  ($pro == 1) ? 'bg-gradient-warning' : 'bg-gradient-secondary'; }}">PRO</h5>
                      </div>
                    </div>
                  </div>
                </div>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary ">
          <div class="card-header">
            <h3 class="card-title">Quota</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
            </div>
          </div>

          @php
          $var1 = ( $device['storage_quota'] > 0 && ($device['storage_usage'] * 100) > 0 ) ? ($device['storage_usage'] * 100) / $device['storage_quota'] : 0;
          @endphp
          <div class="progress-group pl-3 pr-3">
            Storage Usage
            <span class="float-right"><b>{{ $device['storage_usage']}}</b>/{{ $device['storage_quota'] }}mb</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-primary" style="width: {{ $var1 }}%"></div>
            </div>
          </div>
          @php
          $var1 = ( $device['report_quota'] > 0 && ($device['report_counter'] * 100) > 0 ) ? ($device['report_counter'] * 100) / $device['report_quota'] : 0;
          @endphp
          <div class="progress-group pl-3 pr-3">
            Report Counter
            <span class="float-right"><b>{{ $device['report_counter']}}</b>/{{ $device['report_quota'] }}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-danger" style="width: {{ $var1 }}%"></div>
            </div>
          </div>
          @php
          $var1 = ( $device['sms_quota'] > 0 && ($device['sms_counter'] * 100) > 0 ) ? ($device['sms_counter'] * 100) / $device['sms_quota'] : 0;
          @endphp
          <div class="progress-group pl-3 pr-3">
            <span class="progress-text">SMS Counter</span>
            <span class="float-right"><b>{{ $device['sms_counter']}}</b>/{{ $device['sms_quota'] }}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-success" style="width: {{ $var1 }}%"></div>
            </div>
          </div>

          <div class="progress-group pl-3 pr-3">
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
          <div class="progress-group pl-3 pr-3">
            Notification
            <span class="float-right"><b>{{ $device['notification_counter']}}</b>/{{ $device->notification_quota }}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-secondary" style="width: {{ $var1 }}%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- AREA CHART -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Chart</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
            </div>
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
                </div>
                <div class=" col-sm-12 col-md-5 dateDiv hidden" style="display: none;">
                  <input type="text" name="dateRange" class="form-control float-right" id="dateRange">
                  <input type="hidden" id="modem_id" name="modem_id" class="modem_id" value="{{ isset($result->modem_id) ? $result->modem_id : '' }}">
                  <input class="form-control startDate" id="startDate" name="start" type="hidden" placeholder="Start Date" aria-label="Search">
                  <input class="form-control endDate" id="endDate" name="end" type="hidden" placeholder="End date" aria-label="Search">
                </div>

                <div class="col-sm-12 col-md-3">
                  <button type="button" class="btn btn-default btn-sm search" title="Filter">
                    <i class="fas fa-check"></i>
                  </button> &nbsp;
                  <button type="button" class="btn btn-default btn-sm reset" title="Reset">
                    <i class="fas fa-sync-alt"></i>
                  </button>&nbsp;
                </div>
              </div>
            </form>
          </div>
          <div class="card-body">
            <div id="chartdiv"></div>
            <img id="myImage" />
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Recipe data</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
            </div>
          </div>

          <div class="card-body mt-1">
            <form method="POST" action="{{ url('admin/update-pid/'. $deviceName) }} " accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
              {{ csrf_field() }}
              @php
              $count = 0;
              @endphp
              @if(isset($jsonDecode) && !empty($jsonDecode))
              <div class="form-group mb-1 {{ $count % 2 == 0 ? 'row ' : ''}} ">
                @foreach($jsonDecode as $key => $val)
                <label for="modem_id" class="col-form-label mb-2 text-center col-lg-1 offset-sm-0 col-sm-12"> {{ $key }}</label>
                <div class="col-sm-1 mb-0.5">
                  <input class="form-control" name="{{ $key }}" type="text" id="modem_id" value="{{ $val }}">
                </div>
                @php
                $count ++;
                @endphp
                @endforeach
              </div>
              @if($deviceDetail['Status'] == 1)
              <div class="form-group row ml-4">
                <input class="btn btn-success mr-1" type="submit" name="button" value="Read">
                <input class="btn btn-primary" type="submit" name="button" value="Write">
              </div>
              @else
              <div class=" row">
                <code class="card-body text-center">Now Your device is offline.</code>
              </div>
              @endif
              <input type="hidden" name="modem_id" value="{{ $deviceDetail['modem_id'] }}">
              <input type="hidden" name="id" value="{{ $deviceDetail['id'] }}">
              @else
              <div class=" row">
                <code class="card-body text-center">No Recipe data found</code>
              </div>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
   

</section>

@endsection
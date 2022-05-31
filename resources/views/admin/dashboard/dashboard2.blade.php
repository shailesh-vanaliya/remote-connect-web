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
    background-color: #01a89d !important;
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
  i.fa.fa-exclamation-triangle {
    font-size: 10px;
}
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
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
                <div class="inner">
                  <h3 style="font-size: 3.2rem"><sup style="font-size: 22px">PV</sup> {{ $result->pv1 }} </h3>
                  <h4 style="margin: 0;margin-bottom: unset;"><sup style="font-size: 19px; font-weight: 900;">SP</sup>{{ $result->sp1 }} </h4>
                </div>
                <div class="icon">
                  <i class="fa fa-thermometer-empty iconColor"></i>
                </div>
                <!-- <p class="small-box-footer"> -->
                <div class="progress-group ">
                  <span class="progress-text ml-1 ml-1">Out1</span>
                  <span class="float-right mr-1"><b> {{ $result->out1 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: {{ $result->out1 }}%"></div>
                  </div>
                </div>
                @php
                  $out1 = (boolean)($result->obit1&1);
                  $out2 = (boolean)($result->obit1&2);
                  $at = (boolean)($result->obit1&4);
                  $alt1 = (boolean)($result->obit1&4);
                  $alt2 = (boolean)($result->obit1&16);
                  $alt3 = (boolean)($result->obit1&32);
                  $pro = (boolean)($result->obit1&64);
                  $man = (boolean)($result->obit1&128);
                  @endphp
                <div class="card-footer" style="padding: unset;">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}"> Out1</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}">AT</small>
                        <!-- <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</small> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block">
                        <small class="badge {{  ($alt1 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL1</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt2 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt3 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</small>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($man == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> MAN</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block ">
                        <small class="badge {{  ($pro == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> PRO</small>
                      </div>
                    </div>
                  </div>
                  <!-- /.row -->
                </div>

                <!-- <div class="btn-group mb-2 ml-3">
                  @php
                  $out1 = (boolean)($result->obit1&1);
                  $out2 = (boolean)($result->obit1&2);
                  $at = (boolean)($result->obit1&4);
                  $alt1 = (boolean)($result->obit1&4);
                  $alt2 = (boolean)($result->obit1&16);
                  $alt3 = (boolean)($result->obit1&32);
                  $pro = (boolean)($result->obit1&64);
                  $man = (boolean)($result->obit1&128);
                  @endphp
                  <button type="button" class="btn btn-default btn-xs {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">OUT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($at == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">AT</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT1</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT2</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($alt3 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">ALT3</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($man == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}">MAN</button>
                  <button type="button" class="btn btn-default btn-xs {{  ($pro == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">PRO</button>
                </div> -->

              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 style="font-size: 3.2rem"><sup style="font-size: 22px">PV</sup> {{ $result->pv2 }} </h3>
                  <h4 style="margin: 0;margin-bottom: unset;"><sup style="font-size: 19px; font-weight: 900;">SP</sup>{{ $result->sp2 }} </h4>
                </div>
                <div class="icon">
                  <i class="fa fa-thermometer-empty iconColor"></i>
                </div>
                <!-- <p class="small-box-footer"> -->
                <div class="progress-group ">
                  <span class="progress-text ml-1">out2</span>
                  <span class="float-right mr-1"><b> {{ $result->out2 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: {{ $result->out2 }}%"></div>
                  </div>
                </div>
                <!-- <div class="btn-group mb-2 ml-3"> -->
                  @php
                  $out1 = (boolean)($result->obit2&1);
                  $out2 = (boolean)($result->obit2&2);
                  $at = (boolean)($result->obit2&4);
                  $alt1 = (boolean)($result->obit2&4);
                  $alt2 = (boolean)($result->obit2&16);
                  $alt3 = (boolean)($result->obit2&32);
                  $pro = (boolean)($result->obit2&64);
                  $man = (boolean)($result->obit2&128);
                  @endphp
                  <div class="card-footer" style="padding: unset;">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}"> Out1</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}">AT</small>
                        <!-- <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</small> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block">
                        <small class="badge {{  ($alt1 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL1</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt2 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt3 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</small>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($man == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> MAN</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block ">
                        <small class="badge {{  ($pro == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> PRO</small>
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
                <div class="inner">
                  <h3 style="font-size: 3.2rem"><sup style="font-size: 22px">PV</sup> {{ $result->pv3 }} </h3>
                  <h4 style="margin: 0;margin-bottom: unset;"><sup style="font-size: 19px; font-weight: 900;">SP</sup>{{ $result->sp3 }} </h4>
                </div>
                <div class="icon">
                  <i class="fa fa-thermometer-empty iconColor"></i>
                </div>
                <!-- <p class="small-box-footer"> -->
                <div class="progress-group ">
                  <span class="progress-text ml-1">Out3</span>
                  <span class="float-right mr-1"><b> {{ $result->out3 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: {{ $result->out3 }}%"></div>
                  </div>
                </div>
                <!-- <div class="btn-group mb-2 ml-3"> -->
                  @php
                  $out1 = (boolean)($result->obit3&1);
                  $out2 = (boolean)($result->obit3&2);
                  $at = (boolean)($result->obit3&4);
                  $alt1 = (boolean)($result->obit3&4);
                  $alt2 = (boolean)($result->obit3&16);
                  $alt3 = (boolean)($result->obit3&32);
                  $pro = (boolean)($result->obit3&64);
                  $man = (boolean)($result->obit3&128);
                  @endphp
                  <div class="card-footer" style="padding: unset;">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}"> Out1</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}">AT</small>
                        <!-- <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</small> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block">
                        <small class="badge {{  ($alt1 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL1</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt2 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt3 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</small>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($man == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> MAN</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block ">
                        <small class="badge {{  ($pro == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> PRO</small>
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
                <div class="inner">
                  <h3 style="font-size: 3.2rem"><sup style="font-size: 22px">PV</sup> {{ $result->pv4 }} </h3>
                  <h4 style="margin: 0;margin-bottom: unset;"><sup style="font-size: 19px; font-weight: 900;">SP</sup>{{ $result->sp4 }} </h4>
                </div>
                <div class="icon">
                  <i class="fa fa-thermometer-empty iconColor"></i>
                </div>
                <!-- <p class="small-box-footer"> -->
                <div class="progress-group ">
                  <span class="progress-text ml-1">Out4</span>
                  <span class="float-right mr-1"><b> {{ $result->out4 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: {{ $result->out4 }}%"></div>
                  </div>
                </div>
                <!-- <div class="btn-group mb-2 ml-3"> -->
                  @php
                  $out1 = (boolean)($result->obit4&1);
                  $out2 = (boolean)($result->obit4&2);
                  $at = (boolean)($result->obit4&4);
                  $alt1 = (boolean)($result->obit4&4);
                  $alt2 = (boolean)($result->obit4&16);
                  $alt3 = (boolean)($result->obit4&32);
                  $pro = (boolean)($result->obit4&64);
                  $man = (boolean)($result->obit4&128);
                  @endphp
                  <div class="card-footer" style="padding: unset;">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}"> Out1</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}">AT</small>
                        <!-- <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</small> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block">
                        <small class="badge {{  ($alt1 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL1</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt2 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt3 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</small>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($man == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> MAN</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block ">
                        <small class="badge {{  ($pro == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> PRO</small>
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
                <div class="inner">
                  <h3 style="font-size: 3.2rem"><sup style="font-size: 22px">PV</sup> {{ $result->pv5 }} </h3>
                  <h4 style="margin: 0;margin-bottom: unset;"><sup style="font-size: 19px; font-weight: 900;">SP</sup>{{ $result->sp5 }} </h4>
                </div>
                <div class="icon">
                  <i class="fa fa-thermometer-empty iconColor"></i>
                </div>
                <!-- <p class="small-box-footer"> -->
                <div class="progress-group ">
                  <span class="progress-text ml-1">Out5</span>
                  <span class="float-right mr-1"><b> {{ $result->out5 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: {{ $result->out5 }}%"></div>
                  </div>
                </div>

                <!-- <div class="btn-group mb-2 ml-3"> -->
                  @php
                  $out1 = (boolean)($result->obit5&1);
                  $out2 = (boolean)($result->obit5&2);
                  $at = (boolean)($result->obit5&4);
                  $alt1 = (boolean)($result->obit5&4);
                  $alt2 = (boolean)($result->obit5&16);
                  $alt3 = (boolean)($result->obit5&32);
                  $pro = (boolean)($result->obit5&64);
                  $man = (boolean)($result->obit5&128);
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
                <div class="card-footer" style="padding: unset;">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}"> Out1</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}">AT</small>
                        <!-- <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</small> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block">
                        <small class="badge {{  ($alt1 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL1</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt2 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt3 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</small>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($man == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> MAN</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block ">
                        <small class="badge {{  ($pro == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> PRO</small>
                      </div>
                    </div>
                  </div>
                </div>
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 style="font-size: 3.2rem"><sup style="font-size: 22px">PV</sup> {{ $result->pv6 }} </h3>
                  <h4 style="margin: 0;margin-bottom: unset;"><sup style="font-size: 19px; font-weight: 900;">SP</sup>{{ $result->sp6 }} </h4>
                </div>
                <div class="icon">
                  <i class="fa fa-thermometer-empty iconColor"></i>
                </div>
                <!-- <p class="small-box-footer"> -->
                <div class="progress-group ">
                  <span class="progress-text ml-1">Out6</span>
                  <span class="float-right mr-1"><b> {{ $result->out6 }} </b>/100%</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: {{ $result->out6 }}%"></div>
                  </div>
                </div>

                <!-- <div class="btn-group mb-2 ml-3"> -->
                  @php
                  $out1 = (boolean)($result->obit6&1);
                  $out2 = (boolean)($result->obit6&2);
                  $at = (boolean)($result->obit6&4);
                  $alt1 = (boolean)($result->obit6&4);
                  $alt2 = (boolean)($result->obit6&16);
                  $alt3 = (boolean)($result->obit6&32);
                  $pro = (boolean)($result->obit6&64);
                  $man = (boolean)($result->obit6&128);
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
                        <small class="badge {{  ($out1 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }}"> Out1</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($out2 == 1) ? 'bg-gradient-success' : 'bg-gradient-secondary'; }} ">Out2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}">AT</small>
                        <!-- <small class="badge {{  ($at == 1) ? 'bg-gradient-secondary' : 'bg-gradient-danger'; }}"><i class="fas fa-caret-up"></i> AT</small> -->
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block">
                        <small class="badge {{  ($alt1 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL1</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt2 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp; AL2</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($alt3 == 1) ? 'bg-gradient-secondary' : 'bg-gradient-success'; }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;AL3</small>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <small class="badge {{  ($man == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> MAN</small>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="description-block ">
                        <small class="badge {{  ($pro == 1) ? 'bg-gradient-secondary' : 'bg-gradient-warning'; }}"> PRO</small>
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
        <!-- AREA CHART -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Line Chart</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
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
                    <option value="Today" selected="selected">Today</option>
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
          </div>
          <!-- /.card-body -->
        </div>
      </div>

    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<!-- Chart code -->
<script>

</script>




@endsection
@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )

<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Data Alias Map</h3>
            <div class="card-tools">
              <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>  </button>-->
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
            </div>
          </div>
          <div class="card-body mt-1">
            <form method="POST" action="{{ url('admin/device/map-alias/'. $deviceDetail['MQTT_ID']) }} " accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
              {{ csrf_field() }}
              @php
              $count = 0;
              $counts = 0;
              @endphp
              @if(isset($dashboard_alias) && !empty($dashboard_alias))
              <div class="form-group mb-1 {{ $count % 2 == 0 ? 'row ' : ''}} ">
                @foreach($dashboard_alias as $key => $val)
                <label for="modem_id" class="col-form-label mb-2 text-center col-lg-2 offset-sm-0 col-sm-12"> {{ $key }}</label>
                <div class="col-sm-2 mb-0.5">
                  <input class="form-control" name="dashboard_alias[{{ $key }}]" type="text" id="modem_id" value="{{ $val }}">
                </div>
                @php
                $count ++;
                @endphp
                @endforeach
                @endif
              </div>

              <hr/>
              <br/>
              <div class="form-group mb-1 {{ $counts % 2 == 0 ? 'row ' : ''}} ">
                @foreach($parameter_alias as $key => $val)
                <label for="modem_id" class="col-form-label mb-2 text-center col-lg-2 offset-sm-0 col-sm-12"> {{ $key }}</label>
                <div class="col-sm-2 mb-0.5">
                  <input class="form-control" name="parameter_alias[{{ $key }}]" type="text" id="modem_id" value="{{ $val }}">
                </div>
                @php
                $counts ++;
                @endphp
                @endforeach
              </div>
             
              <div class="form-group row">
                <input class="btn btn-success mr-1" type="submit" name="button" >
                <!-- <input class="btn btn-primary" type="submit" name="button" value="Write"> -->
              </div>
              <div class=" row">
                 <!-- <code class="card-body text-center">No  data found</code> -->
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

</section>
@endsection
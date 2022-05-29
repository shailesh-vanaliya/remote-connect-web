@extends('admin.layouts.admin')
@section('title', $pagetitle )
@section('content')
<style>
		#chartdiv {
			width: 100%;
			height: 500px;
			max-width: 100%;
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
    <div class="row">
      <div class="col-md-12">
        <!-- AREA CHART -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Area Chart</h3>
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
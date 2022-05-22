@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<style>
    .faIcon {
    padding: 3px 5px !important;
}

</style>
{{--
    
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Device Map List</h3>
                    <a href="{{ url('/admin/device-map/create') }}" class="btn btn-primary btn-xs pull-right" title="Add New Device Map">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Model No</th>
                                <th>MQTT ID</th>
                                <th>MODEM ID</th>
                                <th>Seceret Key</th>
                                <th>Max User Access</th>
                                <th>IMEI No</th>
                                <th>SIM No</th>
                                <th>SIM Plan</th>
                                <th>Subscription <br/>Expire Date</th>
                                <th>Subscription Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devicemap as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->model_no }}</td>
                                <td>{{ $item->MQTT_ID }}</td>
                                <td>{{ $item->MODEM_ID }}</td>
                                <td>{{ $item->secret_key }}</td>
                                <td>{{ $item->max_user_access }}</td>
                                <td>{{ $item->IMEI_No }}</td>
                                <td>{{ $item->SIM_No }}</td>
                                <td>{{ $item->SIM_Plan }}</td>
                                <td>{{ $item->subscription_expire_date }}</td>
                                <td>{{ $item->subscription_status }}</td>
                                <td class="actionTd" style="display: flex;">
                                    <a href="{{ url('/admin/device-map/' . $item->id) }}" title="View DeviceMap"><button class="btn btn-info btn-xs faIcon"><i class="fa fa-eye " aria-hidden="true"></i> </button></a>
                                   &nbsp; <a href="{{ url('/admin/device-map/' . $item->id . '/edit') }}" title="Edit DeviceMap"><button class="btn btn-primary btn-xs faIcon"><i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>&nbsp;

                                    <form method="POST" action="{{ url('/admin/device-map' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-xs faIcon" title="Delete DeviceMap" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>    
--}}

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-11 col-sm-6 col-12">
                                <h3 class="card-title">Device Map List</h3>
                            </div>
                            <div class="col-md-1 col-sm-6 col-12">
                                <a href="{{ url('/admin/device-map/create') }}" class="btn btn-primary btn-xs pull-right" title="Add New Device Map">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Model No</th>
                                <th>MQTT ID</th>
                                <th>MODEM ID</th>
                                <th>Seceret Key</th>
                                <th>Max User Access</th>
                                <th>IMEI No</th>
                                <th>SIM No</th>
                                <th>SIM Plan</th>
                                <th>Subscription <br/>Expire Date</th>
                                <th>Subscription Status</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($devicemap as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->model_no }}</td>
                                <td>{{ $item->MQTT_ID }}</td>
                                <td>{{ $item->MODEM_ID }}</td>
                                <td>{{ $item->secret_key }}</td>
                                <td>{{ $item->max_user_access }}</td>
                                <td>{{ $item->IMEI_No }}</td>
                                <td>{{ $item->SIM_No }}</td>
                                <td>{{ $item->SIM_Plan }}</td>
                                <td>{{ $item->subscription_expire_date }}</td>
                                <td>{{ $item->subscription_status }}</td>
                                <td class="actionTd" style="display: flex;">
                                    <a href="{{ url('/admin/device-map/' . $item->id) }}" title="View DeviceMap"><button class="btn btn-info btn-xs faIcon"><i class="fa fa-eye " aria-hidden="true"></i> </button></a>
                                   &nbsp; <a href="{{ url('/admin/device-map/' . $item->id . '/edit') }}" title="Edit DeviceMap"><button class="btn btn-primary btn-xs faIcon"><i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>&nbsp;

                                    <form method="POST" action="{{ url('/admin/device-map' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-xs faIcon" title="Delete DeviceMap" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection



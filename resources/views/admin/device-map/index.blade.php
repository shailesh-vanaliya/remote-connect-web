{{--

    @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Devicemap</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/device-map/create') }}" class="btn btn-success btn-sm" title="Add New DeviceMap">
<i class="fa fa-plus" aria-hidden="true"></i> Add New
</a>

<form method="GET" action="{{ url('/admin/device-map') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
        <span class="input-group-append">
            <button class="btn btn-secondary" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
</form>

<br />
<br />
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>MQTT ID</th>
                <th>MODEM ID</th>
                <th>Seceret Key</th>
                <th>Max User Acess</th>
                <th>IMEI No</th>
                <th>SIM No</th>
                <th>SIM Plan</th>
                <th>Subscription Expire Date</th>
                <th>Subscription Tatus</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devicemap as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->MQTT_ID }}</td>
                <td>{{ $item->MODEM_ID }}</td>
                <td>{{ $item->seceret_key }}</td>
                <td>{{ $item->max_user_acess }}</td>
                <td>{{ $item->IMEI_No }}</td>
                <td>{{ $item->SIM_No }}</td>
                <td>{{ $item->SIM_Plan }}</td>
                <td>{{ $item->subscription_expire_date }}</td>
                <td>{{ $item->subscription_status }}</td>
                <td>{{ $item->created_by }}</td>
                <td>
                    <a href="{{ url('/admin/device-map/' . $item->id) }}" title="View DeviceMap"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </button></a>
                    <a href="{{ url('/admin/device-map/' . $item->id . '/edit') }}" title="Edit DeviceMap"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button></a>

                    <form method="POST" action="{{ url('/admin/device-map' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete DeviceMap" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper"> {!! $devicemap->appends(['search' => Request::get('search')])->render() !!} </div>
</div>

</div>
</div>
</div>
</div>
</div>
@endsection
--}}


@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<style>
    .btn-group-sm>.btn, .btn-sm {
    padding: 3px 6px !important;
}

</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Device Map List</h3>
                    <a href="{{ url('/admin/device-map/create') }}" class="btn btn-primary btn-sm pull-right" title="Add New Device Map">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>MQTT ID</th>
                                <th>MODEM ID</th>
                                <th>Seceret Key</th>
                                <th>Max User Acess</th>
                                <th>IMEI No</th>
                                <th>SIM No</th>
                                <th>SIM Plan</th>
                                <th>Subscription Expire Date</th>
                                <th>Subscription Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devicemap as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->MQTT_ID }}</td>
                                <td>{{ $item->MODEM_ID }}</td>
                                <td>{{ $item->seceret_key }}</td>
                                <td>{{ $item->max_user_acess }}</td>
                                <td>{{ $item->IMEI_No }}</td>
                                <td>{{ $item->SIM_No }}</td>
                                <td>{{ $item->SIM_Plan }}</td>
                                <td>{{ $item->subscription_expire_date }}</td>
                                <td>{{ $item->subscription_status }}</td>
                                <td>
                                    <a href="{{ url('/admin/device-map/' . $item->id) }}" title="View DeviceMap"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </button></a>
                                    <a href="{{ url('/admin/device-map/' . $item->id . '/edit') }}" title="Edit DeviceMap"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button></a>

                                    <form method="POST" action="{{ url('/admin/device-map' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete DeviceMap" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> </button>
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
@endsection
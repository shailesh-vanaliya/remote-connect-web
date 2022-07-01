@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border float-right mr-1 mb-2">
                    <!-- <h3 class="box-title">DeviceMap {{ $devicemap->id }}</h3> -->
                    <a href="{{ url('/admin/device-map') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/admin/device-map/' . $devicemap->id . '/edit') }}" title="Edit DeviceMap"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('admin/devicemap' . '/' . $devicemap->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete DeviceMap" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
                    </form>
                </div>
                <div class="box-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <!-- <tr>
                                    <th>ID</th>
                                    <td>{{ $devicemap->id }}</td>
                                </tr> -->
                                <tr>
                                    <th> MQTT ID </th>
                                    <td> {{ $devicemap->MQTT_ID }} </td>
                                </tr>
                                <tr>
                                    <th> MODEM ID </th>
                                    <td> {{ $devicemap->MODEM_ID }} </td>
                                </tr>
                                <tr>
                                    <th> Seceret Key </th>
                                    <td> {{ $devicemap->secret_key }} </td>
                                </tr>
                                <tr>
                                    <th> Max User Access </th>
                                    <td> {{ $devicemap->max_user_access }} </td>
                                </tr>
                                <tr>
                                    <th> IMEI No </th>
                                    <td> {{ $devicemap->IMEI_No }} </td>
                                </tr>
                                <tr>
                                    <th> SIM No </th>
                                    <td> {{ $devicemap->SIM_No }} </td>
                                </tr>
                                <tr>
                                    <th> SIM Plan </th>
                                    <td> {{ $devicemap->SIM_Plan }} </td>
                                </tr>
                                <tr>
                                    <th> Subscription Expire Date </th>
                                    <td> {{ $devicemap->subscription_expire_date }} </td>
                                </tr>
                                <tr>
                                    <th> Subscription Tatus </th>
                                    <td> {{ $devicemap->subscription_status }} </td>
                                </tr>
                                <tr>
                                    <th> Created By </th>
                                    <td> {{ $devicemap->created_by }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
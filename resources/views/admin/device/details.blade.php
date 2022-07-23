@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )

<section class="content">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <p class="">
                    <b>Project:</b> <a class="mr-5">{{ $deviceDetail->project_name }}</a>
                    <b>Modem ID:</b> <a class="mr-5">{{$deviceDetail->modem_id }}</a>
                    <b>Status:</b> <i class="fa-solid fa fa-circle mr-5" style="color: {{ $deviceDetail->Status == 1 ? '#008D4C' : '#DD4B39'  }}"> {{ $deviceDetail->Status == 1 ? 'Online' : 'Offline'  }}</i>
                </p>
            </h3>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <form action="{{ route('uploadFile') }}" enctype="multipart/form-data" method="POST" class="form-horizontal" id="addNewEvent" enctype="multipart/form-data">
                    <div class="">
                        <div class="card-body box-profile">
                        <h3 class="profile-username text-center">Machine Image</h3>
                            <!-- <p class="text-muted text-center">
                                <li class="list-group-item">
                                    <b>Project:</b> <a class="float-right">{{ $deviceDetail->project_name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Modem ID:</b> <a class="float-right">{{$deviceDetail->modem_id }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status:</b> <i class="fa-solid fa fa-circle float-right" style="color: {{ $deviceDetail->Status == 1 ? '#008D4C' : '#DD4B39'  }}"> {{ $deviceDetail->Status == 1 ? 'Online' : 'Offline'  }}</i>
                                </li>
                            </p> -->
                            <div class="text-center">
                                <img style="width:auto;" class="col-md-6 col-md-12 text-center" src="{{ asset('/public/uploads/device/' . $deviceDetail->img ) }}" alt="">
                            </div>
                            <br />
                            <input type="file" name="logo" class="btn btn-default btn-block">
                            <button type="submit" class="btn btn-primary btn-block ">Save File</button>
                            {{ csrf_field() }}
                            <input type="hidden" name="deviceId" value="{{$deviceDetail->id }}">
                            <input type="hidden" name="img" value="{{$deviceDetail->img }}">

                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Detail Information</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Device List</a></li>
                            <a href="{{ url('/admin/device') }}" style="padding: 1% 0% 0% 50%;" title="Back" class="float-right"><button class="btn btn-warning btn-sm float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="box-header  ">
                                    <div class="card-body">
                                        <p>
                                            <strong>Customer Name:</strong> {{$deviceDetail->customer_name }}
                                        </p>
                                        <p>
                                            <strong>Machine Type:</strong> {{$deviceDetail->machine_type }}
                                        </p>
                                        <p>
                                            <strong>Region: </strong> {{$deviceDetail->region }}
                                        </p>
                                        <p>
                                            <strong>Location:</strong> {{$deviceDetail->location }}
                                        </p>
                                        <p>
                                            <strong>Description:</strong> {{$deviceDetail->description }}
                                        </p>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('connectServer') }}" enctype="multipart/form-data" method="POST" class="form-horizontal" id="addNewEvent" enctype="multipart/form-data">
                                            <div class="">
                                                <div class="col-md-6" style="padding: 4px;font-size: 17px;">
                                                    <input name="secure" type="checkbox"> &nbsp;&nbsp; Secure Connect
                                                    <input type="hidden" name="deviceId" value="{{ $deviceDetail->id }}">
                                                    <input type="hidden" name="modem_id" value="{{$deviceDetail->modem_id }}">
                                                    <input type="hidden" name="MQTT_ID" value="{{ $deviceDetail->MQTT_ID }}">
                                                    <input type="hidden" name="statusId" value="{{ $deviceDetail->statusId }}">
                                                    <input type="hidden" name="secret_key" value="{{$deviceDetail->secret_key }}">
                                                    {{ csrf_field() }}
                                                </div>

                                                <div class="col-md-6" style="padding: 4px;font-size: 17px;">
                                                    <button type="submit" {{$deviceDetail->STATUS == 1 ? 'disabled' : ''}} name="connect" value="connect" class="btn btn-success" style="padding-left: 10px;">Connect</button>
                                                    <button type="submit" {{$deviceDetail->STATUS == 0 ? 'disabled' : ''}} name="connect" value="disconnect" class="btn btn-danger" style="padding-left: 10px;">Disconnect</button>
                                                    <button type="button" name="connect" class="btn btn-default" style="padding-left: 10px;"><a href='{{ url("/admin/device/device-detail/$deviceDetail->id") }}' title="Back">Refresh</a></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="timeline">
                                <div class="box box-primary">
                                    <div class="  box-body table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Device Name</th>
                                                    <th>Assign URL</th>
                                                    <th>Assign PORT</th>
                                                    <th>Local IP</th>
                                                    <th>Status</th>
                                                    <th>Updated Time</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($remote as $item)
                                                <tr>
                                                    <td>{{ $item->MACHINE_NO }}</td>
                                                    <td>{{ $item->device_name }}</td>
                                                    <td>{{ $item->remote_URL }}</td>
                                                    <td>{{ $item->MACHINE_REMOTE_PORT }}</td>
                                                    <td>{{ $item->MACHINE_LOCAL_IP }}</td>
                                                    @if($item->STATUS == 1)
                                                    <td>
                                                        <span style="background: green;color:#fff;padding:5px;font-size: 13px;border-radius: 5px;">Online</span>
                                                    </td>
                                                    @else
                                                    <td>
                                                        <span style="background: red;color:#fff;padding:5px;font-size: 13px;border-radius: 5px;">Offline</span>
                                                    </td>
                                                    @endif
                                                    <td>{{ date('d-m-Y h:m:s', strtotime($item->updated_at)); }}</td>
                                                    <td>
                                                        <a href="javascript:;" class="modelName" title="Edit Device Name" data-id={{ $item->id }} data-device={{ $item->device_name }}>
                                                            <button class="btn btn-primary  btn-sm">
                                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>
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
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="box col-md-12">
                <div class="box-header  ">
                    <div class="box-title" style="display: unset;font-size: 17px; line-height: unset;">
                        <span class="">Project : <span style="padding: 0px  7%  0px  0px ;">{{ $deviceDetail->project_name }}</span>
                        </span>
                        <span class="">Modem ID: <span style="padding: 0px  7%  0px  0px ;">{{$deviceDetail->modem_id }} </span>
                        </span>
                        <span class="">Status: <span style="padding: 0px  7%  0px  0px ;"> <i class="fa-solid fa fa-circle" style="color: {{ $deviceDetail->Status == 1 ? '#008D4C' : '#DD4B39'  }}"></i> {{ $deviceDetail->Status == 1 ? 'Online' : 'Offline'  }}</span> </span>
                    </div>
                    <a href="{{ url('/admin/device') }}" title="Back"><button class="btn btn-warning btn-sm pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="card-title">
                                Machine Image
                            </h3>
                        </div>
                        <div class="card-body">
                            <img style="padding-left: 10px; max-width:450px;max-height:450px;" src="{{ asset('/public/uploads/device/' . $deviceDetail->img ) }}" alt="">
                        </div>
                        <div class="card-body">
                            <form action="{{ route('uploadFile') }}" enctype="multipart/form-data" method="POST" class="form-horizontal" id="addNewEvent" enctype="multipart/form-data">
                                <div class="mb-5" style="padding-top:10px ;">
                                    {{ csrf_field() }}
                                    <input type="file" name="logo" class="col-md-6 col-sm-12">
                                    <input type="hidden" name="deviceId" value="{{$deviceDetail->id }}">
                                    <input type="hidden" name="img" value="{{$deviceDetail->img }}">
                                    <div class="col-md-6 col-sm-12" style="padding-bottom: 20px;;">
                                        <button type="submit" class="btn green-haze pull-left ">Save File</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header  ">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Detail Information
                                </h3>
                            </div>
                            <div class="card-body">
                                <p>
                                    <strong>Customer Name:</strong> {{$deviceDetail->customer_name }}
                                </p>
                                <p>
                                    <strong>Machine Type:</strong> {{$deviceDetail->machine_type }}
                                </p>
                                <p>
                                    <strong>Region: </strong> {{$deviceDetail->region }}
                                </p>
                                <p>
                                    <strong>Location:</strong> {{$deviceDetail->location }}
                                </p>
                                <p>
                                    <strong>Description:</strong> {{$deviceDetail->description }}
                                </p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('connectServer') }}" enctype="multipart/form-data" method="POST" class="form-horizontal" id="addNewEvent" enctype="multipart/form-data">
                                    <div class="">
                                        <div class="col-md-6" style="padding: 4px;font-size: 17px;">
                                            <input name="secure" type="checkbox"> &nbsp;&nbsp; Secure Connect
                                            <input type="hidden" name="deviceId" value="{{ $deviceDetail->id }}">
                                            <input type="hidden" name="modem_id" value="{{$deviceDetail->modem_id }}">
                                            <input type="hidden" name="MQTT_ID" value="{{ $deviceDetail->MQTT_ID }}">
                                            <input type="hidden" name="statusId" value="{{ $deviceDetail->statusId }}">
                                            <input type="hidden" name="secret_key" value="{{$deviceDetail->secret_key }}">
                                            {{ csrf_field() }}
                                        </div>

                                        <div class="col-md-6" style="padding: 4px;font-size: 17px;">
                                            <button type="submit" {{$deviceDetail->STATUS == 1 ? 'disabled' : ''}} name="connect" value="connect" class="btn btn-success" style="padding-left: 10px;">Connect</button>
                                            <button type="submit" {{$deviceDetail->STATUS == 0 ? 'disabled' : ''}} name="connect" value="disconnect" class="btn btn-danger" style="padding-left: 10px;">Disconnect</button>
                                            <button type="button" name="connect" class="btn btn-default" style="padding-left: 10px;"><a href='{{ url("/admin/device/device-detail/$deviceDetail->id") }}' title="Back">Refresh</a></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12aa">
                        <div class="box box-primary">
                            <div class="  box-body table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Device Name</th>
                                            <th>Assign URL</th>
                                            <th>Assign PORT</th>
                                            <th>Local IP</th>
                                            <th>Status</th>
                                            <th>Updated Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($remote as $item)
                                        <tr>
                                            <td>{{ $item->MACHINE_NO }}</td>
                                            <td>{{ $item->device_name }}</td>
                                            <td>{{ $item->remote_URL }}</td>
                                            <td>{{ $item->MACHINE_REMOTE_PORT }}</td>
                                            <td>{{ $item->MACHINE_LOCAL_IP }}</td>
                                            @if($item->STATUS == 1)
                                            <td>
                                                <span style="background: green;color:#fff;padding:5px;font-size: 13px;border-radius: 5px;">Online</span>
                                            </td>
                                            @else
                                            <td>
                                                <span style="background: red;color:#fff;padding:5px;font-size: 13px;border-radius: 5px;">Offline</span>
                                            </td>
                                            @endif
                                            <td>{{ date('d-m-Y h:m:s', strtotime($item->updated_at)); }}</td>
                                            <td>
                                                <a href="javascript:;" class="modelName" title="Edit Device Name" data-id={{ $item->id }} data-device={{ $item->device_name }}>
                                                    <button class="btn btn-primary  btn-sm">
                                                        <i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>
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
        </div>
    </div> -->

<div class="modal fade" id="updateNameModel" tabindex="-1" role="updateNameModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Update device name</h4>
            </div>
            <form action="{{ route('updateName') }}" enctype="multipart/form-data" method="POST" class="form-horizontal" id="addNewEvent">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="device_name" class="col-form-label text-right col-lg-4 col-sm-12">{{ 'Please device name' }}</label>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <input class="form-control device_name" require type="text" id="device_name" name="device_name" value="">
                                    <input class="form-control modem_id" require type="hidden" id="modem_id" name="modem_id" value="{{ $deviceDetail->modem_id }}">
                                    <input class="form-control deviceid" require type="hidden" id="deviceid" name="deviceid" value="{{ $deviceDetail->deviceid }}">
                                    <input type="hidden" name="deviceIds" value="{{ $deviceDetail->id }}">

                                    {!! $errors->first('device_name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary m-l newEventModel" type="submit">Submit</button>
                    <button class="btn btn-sm btn-secondary pull-right m-l" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modelName').click(function() {
            $('#updateNameModel').modal('show');
            $('.deviceid').val($(this).attr('data-id'));
            $('.device_name').val($(this).attr('data-device'));
        });
    });
</script>

</section>
@endsection
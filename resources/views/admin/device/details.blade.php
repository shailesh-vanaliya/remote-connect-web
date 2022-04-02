@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <!-- <h3 class="box-title">Project : {{$deviceDetail->project_name }}  </h3> -->
                    <div class="box-title" style="display: unset;font-size: 17px; line-height: unset;">
                        <span class="">Project : <span style="padding: 0px  7%  0px  0px ;">{{$deviceDetail->project_name }}</span>
                        </span>
                        <span class="">Modem ID: <span style="padding: 0px  7%  0px  0px ;">{{$deviceDetail->modem_id }} </span>
                        </span>
                        <span class="">Status: <span style="padding: 0px  7%  0px  0px ;"> <i class="fa-solid fa fa-circle" style="color: {{ $deviceDetail->Status == 1 ? '#008D4C' : '#DD4B39'  }}"></i> {{ $status == 1 ? 'Online' : 'Offline'  }}</span> </span>
                    </div>
                    <a href="{{ url('/admin/device') }}" title="Back"><button class="btn btn-warning btn-sm pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                </div>

                <div class="invoice1">
                    <div class="row">
                        <div class="col-xs-5" style="border-right: 3px solid #F4F4F4;">
                            <form action="{{ route('uploadFile') }}" enctype="multipart/form-data" method="POST" class="form-horizontal" id="addNewEvent" enctype="multipart/form-data">
                                <div class="booking-img ">
                                    <!-- <img width="200px" src="http://localhost/remote-connect-web/public/img/futuristic.png" alt=""> -->
                                    <img style="padding-left: 10px; max-width:450px;max-height:450px;" src="{{ asset('/public/uploads/device/' . $deviceDetail->img ) }}" alt="">
                                    <div class="mb-5" style="padding-top:10px ;">
                                        {{ csrf_field() }}
                                        <input type="file" name="logo" class="col-md-6">
                                        <!-- <input type="file" name="logo" id="img" style="display:none;" /> -->
                                        <!-- <label for="img">Please select machine image</label> -->
                                        <input type="hidden" name="deviceId" value="{{$deviceDetail->id }}">
                                        <input type="hidden" name="img" value="{{$deviceDetail->img }}">
                                        <button type="submit" class="btn green-haze">Save File</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-xs-7 col-md-7 invoice-payment">
                            <div style="padding: 0px 10px 10px 15px;" class="row">
                                <h3>Detail Information:</h3>
                                <ul class="list-unstyled">
                                    <li>
                                        <strong>Customer Name:</strong> {{$deviceDetail->customer_name }}
                                    </li>
                                    <li>
                                        <strong>Machine Type:</strong> {{$deviceDetail->machine_type }}
                                    </li>
                                    <li>
                                        <strong>Region: </strong> {{$deviceDetail->region }}
                                    </li>
                                    <li>
                                        <strong>Location:</strong> {{$deviceDetail->location }}
                                    </li>
                                    <li>
                                        <strong>Description:</strong> {{$deviceDetail->description }}
                                    </li>
                                </ul> <br />
                                <form action="{{ route('connectServer') }}" enctype="multipart/form-data" method="POST" class="form-horizontal" id="addNewEvent" enctype="multipart/form-data">
                                    <div class="">
                                        <div class="col-md-8" style="padding: 4px;font-size: 17px;">
                                            <input name="secure" type="checkbox"> &nbsp;&nbsp; Secure Connect
                                            <input type="hidden" name="deviceId" value="{{$deviceDetail->id }}">
                                            <input type="hidden" name="modem_id" value="{{$deviceDetail->modem_id }}">
                                            <input type="hidden" name="MQTT_ID" value="{{ $deviceDetail->MQTT_ID }}">
                                            <input type="hidden" name="statusId" value="{{ $deviceDetail->statusId }}">
                                            <input type="hidden" name="secret_key" value="{{$deviceDetail->secret_key }}">
                                            {{ csrf_field() }}
                                        </div>

                                        <div class="col-md-4" style="padding: 4px;font-size: 17px;">
                                            <button type="submit" {{$deviceDetail->Status == 0 ? 'disabled' : ''}} name="connect" value="connect" class="btn btn-success" style="padding-left: 10px;">Connect</button>
                                            <button type="submit" {{$deviceDetail->Status == 0 ? 'disabled' : ''}} name="connect" value="disconnect" class="btn btn-danger" style="padding-left: 10px;">Disconnect</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <hr style="color: gray;" />
                            <div class="table-class" style="">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Device Name</th>
                                            <th>Remote URL</th>
                                            <th>REMOTE PORT</th>
                                            <th>LOCAL IP</th>
                                            <th>STATUS</th>
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
                                            <td style="color: green;">Online</td>
                                            @else
                                            <td style="color: red;">Offline</td>
                                            @endif
                                            <td>{{ date('d-m-Y h:m:s', strtotime($item->updated_at)); }}</td>
                                            <td>aa</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr />

                    <!-- <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Device Name</th>
                                        <th>Remote URL</th>
                                        <th>REMOTE PORT</th>
                                        <th>LOCAL IP</th>
                                        <th>LOCAL PORT</th>
                                        <th>STATUS</th>
                                        <th>Updated Time</th>
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
                                        <td>{{ $item->MACHINE_LOCAL_PORT }}</td>
                                        @if($item->STATUS == 1)
                                        <td style="color: green;">Online</td>
                                        @else
                                        <td style="color: red;">Offline</td>
                                        @endif
                                        <td>{{ date('d-m-Y h:m:s', strtotime($item->updated_at)); }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> -->
                    <!-- 
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Model No</th>
                                        <th>Modem Id</th>
                                        <th>Secret Key</th>
                                        <th>Project Name</th>
                                        <th>Customer Name</th>
                                        <th>Region</th>
                                        <th>Location</th>
                                        <th>Machine Type</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($device as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->model_id }}</td>
                                        <td>{{ $item->modem_id }}</td>
                                        <td>{{ $item->secret_key }}</td>
                                        <td> <a href="{{ url('/admin/device/device-detail/' . $item->id ) }}" title="View Device">
                                                {{ $item->project_name }}
                                            </a>
                                        </td>
                                        <td>{{ $item->customer_name }}</td>
                                        <td>{{ $item->region }}</td>
                                        <td>{{ $item->location }}</td>
                                        <td>{{ $item->machine_type }}</td>
                                        <td>{{ $item->latitude }}</td>
                                        <td>{{ $item->longitude }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
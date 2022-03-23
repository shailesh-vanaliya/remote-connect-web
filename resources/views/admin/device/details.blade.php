@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )

<section class="content">

    <div class="row">

        <div class="col-md-12">

            <div class="box">
                <div class="box-header" style="display: grid;">
                    <p class="">Project : {{$deviceDetail->project_name }}
                    </p>
                    <p class="">Modem ID: {{$deviceDetail->modem_id }}
                    </p>
                    <p class="">Status: <i class="fa-solid fa fa-circle" style="color: {{ $status == 1 ? 'green' : 'red'  }}"></i>      {{ $status == 1 ? 'Online' : 'Offline'  }}

                    </p>
                </div>
                <div class="invoice1">
                    <div class="row">
                        <div class="col-xs-5">
                            <form action="{{ route('uploadFile') }}" enctype="multipart/form-data" method="POST" class="form-horizontal" id="addNewEvent" enctype="multipart/form-data">
                                <div class="booking-img">
                                    <!-- <img width="200px" src="http://localhost/remote-connect-web/public/img/futuristic.png" alt=""> -->
                                    <img width="200px" src="{{ asset('/public/uploads/device/' . $deviceDetail->img ) }}" alt="">
                                    <div class="">
                                        {{ csrf_field() }}
                                        <input type="file" name="logo" class="col-md-6">
                                        <input type="hidden" name="deviceId" value="{{$deviceDetail->id }}">
                                        <input type="hidden" name="img" value="{{$deviceDetail->img }}">
                                        <button type="submit" class="btn green-haze">Save File</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-7 invoice-payment">
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
                                    <div class="col-md-12" style="padding: 4px;font-size: 17px;">
                                        <input name="secure" type="checkbox"> &nbsp;&nbsp; Secure Connect
                                    </div>
                                    <input type="hidden" name="deviceId" value="{{$deviceDetail->id }}">
                                    <input type="hidden" name="modem_id" value="{{$deviceDetail->modem_id }}">
                                    {{ csrf_field() }}
                                    <button type="submit" name="connect" value="connect" class="btn btn-success">Connect</button>
                                    <button type="submit" name="connect" value="disconnect" class="btn btn-danger">Disconnect</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Modem Id</th>
                                        <th>Secret Key</th>
                                        <th>Project Name</th>
                                        <th>Customer Name</th>
                                        <th>Region</th>
                                        <th>Location</th>
                                        <th>Machine Type</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($device as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->modem_id }}</td>
                                        <td>{{ $item->secret_key }}</td>
                                        <td>   <a href="{{ url('/admin/device/device-detail/' . $item->id ) }}" title="View Device">
                                    {{ $item->project_name }}
                                    </a>
                                </td>
                                        <td>{{ $item->customer_name }}</td>
                                        <td>{{ $item->region }}</td>
                                        <td>{{ $item->location }}</td>
                                        <td>{{ $item->machine_type }}</td>
                                        <td>{{ $item->latitude }}</td>
                                        <td>{{ $item->longitude }}</td>
                                        <!-- <td>
                                    <a href="{{ url('/admin/device/' . $item->id . '/edit') }}" title="Edit Device"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button></a>
                                    <form method="POST" action="{{ url('/admin/device' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Device" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> </button>
                                    </form>
                                </td> -->
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
</section>
@endsection
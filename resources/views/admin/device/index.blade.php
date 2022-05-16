@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-12 mt-2">
                            <h3 class="card-title">Device list</h3>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            {{ Form::select('search', $location , empty(request('search')) ? null : request('search') , array('class' => 'form-control search', 'id' => 'search')) }}
                        </div>
                        <div class="col-md-1 col-sm-6 col-12">
                            <a href="{{ url('/admin/device/create') }}" class="pull-right btn btn-success btn-sm" title="Add New Unit">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($device as $item)
            <div class="col-md-3">
                @php
                if (@getimagesize(asset('/public/uploads/device/' . $item->img ))){
                $imageName = asset('/public/uploads/device/' . $item->img );
                } else {
                $imageName = asset('/public/uploads/device/no_image.svg');
                }
                if($item->Status == 1){
                $sss = "box-shadow: 0 0.125rem 0.25rem #28A745 !important;";
                }else{
                $sss = "box-shadow: 0 0.125rem 0.25rem #DC3545 !important;";
                }
                @endphp
                <!-- Widget: user widget style 2 -->
                <div class="card card-widget widget-user-2 shadow-sm" style="{{ $sss }}">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header " style="padding: 0.8rem 0.2rem 0.2rem 0.7rem;">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ $imageName }}" alt="no image">
                        </div>
                        <h3 class="widget-user-username">{{ $item->modem_id }}</h3>
                        <p class="widget-user-desc" title="{{  $item->location }}">{{ $item->project_name }} ({{ strlen($item->location) > 10 ? substr($item->location,0,10) : $item->location }})</p>
                    </div>
                    <div class="card-footer p-0" style="background-color:unset; border-top: 1px solid rgba(0,0,0,.125)">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ $item->subscription_status == 'Active' ? url('/admin/device/device-detail/' . $item->id ) : '#' }}" class="nav-link">
                                    Status
                                    @if($item->Status == 1)
                                    <span class="float-right badge bg-success">
                                        Online
                                    </span>
                                    @else
                                    <span class="float-right badge bg-danger">
                                        Offline
                                        @endif
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Signal Straight <span class="float-right badge bg-info">sssssss</span>
                                </a>
                            </li>

                            <li class="nav-item m-2 text-center">
                                <a href="{{ url('/admin/device/' . $item->id) }}" title="View Device"><button class="btn btn-primary btn-xs "><i class="fas fa-eye" aria-hidden="true"></i> </button></a>
                                <a href="{{ url('/admin/device/' . $item->id . '/edit') }}" title="Edit Device"><button class="btn btn-primary btn-xs "><i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>
                                <form method="POST" action="{{ url('/admin/device' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-xs" title="Delete Device" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i> </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            @endforeach
            @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <!-- <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8 col-sm-6 col-12">
                                <h3 class="card-title">Device list</h3>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                {{ Form::select('search', $location , empty(request('search')) ? null : request('search') , array('class' => 'form-control search', 'id' => 'search')) }}
                            </div>
                            <div class="col-md-1 col-sm-6 col-12">
                                <a href="{{ url('/admin/device/create') }}" class="pull-right btn btn-success btn-sm" title="Add New Unit">
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
                                    <th>Model Id</th>
                                    <th>Modem Id</th>
                                    <th>Secret Key</th>
                                    <th>Project Name</th>
                                    <th>Customer Name</th>
                                    <th>Region</th>
                                    <th>Location</th>
                                    <th>Machine Type</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($device as $item)
                                <tr>
                                    <td> <a href="{{ url('/admin/device/device-detail/' . $item->id ) }}" title="View Device">{{ $loop->iteration }}</a></td>
                                    <td>{{ $item->model_no }}</td>
                                    <td>{{ $item->modem_id }}</td>
                                    <td>
                                        {{ $item->secret_key }}
                                    </td>
                                    <td>
                                        @if($item->subscription_status == 'Active')
                                        <a href="{{ url('/admin/device/device-detail/' . $item->id ) }}" title="View Device">
                                            {{ $item->project_name }}
                                        </a>
                                        @else
                                        {{ $item->project_name }}
                                        @endif
                                    </td>
                                    <td>{{ $item->customer_name }}</td>
                                    <td>{{ $item->region }}</td>
                                    <td>{{ $item->location }}</td>
                                    <td>{{ $item->machine_type }}</td>
                                    <td>{{ $item->latitude }}</td>
                                    <td>{{ $item->longitude }}</td>
                                    <td>
                                        <a href="{{ url('/admin/device/' . $item->id . '/edit') }}" title="Edit Device"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>
                                        <form method="POST" action="{{ url('/admin/device' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Device" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="box-header">
                    <div class="form-group col-lg-9 col-sm-4">
                        <h3 class="box-title">Device list</h3>
                    </div>
                    <div class="form-group col-lg-2 col-sm-6 col-md-2">
                        {{ Form::select('search', $location , empty(request('search')) ? null : request('search') , array('class' => 'form-control search', 'id' => 'search')) }}
                    </div>
                    <a href="{{ url('/admin/device/create') }}" class="pull-right btn btn-success btn-sm" title="Add New Unit">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>
                </div>

                <div class="box-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Model Id</th>
                                <th>Modem Id</th>
                                <th>Secret Key</th>
                                <th>Project Name</th>
                                <th>Customer Name</th>
                                <th>Region</th>
                                <th>Location</th>
                                <th>Machine Type</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($device as $item)
                            <tr>
                                <td> <a href="{{ url('/admin/device/device-detail/' . $item->id ) }}" title="View Device">{{ $loop->iteration }}</a></td>
                                <td>{{ $item->model_no }}</td>
                                <td>{{ $item->modem_id }}</td>
                                <td>
                                    {{ $item->secret_key }}
                                </td>
                                <td>
                                    @if($item->subscription_status == 'Active')
                                    <a href="{{ url('/admin/device/device-detail/' . $item->id ) }}" title="View Device">
                                        {{ $item->project_name }}
                                    </a>
                                    @else
                                    {{ $item->project_name }}
                                    @endif
                                </td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->region }}</td>
                                <td>{{ $item->location }}</td>
                                <td>{{ $item->machine_type }}</td>
                                <td>{{ $item->latitude }}</td>
                                <td>{{ $item->longitude }}</td>
                                <td>
                                    <a href="{{ url('/admin/device/' . $item->id . '/edit') }}" title="Edit Device"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>
                                    <form method="POST" action="{{ url('/admin/device' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Device" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
</section>
<script>
    $(document).ready(function() {
        // $(document).Toasts('create', {
        //     class: 'bg-success',
        //     title: 'Toast Title sdsadsa sadsa dsasa',
        //     // subtitle: 'Subtitle',
        //     // body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        // })

        $('#search').change(function() {
            console.log($('#search :selected').text());
            let serachValue = $('#search :selected').val();
            var pathname = window.location.pathname;
            var url = window.location.href;
            var origin = window.location.origin;
            let rurl = origin + pathname + "?search=" + serachValue;
            if (serachValue != undefined && serachValue != '') {
                window.location.replace(rurl);
            } else {
                window.location.replace(origin + pathname);
            }
        });
    });
</script>

@endsection
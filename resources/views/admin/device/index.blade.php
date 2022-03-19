{{--
    @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Device</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/device/create') }}" class="btn btn-success btn-sm" title="Add New Device">
<i class="fa fa-plus" aria-hidden="true"></i> Add New
</a>

<form method="GET" action="{{ url('/admin/device') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                <th>Modem Id</th>
                <th>Secret Key</th>
                <th>Project Name</th>
                <th>Customer Name</th>
                <th>Region</th>
                <th>Location</th>
                <th>Machine Type</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($device as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->modem_id }}</td>
                <td>{{ $item->secret_key }}</td>
                <td>{{ $item->project_name }}</td>
                <td>{{ $item->customer_name }}</td>
                <td>{{ $item->region }}</td>
                <td>{{ $item->location }}</td>
                <td>{{ $item->machine_type }}</td>
                <td>{{ $item->latitude }}</td>
                <td>{{ $item->longitude }}</td>
                <td>{{ $item->created_by }}</td>
                <td>
                    <a href="{{ url('/admin/device/' . $item->id) }}" title="View Device"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                    <a href="{{ url('/admin/device/' . $item->id . '/edit') }}" title="Edit Device"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('/admin/device' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Device" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper"> {!! $device->appends(['search' => Request::get('search')])->render() !!} </div>
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
<section class="content">
    <div class="row">
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
                    <div class="form-group col-lg-9 col-sm-12">
                        <h3 class="box-title">Device list</h3>
                    </div>
                    <div class="form-group col-lg-2 col-sm-12">
                        {{ Form::select('search', $location , empty(request('search')) ? null : request('search') , array('class' => 'form-control search', 'id' => 'search')) }}
                    </div>

                    <a href="{{ url('/admin/device/create') }}" class="pull-right btn btn-success btn-sm" title="Add New Unit">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($device as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->modem_id }}</td>
                                <td>{{ $item->secret_key }}</td>
                                <td>
                                <a href="{{ url('/admin/device/device-detail/' . $item->id ) }}" title="Edit Device">
                                    {{ $item->project_name }}
                                    </a>
                                </td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->region }}</td>
                                <td>{{ $item->location }}</td>
                                <td>{{ $item->machine_type }}</td>
                                <td>{{ $item->latitude }}</td>
                                <td>{{ $item->longitude }}</td>
                                <td>
                                    <!-- <a href="{{ url('/admin/device/' . $item->id) }}" title="View Device"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </button></a> -->
                                    <a href="{{ url('/admin/device/' . $item->id . '/edit') }}" title="Edit Device"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button></a>
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
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#search').change(function() {
            console.log($('#search :selected').text());
            let serachValue = $('#search :selected').val();
            var pathname = window.location.pathname; 
            var url = window.location.href; 
            var origin = window.location.origin;
            let rurl  = origin+pathname + "?search="+serachValue;
            if(serachValue !=  undefined && serachValue != ''){
                window.location.replace(rurl);
            }else{
                window.location.replace(origin+pathname);
            }
        });
    });
</script>

@endsection
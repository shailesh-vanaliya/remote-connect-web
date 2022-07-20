@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Devicetype</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/device-type/create') }}" class="btn btn-success btn-sm" title="Add New DeviceType">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/device-type') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Device Type</th><th>Data Source</th><th>Data Table</th><th>Dashboard Id</th><th>Parameter Alias</th><th>Unit Alias</th><th>Chart Alias</th><th>Dashboard Alias</th><th>Model Name</th><th>Access Type</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($devicetype as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->device_type }}</td><td>{{ $item->data_source }}</td><td>{{ $item->data_table }}</td><td>{{ $item->dashboard_id }}</td><td>{{ $item->parameter_alias }}</td><td>{{ $item->unit_alias }}</td><td>{{ $item->chart_alias }}</td><td>{{ $item->dashboard_alias }}</td><td>{{ $item->model_name }}</td><td>{{ $item->access_type }}</td>
                                        <td>
                                            <a href="{{ url('/admin/device-type/' . $item->id) }}" title="View DeviceType"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/device-type/' . $item->id . '/edit') }}" title="Edit DeviceType"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/device-type' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete DeviceType" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $devicetype->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

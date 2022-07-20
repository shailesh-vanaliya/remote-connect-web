@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle ) 
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-11 col-sm-6 col-12">
                                <h3 class="card-title">Device Type</h3>
                            </div>
                            <div class="col-md-1 col-sm-6 col-12">
                            <a href="{{ url('/admin/device-type/create') }}" class="btn btn-primary btn-xs pull-right" title="Add New DeviceType">
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
                                    <th>Device Type</th>
                                    <th>Data Source</th>
                                    <th>Data Table</th>
                                    <th>Dashboard Id</th>
                                    <th>Parameter Alias</th>
                                    <th>Unit Alias</th>
                                    <th>Chart Alias</th>
                                    <th>Dashboard Alias</th>
                                    <th>Model Name</th>
                                    <th>Access Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devicetype as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->device_type }}</td>
                                    <td>{{ $item->data_source }}</td>
                                    <td>{{ $item->data_table }}</td>
                                    <td>{{ $item->dashboard_id }}</td>
                                    <td>{{ $item->parameter_alias }}</td>
                                    <td>{{ $item->unit_alias }}</td>
                                    <td>{{ $item->chart_alias }}</td>
                                    <td>{{ $item->dashboard_alias }}</td>
                                    <td>{{ $item->model_name }}</td>
                                    <td>{{ $item->access_type }}</td>
                                    <td>
                                        <a href="{{ url('/admin/device-type/' . $item->id) }}" title="View DeviceType"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> </button></a>
                                        <a href="{{ url('/admin/device-type/' . $item->id . '/edit') }}" title="Edit DeviceType"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>

                                        <form method="POST" action="{{ url('/admin/device-type' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-xs" title="Delete DeviceType" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> </button>
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
@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">DeviceType {{ $devicetype->id }}</h3>
     <a href="{{ url('/admin/device-type') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/device-type/' . $devicetype->id . '/edit') }}" title="Edit DeviceType"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/devicetype' . '/' . $devicetype->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete DeviceType" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
                        </form>
                </div>
                <div class="card-body">
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
                                    <tr>
                                        <th>ID</th><td>{{ $devicetype->id }}</td>
                                    </tr>
                                    <tr><th> Device Type </th><td> {{ $devicetype->device_type }} </td></tr><tr><th> Data Source </th><td> {{ $devicetype->data_source }} </td></tr><tr><th> Data Table </th><td> {{ $devicetype->data_table }} </td></tr><tr><th> Dashboard Id </th><td> {{ $devicetype->dashboard_id }} </td></tr><tr><th> Parameter Alias </th><td> {{ $devicetype->parameter_alias }} </td></tr><tr><th> Unit Alias </th><td> {{ $devicetype->unit_alias }} </td></tr><tr><th> Chart Alias </th><td> {{ $devicetype->chart_alias }} </td></tr><tr><th> Dashboard Alias </th><td> {{ $devicetype->dashboard_alias }} </td></tr><tr><th> Model Name </th><td> {{ $devicetype->model_name }} </td></tr><tr><th> Access Type </th><td> {{ $devicetype->access_type }} </td></tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

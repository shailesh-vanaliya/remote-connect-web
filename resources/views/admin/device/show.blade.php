@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <!-- <h3 class="box-title">Device {{ $device->id }}</h3> -->
                    <a href="{{ url('/admin/device') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/admin/device/' . $device->id . '/edit') }}" title="Edit Device"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('admin/device' . '/' . $device->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Device" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
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
                                <tr>
                                    <!-- <th>ID</th><td>{{ $device->id }}</td> -->
                                </tr>
                                <tr>
                                    <th> Modem Id </th>
                                    <td> {{ $device->modem_id }} </td>
                                </tr>
                                <tr>
                                    <th> Secret Key </th>
                                    <td> {{ $device->secret_key }} </td>
                                </tr>
                                <tr>
                                    <th> Project Name </th>
                                    <td> {{ $device->project_name }} </td>
                                </tr>
                                <tr>
                                    <th> Customer Name </th>
                                    <td> {{ $device->customer_name }} </td>
                                </tr>
                                <tr>
                                    <th> Region </th>
                                    <td> {{ $device->region }} </td>
                                </tr>
                                <tr>
                                    <th> Location </th>
                                    <td> {{ $device->location }} </td>
                                </tr>
                                <tr>
                                    <th> Machine Type </th>
                                    <td> {{ $device->machine_type }} </td>
                                </tr>
                                <tr>
                                    <th> Latitude </th>
                                    <td> {{ $device->latitude }} </td>
                                </tr>
                                <tr>
                                    <th> Longitude </th>
                                    <td> {{ $device->longitude }} </td>
                                </tr>
                                <tr>
                                    <th> Created By </th>
                                    <td> {{ $device->created_by }} </td>
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
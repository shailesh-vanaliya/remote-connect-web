@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border float-right mr-1 mb-2">
                    <!-- <h3 class="box-title">ReportConfiguration {{ $reportconfiguration->id }}</h3> -->
                    <a href="{{ url('/admin/report-configuration') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/admin/report-configuration/' . $reportconfiguration->id . '/edit') }}" title="Edit ReportConfiguration"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('admin/reportconfiguration' . '/' . $reportconfiguration->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete ReportConfiguration" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
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
                    @php
                    $array = json_decode($reportconfiguration->parameter);
                    $param = Helper::gerReportParameter($array, $reportconfiguration->modem_id) ;
                    @endphp
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <!-- <th>ID</th>
                                    <td>{{ $reportconfiguration->id }}</td> -->
                                </tr>
                                <tr>
                                    <th> Report Id </th>
                                    <td> {{ $reportconfiguration->report_id }} </td>
                                </tr>
                                <tr>
                                    <th> Device Id </th>
                                    <td> {{ $reportconfiguration->device_id }} </td>
                                </tr>
                                <tr>
                                    <th> Organization Id </th>
                                    <td> {{ $reportconfiguration->organization_id }} </td>
                                </tr>
                                <tr>
                                    <th> Report Title </th>
                                    <td> {{ $reportconfiguration->report_title }} </td>
                                </tr>
                                <tr>
                                    <th> Parameter </th>
                                    <td>{{ $param }} </td>
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
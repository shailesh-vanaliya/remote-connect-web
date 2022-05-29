{{--
    @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Report</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/report/create') }}" class="btn btn-success btn-sm" title="Add New Report">
<i class="fa fa-plus" aria-hidden="true"></i> Add New
</a>

<form method="GET" action="{{ url('/admin/report') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                <th>Device Id</th>
                <th>Device Type Id</th>
                <th>Field Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->device_id }}</td>
                <td>{{ $item->device_type_id }}</td>
                <td>{{ $item->field_name }}</td>
                <td>
                    <a href="{{ url('/admin/report/' . $item->id) }}" title="View Report"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                    <a href="{{ url('/admin/report/' . $item->id . '/edit') }}" title="Edit Report"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('/admin/report' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-xs" title="Delete Report" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper"> {!! $report->appends(['search' => Request::get('search')])->render() !!} </div>
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
    <div class="container-fluid">
        <div class="row">
            @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-11 col-sm-6 col-12">
                                <h3 class="card-title">Report list</h3>
                            </div>
                            <div class="col-md-1 col-sm-6 col-12">
                                <a href="{{ url('/admin/report/create') }}" class="btn btn-success btn-sm" title="Add New Report">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Device Id</th>
                                    <th>Device Type Id</th>
                                    <th>Field Name</th>
                                    <th>Parameter</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($report as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->modem_id }}</td>
                                    <td>{{ $item->device_type }}</td>
                                    <td style="word-break: break-all;">{{ $item->field_name }}</td>
                                    <td style="word-break: break-all;">{{ $item->parameter }}</td>
                                    <td style="width: 12%; display: flex;">
                                        <a class="ml-1" href="{{ url('/admin/report/' . $item->id) }}" title="View Report"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> </button></a>
                                        <a class="ml-1" href="{{ url('/admin/report/' . $item->id . '/edit') }}" title="Edit Report"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>
                                        <form class="" method="POST" action="{{ url('/admin/report' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-xs ml-1" title="Delete Report" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> </button>
                                        </form>
                                        <form  method="POST" action="{{ url('/admin/report-export/') }}">
                                            <input type="hidden" name="report_id" value="{{ $item->id }}">
                                            <input type="hidden" name="parameter" value="{{ $item->parameter }}">
                                            <input type="hidden" name="modem_id" value="{{ $item->modem_id }}">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-secondary btn-xs " title="Download Report"><i class="fas fa-download" aria-hidden="true"></i> </button>
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
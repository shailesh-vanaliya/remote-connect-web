@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Report {{ $report->id }}</h3>
     <a href="{{ url('/admin/report') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/report/' . $report->id . '/edit') }}" title="Edit Report"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/report' . '/' . $report->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Report" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
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
                                        <th>ID</th><td>{{ $report->id }}</td>
                                    </tr>
                                    <tr><th> Device Id </th><td> {{ $report->device_id }} </td></tr><tr><th> Device Type Id </th><td> {{ $report->device_type_id }} </td></tr><tr><th> Field Name </th><td> {{ $report->field_name }} </td></tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

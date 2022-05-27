@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ReportSchedule {{ $reportschedule->id }}</h3>
     <a href="{{ url('/admin/report-schedules') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/report-schedules/' . $reportschedule->id . '/edit') }}" title="Edit ReportSchedule"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/reportschedules' . '/' . $reportschedule->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ReportSchedule" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
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
                                        <th>ID</th><td>{{ $reportschedule->id }}</td>
                                    </tr>
                                    <tr><th> Report Id </th><td> {{ $reportschedule->report_id }} </td></tr><tr><th> Start Time </th><td> {{ $reportschedule->start_time }} </td></tr><tr><th> End Time </th><td> {{ $reportschedule->end_time }} </td></tr><tr><th> Execution Time </th><td> {{ $reportschedule->execution_time }} </td></tr><tr><th> Repeat On </th><td> {{ $reportschedule->repeat_on }} </td></tr><tr><th> Sernder User List </th><td> {{ $reportschedule->sender_user_list }} </td></tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

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
                                <h3 class="card-title">Report schedules list</h3>
                            </div>
                            <div class="col-md-1 col-sm-6 col-12">
                            <a href="{{ url('/admin/report-schedules/create') }}" class="btn btn-success btn-xs" title="Add New ReportSchedule">
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
                                    <!-- <th>Report Id</th> -->
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Execution Time</th>
                                    <th>Repeat On</th>
                                    <th>Sender User List</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reportschedules as $item)
                                @php
                                $sender_user_list =  isset($item->sender_user_list) ? json_decode($item->sender_user_list) : '';
                                $array =  isset($item->repeat_on) ?  json_decode($item->repeat_on) : '';
                                $repeat = (isset($array)) ? implode(', ',$array)  : '';
                                $sender_user_list = (!empty($sender_user_list)) ? implode(', ',$sender_user_list)  : '';
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <!-- <td>{{ $item->report_id }}</td> -->
                                    <td>{{ $item->start_time }}</td>
                                    <td>{{ $item->end_time }}</td>
                                    <td>{{ $item->execution_time }}</td>
                                    <td style="word-break: break-all;width: 20%;">{{ $repeat }}</td>
                                    <td style="word-break: break-all;width: 20%;">{{ $sender_user_list  }}</td>
                                    <!-- <td>{{ $item->sender_user_list }}</td> -->
                                    <td>
                                        <a href="{{ url('/admin/report-schedules/' . $item->id) }}" title="View ReportSchedule"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> </button></a>
                                        <a href="{{ url('/admin/report-schedules/' . $item->id . '/edit') }}" title="Edit ReportSchedule"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>

                                        <form method="POST" action="{{ url('/admin/report-schedules' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-xs" title="Delete ReportSchedule" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> </button>
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
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
                                <h3 class="card-title">Quota</h3>
                            </div>
                            <div class="col-md-1 col-sm-6 col-12">
                                <a href="{{ url('/admin/users/' ) }}" title="Back"><button class="btn  btn-warning btn-xs pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Report Schedule</th>
                                    <th>Storage usage</th>
                                    <th>Report Counter</th>
                                    <th>SMS Counter</th>
                                    <th>EMAIL Counter</th>
                                    <th>Notification</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="">{{ $item->id }}</td>
                                    <td class="text-capitalize">{{ $item->full_name }}</td>
                                    <td class="">{{ ($item->report_schedule_quota) ? $item->report_schedule_quota : 0  }}</td>
                                    <td class="">{{ $item->storage_usage }} / {{ $item->storage_quota }}</td>
                                    <td class="">{{ $item->report_counter }} / {{ $item->report_quota }}</td>
                                    <td class="">{{ $item->sms_counter }} / {{ $item->sms_quota }}</td>
                                    <td class="">{{ $item->email_counter }} / {{ $item->email_quota }}</td>
                                    <td class="">{{ $item->notification_counter }} / {{ $item->notification_quota }}</td>
                                    <td>
                                        <a href="{{ url('/admin/users/' . $item->id ) }}" title="View user"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                        <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit user"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button></a>
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
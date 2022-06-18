
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
                                <h3 class="card-title">Notification list</h3>
                            </div>
                            <div class="col-md-1 col-sm-6 col-12">
                                <a href="{{ url('/admin/notification/create') }}" class="btn btn-success btn-sm" title="Add New Notification">
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
                                    <th>Modem Id</th>
                                    <th>Alert Message</th>
                                    @if(Auth::guard('admin')->user()->role == 'SUPERADMIN')
                                    <th>Viewed</th>
                                    <th>Email Sent</th>
                                    <th>Sms Sent</th>
                                    @endif
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notification as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->modem_id }}</td>
                                    <td>{{ $item->alert_message }}</td>
                                    @if(Auth::guard('admin')->user()->role == 'SUPERADMIN')
                                    <td>{{ $item->viewed }}</td>
                                    <td>{{ $item->is_email_send }}</td>
                                    <td>{{ $item->is_sms_send }}</td>
                                    @endif
                                    <td>
                                    @if(Auth::guard('admin')->user()->role == 'SUPERADMIN')
                                        <a href="{{ url('/admin/notification/' . $item->id) }}" title="View Notification"><button class="btn btn-info btn-xs"><i class="fas fa-eye" aria-hidden="true"></i> </button></a>
                                        <a href="{{ url('/admin/notification/' . $item->id . '/edit') }}" title="Edit Notification"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>
                                        <form method="POST" action="{{ url('/admin/notification' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Notification" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> </button>
                                        </form>
                                        @else
                                        <a href="javascript:;" title="{{ $item->is_ack == 0 ? 'set as Acknowledged' : 'Already Acknowledged'}}" data-id="{{ $item->id }}" class="{{ $item->is_ack == 0 ? 'isAck' : ''}}""><button class="btn btn-secondary btn-xs"><i class="fa fa-check" aria-hidden="true"></i> </button></a>
                                        @endif
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

    @endsection
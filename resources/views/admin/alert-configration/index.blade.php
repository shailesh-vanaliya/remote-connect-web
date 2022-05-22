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
                                <h3 class="card-title">Alert Configuration list</h3>
                            </div>
                            <div class="col-md-1 col-sm-6 col-12">
                                <a href="{{ url('/admin/alert-configration/create') }}" class="btn btn-success btn-sm" title="Add New AlertConfigration">
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
                                    <th>Modem Id</th>
                                    <th>Parameter</th>
                                    <th>Condition</th>
                                    <th>Set Value</th>
                                    <th>Sms Alert</th>
                                    <th>Email Alert</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alertconfigration as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->modem_id }}</td>
                                    <td>{{ $item->parameter }}</td>
                                    <td>{{ $item->condition }}</td>
                                    <td>{{ $item->set_value }}</td>
                                    <td>{{ $item->sms_alert }}</td>
                                    <td>{{ $item->email_alert }}</td>
                                    <td>
                                        <a href="{{ url('/admin/alert-configration/' . $item->id) }}" title="View AlertConfigration"><button class="btn btn-info btn-xs"><i class="fas fa-eye" aria-hidden="true"></i> </button></a>
                                        <a href="{{ url('/admin/alert-configration/' . $item->id . '/edit') }}" title="Edit AlertConfigration"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>

                                        <form method="POST" action="{{ url('/admin/alert-configration' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-xs" title="Delete AlertConfigration" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> </button>
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
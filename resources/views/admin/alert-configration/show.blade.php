@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border float-right mr-1 mb-2">
                    <a href="{{ url('/admin/alert-configration') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/admin/alert-configration/' . $alertconfigration->id . '/edit') }}" title="Edit AlertConfigration"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('admin/alertconfigration' . '/' . $alertconfigration->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete AlertConfigration" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</button>
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
                                    <th> Modem Id </th>
                                    <td> {{ $alertconfigration->modem_id }} </td>
                                </tr>
                                <tr>
                                    <th> Parameter </th>
                                    <td> {{ Helper::gerReportParameter(array($alertconfigration->parameter), $alertconfigration->modem_id) }}
                                 </td>
                                </tr>
                                <tr>
                                    <th> Condition </th>
                                    <td> {{ $condition[$alertconfigration->condition] }} </td>
                                </tr>
                                <tr>
                                    <th> Set Value </th>
                                    <td> {{ $alertconfigration->set_value }} </td>
                                </tr>
                                <tr>
                                    <th> Sms Alert </th>
                                    <td> @if($alertconfigration->sms_alert == 1)
                                        <small class=" badge bg-success">
                                            Yes
                                        </small>
                                        @else
                                        <small class=" badge bg-secondary ">
                                            No
                                        </small>
                                        @endif   </td>
                                </tr>
                                <tr>
                                    <th> Email Alert </th>
                                    <td>@if($alertconfigration->email_alert == 1)
                                        <small class=" badge bg-success">
                                            Yes
                                        </small>
                                        @else
                                        <small class=" badge bg-secondary ">
                                            No
                                        </small>
                                        @endif</td>
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
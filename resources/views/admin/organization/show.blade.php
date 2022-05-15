@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Organization {{ $organization->id }}</h3>
     <a href="{{ url('/admin/organization') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/organization/' . $organization->id . '/edit') }}" title="Edit Organization"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/organization' . '/' . $organization->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Organization" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
                                        <th>ID</th><td>{{ $organization->id }}</td>
                                    </tr>
                                    <tr><th> Organization Name </th><td> {{ $organization->organization_name }} </td></tr><tr><th> User Count </th><td> {{ $organization->user_count }} </td></tr><tr><th> Device Count </th><td> {{ $organization->device_count }} </td></tr><tr><th> Max Device Limit </th><td> {{ $organization->max_device_limit }} </td></tr><tr><th> Max User Limit </th><td> {{ $organization->max_user_limit }} </td></tr><tr><th> Created By </th><td> {{ $organization->created_by }} </td></tr><tr><th> Updated By </th><td> {{ $organization->updated_by }} </td></tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

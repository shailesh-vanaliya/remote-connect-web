@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Setting {{ $setting->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/settings') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/settings/' . $setting->id . '/edit') }}" title="Edit Setting"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/settings' . '/' . $setting->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Setting" onclick="return confirm(&quot;Are you sure want to delete?&quot;)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $setting->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $setting->title }} </td></tr><tr><th> Meta Key </th><td> {{ $setting->meta_key }} </td></tr><tr><th> Meta Value </th><td> {{ $setting->meta_value }} </td></tr><tr><th> Status </th><td> {{ $setting->status }} </td></tr><tr><th> Platform </th><td> {{ $setting->platform }} </td></tr><tr><th> Country Id </th><td> {{ $setting->country_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Settings List</h3>
                            <!-- <a href="{{ url('/admin/settings/create') }}" class="pull-right btn btn-success btn-sm" title="Add New Settings"> <i class="fa fa-plus" aria-hidden="true"></i> Add New </a> -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <!-- <th>Meta Key</th> -->
                                        <th>Meta Value</th>
                                        <th>Status</th>
                                        <!-- <th>Platform</th> -->
                                        <!-- <th>Settings Id</th> -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($settings as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <!-- <td>{{ $item->meta_key }}</td> -->
                                        <td>{{ $item->meta_value }}</td>
                                        <td>{{ $item->status }}</td>
                                        <!-- <td>{{ $item->platform }}</td> -->
                                        <!-- <td>{{ $item->id }}</td> -->
                                        <td>
                                            <!-- <a href="{{ url('/admin/settings/' . $item->id) }}" title="View Setting"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> -->
                                            <a href="{{ url('/admin/settings/' . $item->id . '/edit') }}" title="Edit Setting"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                                            <!-- <form method="POST" action="{{ url('/admin/settings' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Setting" onclick="return confirm(&quot;Are you sure want to delete?&quot;)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                            </form> -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Settings</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/settings/create') }}" class="btn btn-success btn-sm" title="Add New Setting">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/settings') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Title</th><th>Meta Key</th><th>Meta Value</th><th>Status</th><th>Platform</th><th>Settings Id</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($settings as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td><td>{{ $item->meta_key }}</td><td>{{ $item->meta_value }}</td><td>{{ $item->status }}</td><td>{{ $item->platform }}</td><td>{{ $item->Settings_id }}</td>
                                        <td>
                                            <a href="{{ url('/admin/settings/' . $item->id) }}" title="View Setting"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/settings/' . $item->id . '/edit') }}" title="Edit Setting"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/settings' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Setting" onclick="return confirm(&quot;Are you sure want to delete?&quot;)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $settings->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> -->
@endsection

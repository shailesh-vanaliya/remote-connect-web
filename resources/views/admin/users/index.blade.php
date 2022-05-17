@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Users List</h3>
                            <!-- <div class="col-lg-8"> -->
                                    <a href="{{ url('/admin/users/create') }}" class="btn btn-primary btn-sm pull-right" title="Add New User">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                    </a>
                                <!-- </div> -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
									<th>Mobile Number</th>
									<th>Email</th>
									<!--<th>Date of Birth</th>-->
									<th>Type</th>
									<th>Created At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $item)

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-capitalize">{{ $item->first_name }}</td>
                                        <td class="text-capitalize">{{ $item->country_code .' '. $item->mobile_no  }}</td>
										<td class="">{{ $item->email }}</td>
                                        <!--<td class="text-capitalize">{{ ($item->date_of_birth =="") ? '' : date('d M Y',strtotime($item->date_of_birth)) }}</td>-->
										<td class="text-capitalize">{{ $item->role }}</td>
										<td class="text-capitalize">{{date('d M Y',strtotime($item->created_at)) }}</td>
                                        <td class="text-capitalize">{{ $item->status }}</td>
                                        <td>
                                            
                                        <a href="{{ url('/admin/users/' . $item->id ) }}" title="View user"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                        <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit user"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button></a>
                                            
{{--                                            <form method="POST" action="{{ route('user_delete', [ 'id' => $item->id ]) }}" accept-charset="UTF-8" style="display:inline">--}}
{{--                                                {{ method_field('DELETE') }}--}}
{{--                                                {{ csrf_field() }}--}}
{{--                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete user" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
{{--                                            </form>--}}
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
@endsection

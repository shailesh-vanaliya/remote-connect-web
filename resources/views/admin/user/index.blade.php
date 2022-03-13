@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <form class="form-div">
                            <div class="row">
                                <div class="col-lg-8">
                                    <a href="{{ url('/admin/user/create') }}" class="btn btn-primary btn-sm  " title="Add New User">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add New Client
                                    </a>
                                </div>
                                <div class="col-lg-4">
                                    <input type="hidden" value="{{ csrf_token() }}">
                                    <div class="form-group div-btn">
                                        <input type="text" name="search" class="form-control">
                                        <input type="submit" class="btn" value="search">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Organization Name</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th style="min-width: 150px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($user as $item)
                                    <tr>
                                        <td class="middle-text" >@if(request()->get('page') > 1) {{ $loop->iteration + (10 * (request()->get('page') - 1)) }} @else {{ $loop->iteration  }} @endif</td>
                                        <td class="middle-text">{{ $item->organization_name }}</td>
                                        <td class="middle-text">{{ $item->first_name }}</td>
                                        <td class="middle-text">{{ $item->last_name }}</td>
                                        <td class="middle-text">{{ $item->email }}</td>
                                        <td class="middle-text"><span class="badge">{{ $item->status }}</span></td>
                                        <td class="middle-text"><span class="badge">{{ ($item->user_type == 'USER' ?'CLIENT' : 'ADMIN') }}</span></td>
                                        <td>
                                            <a href="{{ url('/admin/user/change-password/' . $item->id) }}" title="Change Password"><button class="btn btn-info btn-sm"><i class="fa fa-lock" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/admin/user/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/admin/user/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>

                                            <form method="POST" action="{{ url('/admin/user' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm('Are you sure want to delete?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $user->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

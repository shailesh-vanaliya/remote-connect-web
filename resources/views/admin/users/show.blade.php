@extends('admin.layouts.admin')
@section('content')
        <section class="content-header">
            <h1>
                Users
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('user_list') }}">Users</a></li>
                <li class="active">View</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <h3 class="profile-username text-center">{{$user->first_name }} {{$user->last_name }}</h3>
                            <p class="text-muted text-center">
                                @if($user->status)
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Inactive</span>
                                @endif
                            </p>
                            <p class=" ">
                                <a href="{{ url('/admin/users/' ) }}" title="Back"><button class="btn  btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                <a href="{{  url('/admin/users/' . $user->id . '/edit') }}" title="Edit user"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                            </p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Id</b> <a class="pull-right">{{ $user->id }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>First Name </b> <a class="pull-right">{{$user->first_name }} </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Last Name </b> <a class="pull-right">{{$user->last_name }} </a>
                                </li>
								<li class="list-group-item">
                                    <b>Mobile Number </b> <a class="pull-right">{{ $user->mobile_no  }} </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="pull-right">{{$user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Profile Pic</b> <a class="pull-right"> <img style="width: 150px;" src="{{ asset('public/') .'/uploads/profile_pic/' . $user->profile_pic }}"> </a>
                                    </td>
                                </li>

                                <li class="list-group-item">
                                    <b>Type</b> <a class="pull-right"><span class="label label-info">{{ $user->role }}</span></a>
                                </li>
								<li class="list-group-item">
                                    <b>Created At</b> <a class="pull-right">{{$user->created_at }}</a>
                                </li>
                                
                            </ul>
{{--                            <form method="POST" action="{{ url('admin/users' . '/' . $user->id) }}" accept-charset="UTF-8">--}}
{{--                                {{ method_field('DELETE') }}--}}
{{--                                {{ csrf_field() }}--}}
{{--                                <button type="submit" class="btn btn-danger btn-sm pull-right" title="Delete user" onclick="return confirm(&quot;Are you sure want to delete?&quot;)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

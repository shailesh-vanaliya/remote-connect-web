@extends('admin.layouts.admin')
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('user_list') }}">Users</a></li>
                <li class="active">Add</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create User </h3>
                        </div>
                        <div class="box-body">
                        <form method="POST" action="{{ url('/admin/users') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            @include ('admin/.users.form', ['formMode' => 'add'])
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

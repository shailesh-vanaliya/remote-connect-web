@extends('admin.layouts.admin')
@section('content')
        <section class="content-header">
            <h1>
                Users
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('user_list') }}">Users</a></li>
                <li class="active">Edit</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit user #{{ $user->id }}</h3>
                        </div>
                        <div class="box-body">
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        <!-- <form role="form" method="POST" action="{{ route('user_edit', [ 'id' => $user->id ]) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            @include ('admin/.users.form', ['formMode' => 'edit'])
                        </form> -->
                        <form method="POST" action="{{ url('/admin/users/' . $user->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        @include ('admin.users.form', ['formMode' => 'edit'])

                    </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

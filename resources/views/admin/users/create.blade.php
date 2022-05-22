@extends('admin.layouts.admin')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Create User </h3>
                        <a href="{{ url('/admin/users') }}" title="Back" class="btn btn-warning btn-xs float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    </div>
                    <form method="POST" action="{{ url('/admin/users') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}
                        @include ('admin/.users.form', ['formMode' => 'add'])
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection
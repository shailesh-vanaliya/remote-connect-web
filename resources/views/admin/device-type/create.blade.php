{{-- @extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New DeviceType</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/device-type') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ url('/admin/device-type') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('admin.device-type.form', ['formMode' => 'create'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection   --}}



@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Create New DeviceType</h3>
                    <a href="{{ url('/admin/device-type') }}" title="Back"><button class="btn btn-warning btn-sm float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                </div>
                <div class="box-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                     <form method="POST" action="{{ url('/admin/device-type') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('admin.device-type.form', ['formMode' => 'create'])
                        </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
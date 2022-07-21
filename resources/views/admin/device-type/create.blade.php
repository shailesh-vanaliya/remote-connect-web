 
@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Create New Device Type</h3>
                        <a href="{{ url('/admin/device-type') }}" title="Back"><button class="btn btn-warning btn-xs float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </div>
                    <div class="box-body">
                        <!-- @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif -->
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
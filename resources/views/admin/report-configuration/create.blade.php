@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )

<span class="loader"></span>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Create New Report Configuration</h3>
                        <a href="{{ url('/admin/report-configuration') }}" title="Back"><button class="btn btn-warning btn-xs float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </div>
                    <form method="POST" action="{{ url('/admin/report-configuration') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include ('admin.report-configuration.form', ['formMode' => 'create'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
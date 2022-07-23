@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Create New MQTTUser</h3>
                        <a href="{{ url('/admin/mqtt-user') }}" title="Back"><button class="btn btn-warning btn-xs float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </div>
                    <div class="box-body">
                    <form method="POST" action="{{ url('/admin/mqtt-user') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('admin.mqtt-user.form', ['formMode' => 'create'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
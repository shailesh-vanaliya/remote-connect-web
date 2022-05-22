@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<!-- <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit AlertConfigration #{{ $alertconfigration->id }}</h3>
                    <a href="{{ url('/admin/alert-configration') }}" title="Back"><button class="btn btn-warning btn-sm pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                </div>
                <div class="box-body">
                   @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/alert-configration/' . $alertconfigration->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.alert-configration.form', ['formMode' => 'edit'])

                        </form>
                </div>
            </div>
        </div>
    </div>
</section> -->


<span class="loader"></span>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Update Alert Configuration</h3>
                        <a href="{{ url('/admin/alert-configration') }}" title="Back"><button class="btn btn-warning btn-xs float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </div> 

                    <form method="POST" action="{{ url('/admin/alert-configration/' . $alertconfigration->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        @include ('admin.alert-configration.form', ['formMode' => 'edit'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
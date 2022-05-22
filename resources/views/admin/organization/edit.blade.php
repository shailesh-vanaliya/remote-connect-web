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
                        <h3 class="card-title">Edit Organization</h3>
                        <a href="{{ url('/admin/organization') }}" title="Back"><button class="btn btn-warning btn-xs float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="{{ url('/admin/organization/' . $organization->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.organization.form', ['formMode' => 'edit'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
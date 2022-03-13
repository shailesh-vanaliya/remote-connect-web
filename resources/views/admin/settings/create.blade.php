@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Create New Setting </h3>
                    <a href="{{ url('/admin/settings') }}" title="Back"><button class="btn btn-warning btn-sm pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                </div>
                <div class="box-body">
                              @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                <div class="box-body">
                   <form method="POST" action="{{ url('/admin/settings') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('admin.settings.form', ['formMode' => 'create'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

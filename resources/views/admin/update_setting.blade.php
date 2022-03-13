@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Settings </h3>
                </div>
                <div class="box-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <form method="POST" action="{{ url('/admin/admin-setting/') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}
                        <div class="box-body">
                            @foreach ($permission as $key =>  $param)
                            <div class="form-group row {{ $errors->has('field_title') ? 'has-error' : ''}}">
                                <label for="field_title" class="col-form-label text-right col-lg-3 col-sm-12">{{ $param->title }}</label>
                                <div class="col-lg-4 col-md-9 col-sm-12">
                                <!-- $param->field_key -->
                                    <input class="form-control" name="field_key[]" type="text" id="field_title" value="{{ isset($param->field_value) ? $param->field_value : ''}}">
                                    <input class="form-control" name="permission[]" type="hidden" id="field_title" value="{{ isset($param->field_key) ? $param->field_key : ''}}">
                                    {!! $errors->first('field_title', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            @endforeach
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-9 col-sm-12"></div>
                                <input class="btn btn-primary" type="submit" value="{{ 'Update' }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
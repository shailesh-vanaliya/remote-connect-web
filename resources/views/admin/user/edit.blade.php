@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                            <a href="{{ url('/admin/user') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <div class="col-sm-12">
                            <form method="POST" action="{{ url('/admin/user/' . $user->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}

                                @include ('admin.user.form', ['formMode' => 'edit'])

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

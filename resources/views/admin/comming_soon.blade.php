@extends('admin.layouts.admin')
@section('title', $pagetitle )
@section('content')
    @php
        $currRoute = Route::current()->getName()
    @endphp
    <style type="text/css">
        .directions-info {
            display: none !important;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- Main content -->
    <section class="content">


        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
                <!-- MAP & BOX PANE -->
                <div class="box box-success">

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Comming Soon</h3>
                        </div>
                        <div class="box-body">
                            <!-- Module under progress. -->
                            <h1 class="box-title">Comming Soon</h1>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

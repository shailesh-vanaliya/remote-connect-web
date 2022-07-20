@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<style>
    .badge {
    padding: 0.4em 0.4em;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-12 mt-2">
                            <h3 class="card-title">Device list</h3>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            {{ Form::select('search', $location , empty(request('search')) ? null : request('search') , array('class' => 'form-control search', 'id' => 'search')) }}
                        </div>
                        <div class="col-md-1 col-sm-6 col-12">
                            <a href="{{ url('/admin/device/create') }}" class="pull-right btn btn-success btn-sm" title="Add New Unit">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($device as $item)
            <div class="col-md-3">
                 <!-- if (@getimagesize(asset('/public/uploads/device/' . $item->img ))){
                    $imageName = asset('/public/uploads/device/' . $item->img ); -->
                @php
                $nm = str_replace("_","",$item->device_type.'.png');
                if (@getimagesize(asset('/public/ICON/' . $nm ))){
                    $imageName = asset('/public/ICON/' . $nm );
                } else {
                    $imageName = asset('/public/uploads/device/no_image.svg');
                }
                if($item->Status == 1){
                $sss = "box-shadow: 0 0.125rem 0.25rem #28A745 !important;";
                }else{
                $sss = "box-shadow: 0 0.125rem 0.25rem #DC3545 !important;";
                }
                @endphp
                <!-- Widget: user widget style 2 -->
                <div class="card card-widget widget-user-2 shadow-sm" style="{{ $sss }}">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header " style="padding: 0.8rem 0.2rem 0.2rem 0.7rem;">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ $imageName }}" alt="no image">
                        </div>
                        <h3 class="widget-user-username">{{ $item->modem_id }}</h3>
                        <p class="widget-user-desc" title="{{  $item->location }}">{{ $item->project_name }} ({{  Helper::filterAddress($item->location) }})</p>
                    </div>
                    <div class="card-footer p-0" style="background-color:unset; border-top: 1px solid rgba(0,0,0,.125)">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ $item->subscription_status == 'Active' && Auth::guard('admin')->user()->role == 'SUPERADMIN' ? url('/admin/device/device-detail/' . $item->id ) : '#' }}" class="nav-link">
                                    Status
                                    @if($item->Status == 1)
                                    <span class="float-right badge bg-success">
                                        Online
                                    </span>
                                    @else
                                    <span class="float-right badge bg-danger">
                                        Offline
                                        @endif
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link">
                                    Device Type <span class="float-right badge bg-info">{{ $item->device_type }}</span>
                                </a>
                            </li>
                            @if(Auth::guard('admin')->user()->role == 'SUPERADMIN')
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link">
                                    User Name <span class="float-right badge bg-secondary ">{{ $item->first_name. " ".$item->last_name }}</span>
                                </a>
                            </li>
                            @endif
                        @php
                            $url = url('/admin/'.$item->dashboard_id.'/' . base64_encode($item->id) );
                            $url = ($item->dashboard_id == '') ? "#" : $url;
                        @endphp
                            <li class="nav-item m-2 text-center">
                                <a href="{{ $url; }}" title="Goto dashboard"><button class="btn btn-success btn-xs "><i class="fas fa-tachometer-alt" aria-hidden="true"></i> </button></a>
                                <!-- <a href="{{ url('/admin/meter-dashboard/' . $item->modem_id) }}" title="Goto dashboard"><button class="btn btn-success btn-xs "><i class="fas fa-tachometer-alt" aria-hidden="true"></i> </button></a> -->
                                <a href="{{ url('/admin/device/' . $item->id) }}" title="View Device"><button class="btn btn-primary btn-xs "><i class="fas fa-eye" aria-hidden="true"></i> </button></a>
                                <a href="{{ url('/admin/device/' . $item->id . '/edit') }}" title="Edit Device"><button class="btn btn-primary btn-xs "><i class="fas fa-pencil-alt" aria-hidden="true"></i> </button></a>
                                @if(Auth::guard('admin')->user()->role == 'SUPERADMIN')
                                <a href="{{ url('/admin/device/map-alias/' . $item->id ) }}" title="Create/edit Device alias"><button class="btn btn-secondary btn-xs "><i class="fa fa-street-view" aria-hidden="true"></i> </button></a>
                                @endif
                                <form method="POST" action="{{ url('/admin/device' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-xs" title="Delete Device" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i> </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            @endforeach
            @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        // $(document).Toasts('create', {
        //     class: 'bg-success',
        //     title: 'Toast Title sdsadsa sadsa dsasa',
        //     // subtitle: 'Subtitle',
        //     // body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        // })

        $('#search').change(function() {
            console.log($('#search :selected').text());
            let serachValue = $('#search :selected').val();
            var pathname = window.location.pathname;
            var url = window.location.href;
            var origin = window.location.origin;
            let rurl = origin + pathname + "?search=" + serachValue;
            if (serachValue != undefined && serachValue != '') {
                window.location.replace(rurl);
            } else {
                window.location.replace(origin + pathname);
            }
        });
    });
</script>

@endsection
@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtm6FhRz26-NQBaTZLSu8U3EMg20hYumQ&libraries=places"></script>
<script>
    function initialize() {
        var input = document.getElementById('location');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            // console.log(place.formatted_address , " placeplace")
            console.log(place.geometry.location.lat(), " placeplace")
            // document.getElementById('location').value = place.formatted_address;
            // document.getElementById('location').value = place.name;
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                <div class="card-header">
                        <h3 class="card-title">Edit Device  </h3>
                        <a href="{{ url('/admin/device') }}" title="Back"><button class="btn btn-warning btn-xs float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </div>
                        <form method="POST" action="{{ url('/admin/device/' . $device->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            @include ('admin.device.form', ['formMode' => 'edit'])
                        </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
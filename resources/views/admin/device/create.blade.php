
@extends('admin.layouts.admin')
@section('content')
@section('title', $pagetitle )
<!-- 
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDujLPXC7_jqMNn9KWpah2o1mYGUVbq2vk&libraries=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('location');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                // console.log(place.formatted_address , " placeplace")
                console.log(place.geometry.location.lat() , " placeplace")
                // document.getElementById('location').value = place.formatted_address;
                // document.getElementById('location').value = place.name;
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  -->
    <!-- <input id="searchTextField" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" />  
    <input type="hidden" id="city2" name="city2" />
    <input type="hidden" id="cityLat" name="cityLat" />
    <input type="hidden" id="cityLng" name="cityLng" /> -->
 

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Create New Device</h3>
                    <a href="{{ url('/admin/device') }}" title="Back"><button class="btn btn-warning btn-sm pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                </div>
                <div class="box-body">
                    <!-- @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif -->
                     <form method="POST" action="{{ url('/admin/device') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('admin.device.form', ['formMode' => 'create'])
                        </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
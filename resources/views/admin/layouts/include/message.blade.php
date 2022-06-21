<!-- <div style="display: none;" class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('public/ICON/loader.gif') }}" alt="Device" height="150" width="150">
  </div>  -->
@if (session('session_error') || session('session_success') || session('session_alert'))
<div id="errorSection" class="col-md-12 mt-2">
    <div class="col-md-12 subsection">
        @if (session('session_error'))
        <!-- <div class="alert alert-danger margin-t-30">
            {{ session('session_error') }}
            <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div> -->
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('session_error') }}
        </div>
        @endif

        @if (session('session_success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close closeIcon" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('session_success') }}
        </div>
        @endif

        @if (session('session_alert'))
        <div class="alert alert-warning margin-t-30">
            {{ session('session_alert') }}
            <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
        @endif
    </div>
</div>
@endif
<style>
    .closeIcon {
        cursor: pointer;
    }
</style>
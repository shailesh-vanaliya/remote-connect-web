@if (session('session_error') || session('session_success') || session('session_alert'))
<div id="errorSection" class="col-md-12 mt-2" style="width:100% !important;">
    <div class="col-md-12  ">
        @if (session('session_error'))
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

    .alert-dismissible {
        padding-right: unset;
    }
</style>
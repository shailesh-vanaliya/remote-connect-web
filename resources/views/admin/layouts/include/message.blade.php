
@if (session('session_error') || session('session_success') || session('session_alert'))
<div id="errorSection" class="col-md-12 m-t-10 " >
    <div class="col-md-12 subsection">
        @if (session('session_error'))
        <div class="alert alert-danger margin-t-30">
            {{ session('session_error') }}
            <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
        @endif

        @if (session('session_success'))
        <div class="alert alert-success margin-t-30">
            {{ session('session_success') }}
            <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
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
    .closeIcon{
        cursor: pointer;
    }
</style>

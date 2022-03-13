<?php /*
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
*/ ?>

<div id="errorSection" style="width:100% !important;"> 
    @if (session('session_error'))
        <div class="alert alert-danger">
            {{ session('session_error') }}
            <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
    @endif

    @if (session('session_success'))
        <div class="alert alert-success">
            {{ session('session_success') }}
            <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
    @endif

    @if (session('session_alert'))
        <div class="alert alert-warning">
            {{ session('session_alert') }}
            <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
    @endif
</div>
<style>
    .closeIcon{
        cursor: pointer;
    }
</style>

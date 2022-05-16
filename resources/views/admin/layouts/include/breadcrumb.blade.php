<!-- @if(isset($header['title']) || isset($header['breadcrumb']))
<section class="content-header">
  <div class="container-fluid">
    @isset($header['title'])<h1>{{ $header['title'] }}</h1>@endisset
    @isset($header['breadcrumb'])
    @php
    $count = count($header['breadcrumb']);
    $temp = 1;
    @endphp
    <ol class="breadcrumb">
      @foreach($header['breadcrumb'] as $key => $value)
      @php $value = (empty($value)) ? 'javascript:;' : $value; @endphp
      @if($temp!=$count)
      <li><a href="{{ $value }}" class=""> @if($temp == 1)<i class="fa fa-dashboard"></i>@endif {{ $key }} </a></li>
      @else
      <li class="active"> {{ $key }} </li>
      @endif
      @php $temp = $temp+1; @endphp
      @endforeach
    </ol>
    @endisset
  </div>
</section>
@endif -->

@if(isset($header['title']) || isset($header['breadcrumb']))
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        @isset($header['title'])<h1>{{ $header['title'] }}</h1>@endisset
        @isset($header['breadcrumb'])
        @php
        $count = count($header['breadcrumb']);
        $temp = 1;
        @endphp
      </div>
      <div class="col-sm-6">
        <!-- <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Flot</li>
        </ol> -->

        <ol class="breadcrumb float-sm-right">
      @foreach($header['breadcrumb'] as $key => $value)
      @php $value = (empty($value)) ? 'javascript:;' : $value; @endphp
      @if($temp!=$count)
      <li class="breadcrumb-item"><a href="{{ $value }}" > @if($temp == 1)<i class="fa fa-dashboard"></i>@endif {{ $key }} </a></li>
      @else
      <li class="breadcrumb-item active"> {{ $key }} </li>
      @endif
      @php $temp = $temp+1; @endphp
      @endforeach
    </ol>
    @endisset
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endif
@yield('content-header')
@if(isset($header['title']) || isset($header['breadcrumb']))
<section class="content-header" >
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
</section>
@endif
@yield('content-header')

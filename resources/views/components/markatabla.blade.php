@props(
    [
      'numstate'=>false,
      'stringstate'=>false
    ]
)

@php
    if($numstate==1) $colormarca='badge_success';
    if($numstate==2) $colormarca='badge_danger';
@endphp
<div class='badge badge_outlined {{$colormarca}} uppercase'>{{$stringstate}}</div>